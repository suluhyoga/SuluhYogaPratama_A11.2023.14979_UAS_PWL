<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use Dompdf\Dompdf;
use Dompdf\Options;


class ProdukController extends BaseController
{
    protected $product; 
    protected $category;

    function __construct()
    {
        $this->product = new ProductModel();
        $this->category = new CategoryModel();
    }

    public function index()
    {
        $product = $this->product->findAll();
        $categories = $this->category->findAll();
        $data['product'] = $product;
        $data['categories'] = $categories;

        return view('data_product', $data);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'satuan' => $this->request->getPost('satuan'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'jumlah' => $this->request->getPost('jumlah'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['foto'] = $fileName;
            $dataFoto->move('assets/img/product/', $fileName);
        }

        $this->product->insert($dataForm);

        return redirect('data_product')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataProduk = $this->product->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'satuan' => $this->request->getPost('satuan'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'jumlah' => $this->request->getPost('jumlah'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("assets/img/product/" . $dataProduk['foto'] . "")) {
                unlink("assets/img/product/" . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('assets/img/product/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);

        return redirect('data_product')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk['foto'] != '' and file_exists("assets/img/product/" . $dataProduk['foto'] . "")) {
            unlink("assets/img/product/" . $dataProduk['foto']);
        }

        $this->product->delete($id);

        return redirect('data_product')->with('success', 'Data Berhasil Dihapus');
    }
    public function download()
{
    // Set memory limit dan execution time
    ini_set('memory_limit', '1024M');
    ini_set('max_execution_time', 300);
    
    // Clear any existing output buffer
    if (ob_get_level()) {
        ob_end_clean();
    }
    
    try {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        // Konfigurasi DomPDF yang dioptimalkan
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isFontSubsettingEnabled', false); // Matikan untuk menghemat memory
        $options->set('defaultFont', 'Arial'); // Font default yang ringan
        $options->set('dpi', 96); // Turunkan DPI untuk menghemat memory
        $options->set('tempDir', WRITEPATH . 'cache/'); // Set temp directory
        
        $dompdf = new \Dompdf\Dompdf($options);

        // Load view dengan error handling
        $html = view('v_produkPDF', ['product' => $products]);
        
        if (empty($html)) {
            throw new \Exception('HTML content is empty');
        }

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        
        // Render dengan error handling
        $dompdf->render();

        // Stream PDF
        $dompdf->stream('daftar-produk.pdf', ['Attachment' => false]);
        
    } catch (\Exception $e) {
        // Log error dan tampilkan pesan yang user-friendly
        log_message('error', 'PDF Generation Error: ' . $e->getMessage());
        
        // Redirect dengan pesan error
        return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
    }
}
}