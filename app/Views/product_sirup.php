<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<body>

    <div class="hero2">
        <div class="content2">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <p class="content-top">PRODUK KAMI</p>
            <p class="content-top-isi">
                Segarkan hari Anda dengan berbagai pilihan sirup manis dari merek terpercaya. Tersedia dalam berbagai rasa buah segar seperti cocopandan,
                jeruk, melon, dan lainnya. Cocok disajikan dingin saat cuaca panas atau sebagai pelengkap berbagai hidangan dan minuman favorit
                keluarga Anda.
            </p>
            <div class="content2-produkdetail">
                <div class="container-product">
                    <?php if (!empty($product)) : ?>
                        <?php foreach ($product as $key => $item) : ?>
                            <div class="card">
                                <div class="img-card">
                                    <img src="<?php echo base_url() . "assets/img/product/" . $item['foto'] ?>" alt="<?= esc($item['nama']); ?>" width="100%" class="gambar">
                                </div>
                                <div>
                                    <p class="nama-produk2"><?php echo esc($item['nama']) ?></p>
                                    <p class="merk">Stok : <?php echo esc($item['jumlah']) ?></p>
                                    <p class="harga">Rp. <?php echo number_format($item['harga'], 0, ',', '.'); ?> <span class="span-harga">/ <?php echo esc($item['satuan']) ?></span></p>
                                    <p class="mini-detail">Sembako<span>ku</span></p>

                                    <!-- Form Tambah ke Keranjang -->
                                    <?= form_open('keranjang/tambah') ?>
                                        <?= csrf_field() ?>
                                        <?= form_hidden('id', $item['id']) ?>
                                        <?= form_hidden('nama', $item['nama']) ?>
                                        <?= form_hidden('harga', $item['harga']) ?>
                                        <?= form_hidden('foto', $item['foto']) ?>
                                        <?= form_hidden('redirect_back', current_url()) ?>

                                        <button type="submit" class="btn btn-success btn-sm mt-2 w-100">
                                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <p>Tidak ada produk sirup yang ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="btn-block-detail text-center mt-4">
                <button class="button-product-detail"><a href="<?= base_url('produk'); ?>">Kembali</a></button>
            </div>
        </div>
    </div>

</body>

</html>
<?= $this->endSection() ?>