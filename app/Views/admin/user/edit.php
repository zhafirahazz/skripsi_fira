<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Ubah User Management</h2>

    <div>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo ($_SESSION['error']) ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['warning'])) : ?>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo ($_SESSION['alert']) ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo ($_SESSION['success']) ?>
            </div>
        <?php endif ?>
    </div>
    <div class="row mt-4">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('user.update', $user["id"]) ?>" method="post">
                        <input class="form-control mt-4" placeholder="Nama Pengguna Baru" type="text" name="name" value="<?php echo ($user["name"]) ?>" />
                        <input class="form-control mt-4" placeholder="Email Pengguna Baru" type="email" name="email" value="<?php echo ($user["email"]) ?>" />
                        <label class="mt-4" for="role">Pilih Level Pengguna</label>
                        <select class="form-control" name="role" selected="<?php echo ($user["role_id"]) ?>">
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">Kepala Sekolah</option>
                        </select>
                        <input class="form-control mt-4" placeholder="Password Baru" type="password" name="new_password">
                        <input class="form-control mt-4" placeholder="Konfirmasi Password Baru" type="password" name="c_password">
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>