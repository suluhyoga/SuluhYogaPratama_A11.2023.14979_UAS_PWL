<?php

namespace App\Controllers;

use App\Models\CategoryModel; 
use App\Models\ProductModel; 
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{
    public function homepage()
    {
        return view('index');
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }

    protected $category;
    protected $product;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->category = new CategoryModel();
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function profile()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }

    public function product()
    {
        $category = $this->category->findAll();
        $data['category'] = $category;
        return view('product', $data);
    }

    public function product_beras()
    {
        $berasCategory = $this->category->where('kategori', 'BERAS')->first();

        $data['product'] = [];

        if ($berasCategory) { 
            $kategoriIdBeras = $berasCategory['id']; 
            $product = $this->product->where('kategori_id', $kategoriIdBeras)->findAll();
            $data['product'] = $product;
        }

        return view('product_beras', $data);
    }

    public function product_gulapasir()
    {
        $gulaCategory = $this->category->where('kategori', 'GULA PASIR')->first();

        $data['product'] = [];
        if ($gulaCategory) {
            $kategoriIdGula = $gulaCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdGula)->findAll();
            $data['product'] = $product;
        }
        return view('product_gulapasir', $data);
    }

    public function product_mieinstan()
    {
        $mieCategory = $this->category->where('kategori', 'MIE INSTAN')->first();

        $data['product'] = [];
        if ($mieCategory) {
            $kategoriIdMie = $mieCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdMie)->findAll();
            $data['product'] = $product;
        }
        return view('product_mieinstan', $data);
    }

    public function product_minyakgoreng()
    {
        $minyakCategory = $this->category->where('kategori', 'MINYAK GORENG')->first();

        $data['product'] = [];
        if ($minyakCategory) {
            $kategoriIdMinyak = $minyakCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdMinyak)->findAll();
            $data['product'] = $product;
        }
        return view('product_minyakgoreng', $data);
    }
    public function product_kecap()
    {
        $kecapCategory = $this->category->where('kategori', 'KECAP')->first();

        $data['product'] = [];
        if ($kecapCategory) {
            $kategoriIdKecap = $kecapCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdKecap)->findAll();
            $data['product'] = $product;
        }
        return view('product_kecap', $data);
    }
    public function product_sarden()
    {
        $sardenCategory = $this->category->where('kategori', 'SARDEN')->first();

        $data['product'] = [];
        if ($sardenCategory) {
            $kategoriIdSarden = $sardenCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdSarden)->findAll();
            $data['product'] = $product;
        }
        return view('product_sarden', $data);
    }
    public function product_teh()
    {
        $tehCategory = $this->category->where('kategori', 'TEH')->first();

        $data['product'] = [];
        if ($tehCategory) {
            $kategoriIdTeh = $tehCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdTeh)->findAll();
            $data['product'] = $product;
        }
        return view('product_teh', $data);
    }
    public function product_sirup()
    {
        $sirupCategory = $this->category->where('kategori', 'SIRUP')->first();

        $data['product'] = [];
        if ($sirupCategory) {
            $kategoriIdSirup = $sirupCategory['id'];
            $product = $this->product->where('kategori_id', $kategoriIdSirup)->findAll();
            $data['product'] = $product;
        }
        return view('product_sirup', $data);
    }
    public function data_product()
    {
        return view('data_product');
    }

    public function data_category()
    {
        return view('data_category');
    }
    public function data_feedback()
    {
        return view('data_feedback');
    }
}
