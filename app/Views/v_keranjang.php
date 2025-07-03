<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="hero2">
    <div class="content2">
        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <p class="content-top">KERANJANG BELANJA</p>
        <?= form_open('keranjang/edit') ?>
        <table class="table-keranjang">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (!empty($items)) :
                    foreach ($items as $item) :
                ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td>
                                <?php if (isset($item['options']['foto']) && $item['options']['foto'] !== '') : ?>
                                    <img src="<?= base_url() ?>assets/img/product/<?= $item['options']['foto'] ?>" 
                                        style="width: 150px; height: 120px; object-fit: cover; border-radius: 8px;" 
                                        alt="<?= esc($item['name']) ?>">
                                <?php else : ?>
                                    <div style="width: 150px; height: 120px; background-color: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <span class="text-muted">Tidak ada gambar</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                            <td>
                                <input type="number" min="1" name="qty[<?= $item['rowid'] ?>]" 
                                    class="form-control" value="<?= $item['qty'] ?>" 
                                    style="width: 80px; text-align: center;">
                            </td>
                            <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" 
                                class="btn btn-danger btn-sm" 
                                onclick="return confirm('Yakin ingin menghapus item ini?')"
                                title="Hapus item">
                                    <i class="bi bi-trash" style="font-size: 18px;"></i>
                                </a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                else :
                ?>
                    <tr>
                        <td colspan="6" class="text-center">Keranjang masih kosong.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="alert-harga">
            <span class="label-total">Total Belanja:</span>
            <span class="harga-total"><?= number_to_currency($total, 'IDR') ?></span>
        </div>

        <div class="button-keranjang">
            <button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
            <a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>" onclick="return confirm('Kosongkan semua item di keranjang?')">Kosongkan Keranjang</a>
            <?php if (!empty($items)) : ?>
                <a class="btn btn-success" href="<?php echo base_url('') ?>checkout">Selesai Belanja</a>
            <?php endif; ?>
        </div><br><br><br><br><br><br><br><br><br><br>
    </div>
</div>
<?= form_close() ?>
<?= $this->endSection() ?>