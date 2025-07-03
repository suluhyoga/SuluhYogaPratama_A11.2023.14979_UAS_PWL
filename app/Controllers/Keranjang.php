<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class Keranjang extends BaseController
{
    protected $cart;
    protected $client;
    protected $apiKey;
    protected $transaction;
    protected $transaction_detail;
    protected $productModel;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->cart = \Config\Services::cart();
        $this->client = new \GuzzleHttp\Client([
            'verify' => false
        ]);
        $this->apiKey = env('COST_KEY');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->productModel = new ProductModel();

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        // Menampilkan halaman keranjang dengan item dan total harga
        return view('v_keranjang', [
            'items' => $this->cart->contents(),
            'total' => $this->cart->total()
        ]);
    }

    public function tambah()
    {
        // Menambahkan produk ke keranjang
        $this->cart->insert([
            'id'      => (int) $this->request->getPost('id'),
            'qty'     => 1,
            'price'   => (float) $this->request->getPost('harga'),
            'name'    => $this->request->getPost('nama'),
            'options' => [
                'foto' => $this->request->getPost('foto')
            ]
        ]);

        $message = 'Produk berhasil ditambahkan ke keranjang! <a href="' . base_url('keranjang') . '" class="alert-link">Lihat</a>';

        $redirect_back = $this->request->getPost('redirect_back');
        return redirect()->to($redirect_back ?: '/keranjang')->with('success', $message);
    }

    public function tambahLangsung($id)
    {
        // Menambahkan produk langsung ke keranjang dari halaman produk
        $produk = $this->productModel->find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $this->cart->insert([
            'id'      => $produk['id'],
            'qty'     => 1,
            'price'   => $produk['harga'],
            'name'    => $produk['nama'],
            'options' => ['foto' => $produk['foto']]
        ]);

        return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }

    public function edit()
    {
        // Mengupdate jumlah kuantitas item di keranjang
        $quantities = $this->request->getPost('qty');

        foreach ($quantities as $rowid => $qty) {
            $this->cart->update([
                'rowid' => $rowid,
                'qty'   => $qty
            ]);
        }

        return redirect()->to('/keranjang')->with('success', 'Keranjang diperbarui!');
    }

    public function delete($rowid)
    {
        // Menghapus item dari keranjang
        $this->cart->remove($rowid);
        return redirect()->back()->with('success', 'Item dihapus dari keranjang!');
    }

    public function clear()
    {
        // Mengosongkan seluruh keranjang
        $this->cart->destroy();
        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }

    public function checkout()
    {
        // Menampilkan halaman checkout
        $data['items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();

        return view('v_checkout', $data);
    }

    public function getLocation()
    {
        // Mengambil data lokasi (kelurahan/kecamatan) dari Raja Ongkir
        $search = $this->request->getGet('search');

        $response = $this->client->request(
            'GET',
            'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=' . $search . '&limit=50',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );

        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function getCost()
    {
        // Menghitung biaya ongkos kirim dari Raja Ongkir
        $destination = $this->request->getGet('destination');

        // Parameter daerah asal pengiriman, berat produk, dan kurir dibuat statis
        $response = $this->client->request(
            'POST',
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
            [
                'multipart' => [
                    [
                        'name'     => 'origin',
                        'contents' => '64999'
                    ],
                    [
                        'name'     => 'destination',
                        'contents' => $destination
                    ],
                    [
                        'name'     => 'weight',
                        'contents' => '1000'
                    ],
                    [
                        'name'     => 'courier',
                        'contents' => 'jne'
                    ]
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'key' => $this->apiKey,
                ],
            ]
        );

        $body = json_decode($response->getBody(), true);
        return $this->response->setJSON($body['data']);
    }

    public function buy()
    {
        // Fungsi ini dipanggil saat pelanggan mengklik "Buat Pesanan" di halaman checkout
        if ($this->request->getPost()) {
            $username = $this->request->getPost('username');
            $totalHarga = $this->request->getPost('total_harga');
            $alamat = $this->request->getPost('alamat');
            $ongkir = $this->request->getPost('ongkir');

            // 1. Simpan data pesanan ke database dengan status '0' (Belum Selesai / Pending)
            $dataForm = [
                'username' => $username,
                'total_harga' => (float)$totalHarga,
                'alamat' => $alamat,
                'ongkir' => (float)$ongkir,
                'status' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->transaction->insert($dataForm);
            $last_insert_id = $this->transaction->getInsertID();

            $midtrans_items = [];
            foreach ($this->cart->contents() as $value) {
                // Simpan detail produk ke tabel transaction_detail
                $dataFormDetail = [
                    'transaction_id' => $last_insert_id,
                    'product_id' => $value['id'],
                    'jumlah' => $value['qty'],
                    'diskon' => 0,
                    'subtotal_harga' => $value['qty'] * $value['price'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $this->transaction_detail->insert($dataFormDetail);

                // Tambahkan item produk ke array Midtrans_items
                $midtrans_items[] = [
                    'id' => (string)$value['id'],
                    'price' => (int)$value['price'],
                    'quantity' => (int)$value['qty'],
                    'name' => $value['name'],
                ];
            }

            // Tambahkan ongkir sebagai item terpisah di Midtrans
            $midtrans_items[] = [
                'id' => 'SHIPPING-' . $last_insert_id,
                'price' => (int) $ongkir,
                'quantity' => 1,
                'name' => 'Biaya Pengiriman',
            ];

            // Detail pelanggan untuk Midtrans
            $customer_details = [
                'first_name' => $username,
                'email' => session()->get('email') ?? 'pelanggan@gmail.com',
                'phone' => '081234567890',
                'address' => $alamat,
            ];

            // Transaction Details untuk Midtrans
            $transaction_details = [
                'order_id' => 'TRX-' . $last_insert_id . '-' . time(),
                'gross_amount' => (int) $totalHarga,
            ];

            // Gabungkan semua parameter untuk dikirim ke Midtrans Snap
            $params = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $midtrans_items,
            ];

            try {
                // Dapatkan Snap Token dari Midtrans
                $snapToken = Snap::getSnapToken($params);

                // Simpan snap_token dan midtrans_transaction_id ke transaksi yang baru dibuat di database
                $this->transaction->update($last_insert_id, [
                    'snap_token' => $snapToken,
                    'midtrans_transaction_id' => $transaction_details['order_id']
                ]);

                $this->cart->destroy();

                // Redirect pelanggan ke halaman pembayaran yang akan menampilkan pop-up Midtrans
                return redirect()->to(base_url('checkout/payment/' . $last_insert_id));
            } catch (\Exception $e) {
                // Tangani error jika gagal berkomunikasi dengan Midtrans
                log_message('error', 'Midtrans Error saat membuat transaksi: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Gagal memproses pembayaran. Silakan coba lagi. Error: ' . $e->getMessage());
            }
        }
    }

    public function payment($orderId)
    {
        // Fungsi ini menampilkan halaman dengan tombol untuk memicu pop-up Midtrans
        $transaction = $this->transaction->find($orderId);

        // Jika transaksi tidak ditemukan atau snap_token belum ada
        if (!$transaction || empty($transaction['snap_token'])) {
            // Jika transaksi ditemukan tapi snap_token kosong (misalnya karena error sebelumnya), coba buat ulang
            if ($transaction) {
                // Ambil kembali item-item dari transaction_detail untuk transaksi ini
                $transactionDetails = $this->transaction_detail->where('transaction_id', $orderId)->findAll();
                $midtrans_items = [];
                $totalHargaRecalculated = 0;

                foreach ($transactionDetails as $detail) {
                    $product = $this->productModel->find($detail['product_id']);
                    if ($product) {
                        $midtrans_items[] = [
                            'id' => (string)$product['id'],
                            'price' => (int)$product['harga'],
                            'quantity' => (int)$detail['jumlah'],
                            'name' => $product['nama'],
                        ];
                        $totalHargaRecalculated += (int)$product['harga'] * (int)$detail['jumlah'];
                    }
                }

                // Tambahkan ongkir lagi
                $midtrans_items[] = [
                    'id' => 'SHIPPING-' . $orderId,
                    'price' => (int) $transaction['ongkir'],
                    'quantity' => 1,
                    'name' => 'Biaya Pengiriman',
                ];
                $totalHargaRecalculated += (int)$transaction['ongkir'];

                $customer_details = [
                    'first_name' => $transaction['username'],
                    'email' => session()->get('email') ?? 'pelanggan@example.com',
                    'phone' => '081234567890',
                    'address' => $transaction['alamat'],
                ];

                $transaction_details = [
                    'order_id' => 'TRX-' . $orderId . '-' . time(),
                    'gross_amount' => (int) $totalHargaRecalculated,
                ];

                $params = [
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $midtrans_items,
                ];

                try {
                    $snapToken = Snap::getSnapToken($params);
                    // Update transaksi di database dengan snap_token dan midtrans_transaction_id yang baru
                    $this->transaction->update($orderId, [
                        'snap_token' => $snapToken,
                        'midtrans_transaction_id' => $transaction_details['order_id']
                    ]);
                    $transaction['snap_token'] = $snapToken;
                    $transaction['midtrans_transaction_id'] = $transaction_details['order_id'];
                    $transaction['total_harga'] = $totalHargaRecalculated;
                } catch (\Exception $e) {
                    log_message('error', 'Gagal membuat ulang snap token untuk pesanan ' . $orderId . ': ' . $e->getMessage());
                    return redirect()->to(base_url('profile'))->with('error', 'Transaksi tidak dapat diproses. Silakan hubungi admin.');
                }
            } else {
                // Jika transaksi tidak ditemukan sama sekali
                return redirect()->to(base_url('profile'))->with('error', 'Transaksi tidak ditemukan atau belum diproses.');
            }
        }

        $data['snap_token'] = $transaction['snap_token'];
        $data['transaction'] = $transaction;

        return view('v_payment', $data);
    }

    public function midtransCallback()
    {
        // Fungsi ini adalah endpoint yang akan dipanggil Midtrans (webhook)
        // setiap kali ada perubahan status transaksi di Midtrans.

        // Ambil data notifikasi dari Midtrans
        $json = file_get_contents('php://input');
        $result = json_decode($json);

        // Untuk debugging, simpan log notifikasi yang diterima
        log_message('info', 'Midtrans Callback Diterima: ' . json_encode($result));

        if (empty($result)) {
            // Jika data callback kosong, kembalikan error
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data callback tidak valid.']);
        }

        // Verifikasi signature key
        // Ini memastikan notifikasi benar-benar datang dari Midtrans dan tidak dimanipulasi
        $hashed = hash('sha512', $result->order_id . $result->status_code . $result->gross_amount . Config::$serverKey);

        if ($hashed != $result->signature_key) {
            log_message('error', 'Midtrans Callback: Signature key tidak valid untuk order ' . $result->order_id);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Signature key tidak valid.']);
        }

        $transactionStatus = $result->transaction_status;
        $orderIdMidtrans = $result->order_id;

        // Ambil ID pesanan lokal kita dari orderId Midtrans
        $parts = explode('-', $orderIdMidtrans);
        $localOrderId = $parts[1];

        // Cari transaksi di database kita berdasarkan ID lokal
        $transaction = $this->transaction->find($localOrderId);

        if (!$transaction) {
            log_message('error', 'Midtrans Callback: Transaksi lokal tidak ditemukan untuk ID ' . $localOrderId);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi tidak ditemukan di database lokal.']);
        }

        // Update status transaksi di database berdasarkan status dari Midtrans
        $updateStatus = null;
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            if ($result->fraud_status == 'accept') {
                $updateStatus = '1'; // Status Selesai
            }
        } elseif ($transactionStatus == 'pending') {
            $updateStatus = '0'; // Status Belum Selesai (Pending)
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $updateStatus = '2'; // Status Dibatalkan/Kadaluarsa
        }

        if ($updateStatus !== null) {
            $this->transaction->update($localOrderId, ['status' => $updateStatus]);
            log_message('info', 'Midtrans Callback: Status pesanan ' . $localOrderId . ' diupdate menjadi ' . $updateStatus);
        } else {
            log_message('info', 'Midtrans Callback: Tidak ada perubahan status untuk pesanan ' . $localOrderId . '. Status saat ini: ' . $transactionStatus);
        }

        // Beri respons sukses ke Midtrans agar tidak mengirim notifikasi berulang
        return $this->response->setJSON(['status' => 'success', 'message' => 'Notifikasi berhasil diproses.']);
    }
}
