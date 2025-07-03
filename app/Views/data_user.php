<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<style>
    
</style>

<div class="hero2">
    <div class="content2">
        <p class="content-top">MANAGEMENT USER</p>

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

        <table class="table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $index => $user) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['password']) ?></td>
                        <td><?= esc($user['role']) ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $user['id'] ?>">
                                Ubah
                            </button>
                            <a href="<?= base_url('data_user/delete/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <!-- Edit Modal Begin -->
                    <div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('data_user/edit/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Username</label>
                                            <input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" placeholder="Masukan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="text" name="email" class="form-control" id="email" value="<?= $user['email'] ?>" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Password</label>
                                            <input type="text" name="password" class="form-control" id="password" value="<?= $user['password'] ?>" placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select name="role" class="form-control" id="role" required>
                                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                <option value="guest" <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
                                            </select>
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
                    <form action="<?= base_url('data_user') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan Email" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan Password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" id="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="guest">Guest</option>
                                </select>
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
