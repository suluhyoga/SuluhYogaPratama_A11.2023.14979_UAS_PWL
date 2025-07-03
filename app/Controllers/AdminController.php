<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse; // Import ini untuk tipe return yang eksplisit

class AdminController extends BaseController
{
    public function riwayat(): RedirectResponse // Menentukan tipe return sebagai RedirectResponse
    {
        // Log untuk melacak apakah fungsi ini diakses
        log_message('info', 'AdminController::riwayat method accessed.');

        // Pastikan hanya admin yang bisa mengakses halaman ini
        if (session()->get('role') !== 'admin') {
            log_message('warning', 'AdminController::riwayat - Unauthorized access attempt by role: ' . session()->get('role'));
            return redirect()->to(base_url('beranda'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // URL ke file dashboard transaksi di htdocs
        // PASTIKAN URL INI BENAR DAN BISA DIAKSES LANGSUNG DI BROWSER
        $externalDashboardUrl = 'http://localhost/dashboard_sembako/index.php';

        // Log untuk melacak URL redirect
        log_message('info', 'AdminController::riwayat - Attempting redirect to: ' . $externalDashboardUrl);

        // Lakukan redirect ke URL eksternal
        // Ini akan mengirim HTTP header 'Location' ke browser
        return redirect()->to($externalDashboardUrl);
    }
}
