<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<style>
    
</style>

<div class="hero2">
    <div class="content2">
        <p class="content-top">MANAGEMENT PRODUK</p>

        <?php
        if (session()->getFlashData('success')) {
        ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (session()->getFlashData('failed')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('failed') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Data
        </button>
        <a href="<?= base_url('data_product/download') ?>" class="btn btn-danger mb-0" target="_blank">
            Download PDF
        </a>


        <table class="table-produk">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product as $index => $produk) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($produk['nama']) ?></td>
                        <td>Rp. <?= number_format($produk['harga'], 0, ',', '.') ?></td> 
                        <td><?= esc($produk['satuan']) ?></td>
                        <td><?= esc($produk['kategori_id']) ?></td>
                        <td><?= esc($produk['jumlah']) ?></td>
                        <td>
                            <?php if (!empty($produk['foto']) && file_exists("assets/img/product/" . $produk['foto'])) : ?>
                                <img src="<?= base_url("assets/img/product/" . esc($produk['foto'])) ?>" alt="Foto Produk">
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                                Ubah
                            </button>
                            <a href="<?= base_url('data_product/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <!-- Edit Modal Begin -->
                    <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('data_product/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $produk['nama'] ?>" placeholder="Nama Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Harga</label>
                                            <input type="text" name="harga" class="form-control" id="harga" value="<?= $produk['harga'] ?>" placeholder="Harga Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Satuan</label>
                                            <input type="text" name="satuan" class="form-control" id="satuan" value="<?= $produk['satuan'] ?>" placeholder="Satuan Barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori_id_edit_<?= $produk['kategori_id'] ?>">Kategori</label>
                                            <select name="kategori_id" id="kategori_id_edit_<?= $produk['kategori_id'] ?>" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= esc($category['id']) ?>" <?= ($produk['kategori_id'] == $category['id']) ? 'selected' : '' ?>>
                                                        <?= esc($category['kategori']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Jumlah</label>
                                            <input type="text" name="jumlah" class="form-control" id="jumlah" value="<?= $produk['jumlah'] ?>" placeholder="Jumlah Barang" required>
                                        </div>
                                        <img src="<?php echo base_url() . "assets/img/product/" . $produk['foto'] ?>" width="100px">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                            <label class="form-check-label" for="check">
                                                Ceklis jika ingin mengganti foto
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Foto</label>
                                            <input type="file" class="form-control" id="foto" name="foto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal End -->
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Add Modal Begin -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('data_product') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Harga</label>
                                <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Satuan</label>
                                <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Satuan Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id_add">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= esc($category['id']) ?>"><?= esc($category['kategori']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Modal End -->

    </div>
</div>

<?= $this->endSection() ?>
