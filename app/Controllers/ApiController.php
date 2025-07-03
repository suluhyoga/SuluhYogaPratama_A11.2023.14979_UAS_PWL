<?php

namespace App\Controllers; // PASTIKAN NAMESPACE INI BENAR (App\Controllers, bukan App\Controllers\Api)

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel; // Jika Anda menggunakan UserModel, pastikan ini ada
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class ApiController extends ResourceController // PASTIKAN NAMA KELAS INI BENAR (ApiController)
{
    use ResponseTrait;

    protected $apiKey;
    protected $user;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        $this->apiKey = env('API_KEY'); // Pastikan 'API_KEY' ada di file .env Anda
        $this->user = new UserModel(); // Jika Anda menggunakan UserModel
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index() // PASTIKAN NAMA FUNGSI INI BENAR (index)
    {
        $data = [
            'results' => [],
            'status' => ["code" => 401, "description" => "Unauthorized"]
        ];

        $headers = $this->request->headers();

        array_walk($headers, function (&$value, $key) {
            $value = $value->getValue();
        });

        if (array_key_exists("Key", $headers)) { // Perhatikan 'Key' dengan K kapital
            if ($headers["Key"] == $this->apiKey) {
                $penjualan = $this->transaction->findAll();

                foreach ($penjualan as &$pj) {
                    $pj['details'] = $this->transaction_detail->where('transaction_id', $pj['id'])->findAll();
                }

                $data['status'] = ["code" => 200, "description" => "OK"];
                $data['results'] = $penjualan;
            }
        }

        return $this->respond($data);
    }

    // Metode lain (show, new, create, edit, update, delete)
    // Biarkan kosong jika tidak digunakan, atau isi sesuai kebutuhan
    public function show($id = null) {}
    public function new() {}
    public function create() {}
    public function edit($id = null) {}
    public function update($id = null) {}
    public function delete($id = null) {}
}
