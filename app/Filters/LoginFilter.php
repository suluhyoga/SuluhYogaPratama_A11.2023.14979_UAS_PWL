<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = $session->get('role');
        $segment1 = service('uri')->getSegment(1); // ambil segment pertama setelah domain

        // Kalau role guest, dan mengakses halaman admin
        if ($role === 'guest' && in_array($segment1, [
            'data_product',
            'data_user',
            'data_category',
            'data_feedback'
        ])) {
            return redirect()->to('/beranda')->with('error', 'Akses ditolak untuk guest.');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosong
    }
}
