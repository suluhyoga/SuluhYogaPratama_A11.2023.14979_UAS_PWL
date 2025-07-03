<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<body>

    <div class="hero2">
        <div class="content2">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <p class="content-top">PRODUK KAMI</p>
            <p class="content-top-isi">
                Berikut adalah berbagai pilihan sembako berkualitas untuk kebutuhan harian anda. Dari beras pilihan, gula pasir, minyak goreng segar, hingga berbagai bumbu dapur seperti bawang merah, bawang putih, dan gula aren.
                Semua produk kami dipilih dengan cermat untuk memastikan anda mendapatkan yang terbaik. Kami hadir untuk memudahkan anda memenuhi kebutuhan pokok dengan mudah dan cepat. Jelajahi produk kami dan temukan semua
                yang anda butuhkan untuk keluarga.
            </p>
            <div class="container-product">
                <!-- Card Otomatis -->
                <?php foreach ($category as $key => $item) : ?>
                    <div class="card">
                        <div class="img-card">
                            <img src="<?php echo base_url() . "assets/img/product/" . $item['foto'] ?>" alt="<?= esc($item['kategori']); ?>" width="100%" class="gambar">
                        </div>
                        <div>
                            <p class="nama-produk"><?php echo esc($item['kategori']) ?></p>
                            <p class="mini-detail">Sembako<span>ku</span></p>
                            <div class="btn-block">
                                <button class="button-product">
                                    <a href="<?= base_url('product/product_' . strtolower(str_replace(' ', '', $item['kategori']))); ?>">Info Detail</a>
                                    </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

</body>
<?= $this->endSection() ?>