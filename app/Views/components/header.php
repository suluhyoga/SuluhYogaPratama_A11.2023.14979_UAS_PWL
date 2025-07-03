<?php
$session = session();
$username = $session->get('username') ?? null;
$role = $session->get('role') ?? null;
$formattedUsername = $username ? ucfirst($username) : '';
$formattedRole = $role ? ucfirst($role) : '';
?>

<nav style="background-color: #fcefbb;">
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

        <!-- Menu User Logout & Profile -->
        <?php if ($username && $role): ?>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">
                    <i class='fas fa-user-alt' style='font-size:22px; margin-right:12px;'> </i><?= esc($formattedUsername) ?> <small>(<?= esc($formattedRole) ?>)</small> ▼
                </a>
                <div class="dropdown-content">
                    <a href="<?= base_url('logout'); ?>">Logout</a>
                    <?php if (session()->get('role') == 'guest'): ?>
                        <a href="<?= base_url('profile'); ?>">Profile</a>
                    <?php elseif (session()->get('role') == 'admin'): ?>
                        <a href="<?= base_url('admin/riwayat'); ?>">Riwayat</a>
                    <?php endif; ?>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</nav>