<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<body>
    <div class="hero2">
        <div class="content2">
            <p class="content-top">MANAGEMENT KATEGORI</p>

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

            <table class="table-kategori">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($category as $index => $category) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($category['kategori']) ?></td>
                            <td>
                                <?php if (!empty($category['foto']) && file_exists("assets/img/product/" . $category['foto'])) : ?>
                                    <img src="<?= base_url("assets/img/product/" . esc($category['foto'])) ?>" alt="Foto Produk">
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $category['id'] ?>">
                                    Ubah
                                </button>
                            </td>
                        </tr>
                        <!-- Edit Modal Begin -->
                        <div class="modal fade" id="editModal-<?= $category['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?= base_url('data_category/edit/' . $category['id']) ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Kategori</label>
                                                <input type="text" name="kategori" class="form-control" id="kategori" value="<?= $category['kategori'] ?>" placeholder="kategori Barang" required>
                                            </div>
                                            <img src="<?php echo base_url() . "assets/img/product/" . $category['foto'] ?>" width="100px">
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
        </div>
    </div>
</body>

<?= $this->endSection() ?>