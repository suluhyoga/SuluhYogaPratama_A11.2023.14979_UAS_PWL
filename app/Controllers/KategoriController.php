<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class KategoriController extends BaseController
{
    protected $category;

    function __construct()
    {
        $this->category = new CategoryModel();
    }

    public function index()
    {
        $category = $this->category->findAll();
        $data['category'] = $category;

        return view('data_category', $data);
    }

    public function edit($id)
    {
        $dataKategori = $this->category->find($id);

        $dataForm = [
            'kategori' => $this->request->getPost('kategori'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            if ($dataKategori['foto'] != '' and file_exists("assets/img/product/" . $dataKategori['foto'] . "")) {
                unlink("assets/img/product/" . $dataKategori['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('assets/img/product/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->category->update($id, $dataForm);

        return redirect('data_category')->with('success', 'Data Berhasil Diubah');
    }
}