<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Tambah User Management</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('user.store') ?>" method="post">
                        <input class="form-control mt-4" placeholder="Nama Pengguna Baru" type="text" name="name" required>
                        <input class="form-control mt-4" placeholder="Email Pengguna Baru" type="email" name="email" required>
                        <label class="mt-4" for="role">Pilih Level Pengguna</label>
                        <select class="form-control" name="role" required>
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                            <option value="3">Kepala Sekolah</option>
                        </select>
                        <input class="form-control mt-4" placeholder="Password Pengguna Baru" type="password" name="password">
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