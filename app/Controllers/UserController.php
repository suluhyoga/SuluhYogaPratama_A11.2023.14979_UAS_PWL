<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user; 

    function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $user = $this->user->findAll();
        $data['user'] = $user;

        return view('data_user', $data);
    }

    public function create()
    {
        $dataForm = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->user->insert($dataForm);

        return redirect('data_user')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataUser = $this->user->find($id);

        $dataForm = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->user->update($id, $dataForm);

        return redirect('data_user')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataUser = $this->user->find($id);

        $this->user->delete($id);
        return redirect('data_user')->with('success', 'Data Berhasil Dihapus');
    }

}