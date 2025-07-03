<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="hero2">
    <div class="content2">
        <p class="content-top">History Pembelian <strong>"<?= $username ?>"</strong></p>

        <div class="table-responsive">
            <table class="table-profile">
                <thead>
                    <tr>
                        <th scope="col">N0</th>
                        <th scope="col">ID Pembelian</th>
                        <th scope="col">Waktu Pembelian</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($buy)) :
                        foreach ($buy as $index => $item) :
                    ?>
                            <tr>
                                <th scope="row"><?php echo $index + 1 ?></th>
                                <td><?php echo $item['id'] ?></td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td><?php echo number_to_currency($item['total_harga'], 'IDR') ?></td>
                                <td><?php echo $item['alamat'] ?></td>
                                <td>
                                    <?php
                                    // Menampilkan status berdasarkan nilai di database
                                    if ($item['status'] == '1') {
                                        echo "<span class='badge bg-success'>Sudah Selesai</span>";
                                    } elseif ($item['status'] == '0' || $item['status'] == 'pending') {
                                        echo "<span class='badge bg-warning text-dark'>Belum Selesai (Pending)</span>";
                                    } elseif ($item['status'] == '2') {
                                        echo "<span class='badge bg-danger'>Dibatalkan/Kadaluarsa</span>";
                                    } else {
                                        echo "<span class='badge bg-secondary'>Status Tidak Dikenal</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button style="margin-bottom: 10px;" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-<?= $item['id'] ?>">
                                        Detail
                                    </button>
                                    <?php if ($item['status'] == '0' || $item['status'] == 'pending') :
                                    ?>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='<?= base_url('checkout/payment/' . $item['id']) ?>'">
                                            Lanjutkan Pembayaran
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!-- Detail Modal Begin -->
                            <div class="modal fade" id="detailModal-<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Data Pembelian #<?= $item['id'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Item yang Dibeli:</h6>
                                            <?php
                                            if (!empty($product) && isset($product[$item['id']])) {
                                                foreach ($product[$item['id']] as $index2 => $item2) : ?>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span><?php echo $index2 + 1 . ") " ?></span>
                                                        <?php if ($item2['foto'] != '' && file_exists("assets/img/product/" . $item2['foto'])) : ?>
                                                            <img src="<?php echo base_url("assets/img/product/" . $item2['foto']) ?>" width="50px" class="me-2">
                                                        <?php endif; ?>
                                                        <div>
                                                            <strong><?= $item2['nama'] ?></strong><br>
                                                            <?= number_to_currency($item2['harga'], 'IDR') ?> x <?= $item2['jumlah'] ?> pcs<br>
                                                            Subtotal: <?= number_to_currency($item2['subtotal_harga'], 'IDR') ?>
                                                        </div>
                                                    </div>
                                                    <hr class="my-1">
                                            <?php
                                                endforeach;
                                            } else {
                                                echo "<p>Tidak ada detail produk untuk pesanan ini.</p>";
                                            }
                                            ?>
                                            <p class="mt-3 mb-1">Ongkir: <?= number_to_currency($item['ongkir'], 'IDR') ?></p>
                                            <p class="mb-1">Total Bayar: <strong><?= number_to_currency($item['total_harga'], 'IDR') ?></strong></p>
                                            <p class="mb-1">Alamat Pengiriman: <?= $item['alamat'] ?></p>
                                            <p class="mb-1">Status Pembayaran: <strong>
                                                    <?php
                                                    if ($item['status'] == '1') {
                                                        echo "Sudah Selesai";
                                                    } elseif ($item['status'] == '0' || $item['status'] == 'pending') {
                                                        echo "Belum Selesai (Pending)";
                                                    } elseif ($item['status'] == '2') {
                                                        echo "Dibatalkan/Kadaluarsa";
                                                    } else {
                                                        echo "Status Tidak Dikenal";
                                                    }
                                                    ?>
                                                </strong></p>
                                            <?php if ($item['midtrans_transaction_id']) : ?>
                                                <p class="mb-0">ID Transaksi Midtrans: <strong><?= $item['midtrans_transaction_id'] ?></strong></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Modal End -->
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div><br><br><br><br><br><br><br>
</div>

<?= $this->endSection() ?>