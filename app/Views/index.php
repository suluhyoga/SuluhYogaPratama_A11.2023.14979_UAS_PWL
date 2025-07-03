<?php
$hlm = "Beranda";
if (uri_string() != "") {
    $hlm = ucwords(uri_string());
}
$session = session();
$username = $session->get('username') ?? null;
$role = $session->get('role') ?? null;
$formattedUsername = $username ? ucfirst($username) : '';
$formattedRole = $role ? ucfirst($role) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SembakoKu - <?php echo $hlm ?></title>

    <!-- import font poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- import font awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>

<body>

    <div class="hero">
        <nav>
            <div class="logo">
                <a href="<?= base_url(); ?>"><img src="<?= base_url('assets/img/logo/logo.png'); ?>" alt="Logo"></a>
            </div>

            <ul>
                <!-- Menu Beranda -->
                <li>
                    <a href="<?= base_url('beranda'); ?>">Beranda</a>
                </li>

                <!-- Menu Tentang Kami -->
                <?php
                if (session()->get('role') == 'guest') {
                ?>
                    <li>
                        <a href="<?= base_url('tentang'); ?>">Tentang Kami</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Produk -->
                <?php
                if (session()->get('role') == 'guest') {
                ?>
                    <li>
                        <a href="<?= base_url('produk'); ?>">Produk</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Kontak -->
                <?php
                if (session()->get('role') == 'guest') {
                ?>
                    <li>
                        <a href="<?= base_url('kontak'); ?>">Kontak</a>
                    </li>
                <?php
                }
                ?>

                 <!-- Menu Keranjang -->
                <?php
                if (session()->get('role') == 'guest') {
                ?>
                    <li>
                        <a href="<?= base_url('keranjang'); ?>">Keranjang</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Data Produk -->
                <?php
                if (session()->get('role') == 'admin') {
                ?>
                    <li>
                        <a href="<?= base_url('data_product'); ?>">Data Produk</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Data Kategori -->
                <?php
                if (session()->get('role') == 'admin') {
                ?>
                    <li>
                        <a href="<?= base_url('data_category'); ?>">Data Kategori</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Data User -->
                <?php
                if (session()->get('role') == 'admin') {
                ?>
                    <li>
                        <a href="<?= base_url('data_user'); ?>">Data User</a>
                    </li>
                <?php
                }
                ?>

                <!-- Menu Data Feedback -->
                <?php
                if (session()->get('role') == 'admin') {
                ?>
                    <li>
                        <a href="<?= base_url('data_feedback'); ?>">Feedback</a>
                    </li>
                <?php
                }
                ?>

                <li>
                    <a><strong>│</strong></a>
                </li>

                <!-- Menu User Logout -->
                <?php if ($username && $role): ?>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">
                            <i class='fas fa-user-alt' style='font-size:22px; margin-right:12px;'> </i><?= esc($formattedUsername) ?> <small>(<?= esc($formattedRole) ?>)</small> ▼
                        </a>
                        <div class="dropdown-content">
                            <a href="<?= base_url('logout'); ?>">Logout</a>
                            <?php
                            if (session()->get('role') == 'guest') {
                            ?>
                                <a href="<?= base_url('profile'); ?>">Profile</a>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="home">
            <div class="content">
                <h4>Selamat datang di,</h4>
                <h1>Toko Sembako <span>Ku</span></h1>
                <h4>Sembako Segar, Harga Terjangkau!</h4>
                <h5>Kami menyediakan berbagai kebutuhan sembako <br>
                    berkualitas untuk memenuhi kebutuhan harian anda. <br>
                    Dengan pelayanan yang cepat dan harga yang terjangkau, <br>
                    belanja sembako jadi lebih mudah
                </h5>
                <?php
                if (session()->get('role') == 'guest') {
                ?>
                    <a href="<?= base_url('produk'); ?>" class="btn-produk"><i class="fa-brands fa-shopify"></i> Produk Kami</a>
                <?php
                }
                ?>
            </div>
            <div class="img-home">
                <img src="<?= base_url('assets/img/home/home_1.png'); ?>" alt="">
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>