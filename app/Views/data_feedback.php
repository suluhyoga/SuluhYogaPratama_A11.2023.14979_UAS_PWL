<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<div class="hero2">
    <div class="content2">
        <p class="content-top">MANAGEMENT FEEDBACK</p>
        <table class="table-feedback">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback as $index => $feedback) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($feedback['nama']) ?></td>
                        <td><?= esc($feedback['alamat']) ?></td>
                        <td><?= esc($feedback['email']) ?></td>
                        <td><?= esc($feedback['pesan']) ?></td>
                        <td>
                            <a href="<?= base_url('data_feedback/delete/' . $feedback['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                                Selesai
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
