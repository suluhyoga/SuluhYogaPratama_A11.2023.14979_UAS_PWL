<?php
// Mendapatkan nama halaman saat ini untuk ditampilkan di judul browser
$hlm = "Beranda";
if (uri_string() != "") {
    $uri = uri_string();
    $uri = str_replace('product/', '', $uri);
    $uri = str_replace('_', ' ', $uri);
    $hlm = ucwords($uri);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SembakoKu - <?php echo $hlm ?></title>

    <!-- Custom CSS Anda -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

    <!-- Import Font Poppins dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- Import Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Import Bootstrap 5 CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Import Bootstrap Icons CSS dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Import Select2 CSS untuk dropdown yang lebih baik -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Midtrans Snap.js (Sandbox untuk pengembangan) -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?= env('MIDTRANS_CLIENT_KEY'); ?>"></script>

</head>

<body>
    <!-- Memuat komponen header (misalnya navigasi, logo) -->
    <?= $this->include('components/header') ?>

    <!-- Bagian ini akan diisi dengan konten spesifik dari setiap halaman (misalnya v_checkout, v_keranjang, v_profile) -->
    <?= $this->renderSection('content') ?>

    <!-- Memuat komponen footer -->
    <?= $this->include('components/footer') ?>

    <!-- jQuery: Diperlukan oleh Select2 dan mungkin script Anda sendiri -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle dengan Popper: Untuk fungsionalitas Bootstrap (modal, dropdown, dll.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS: Untuk fungsionalitas dropdown pencarian kelurahan -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bagian ini akan diisi dengan script JavaScript khusus untuk setiap halaman -->
    <?= $this->renderSection('script') ?>

</body>

</html>