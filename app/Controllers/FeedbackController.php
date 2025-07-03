<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class FeedbackController extends BaseController
{
    protected $feedback; 

    function __construct()
    {
        $this->feedback = new FeedbackModel();
    }

    public function index()
    {
        $feedback = $this->feedback->findAll();
        $data['feedback'] = $feedback;

        return view('data_feedback', $data);
    }

    public function delete($id)
    {
        $dataFeedback = $this->feedback->find($id);
        $this->feedback->delete($id);

        return redirect('data_feedback')->with('success', 'Data Berhasil Dihapus');
    }

}