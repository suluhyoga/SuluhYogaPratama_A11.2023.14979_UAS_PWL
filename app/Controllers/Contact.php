<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Contact extends BaseController
{
    public function submit()
    {
        $model = new FeedbackModel();

        if (!$this->validate([
            'nm'   => 'required',
            'almt' => 'required',
            'eml'  => 'required|valid_email',
            'psn'  => 'required'
        ])) {
            return redirect()->to('/kontak')->withInput()->with('error', 'Harap isi semua kolom dengan benar.');
        }

        $model->save([
            'nama'   => $this->request->getPost('nm'),
            'alamat' => $this->request->getPost('almt'),
            'email'  => $this->request->getPost('eml'),
            'pesan'  => $this->request->getPost('psn')
        ]);

        return redirect()->to('/kontak')->with('message', 'Pesan berhasil dikirim!');
    }
}
