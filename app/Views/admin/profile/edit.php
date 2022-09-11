<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Edit Profile</h2>
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <button type="button" class="btn btn-primary" disabled>Ubah Data Pribadi</button>
                <div class="card-body">
                    <form action="<?php echo route_to('profile.update', $profile["id"]) ?>" method="post">
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-3">
                                <label for="inputName" class="col-form-label"><b>Name</b></label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" id="inputName" value="<?= $profile['name'] ?>" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-3">
                                <label for="inputEmail" class="col-form-label"><b>Email</b></label>
                            </div>
                            <div class="col-md-8">
                                <input class="form-control" id="inputEmail" value="<?= $profile['email'] ?>" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-3">
                                <label class="mt-3" for="role"><b>Pilih Role</b></label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control" name="role_id" required>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?= $role["id"] ?>" <?= $role["id"] == $profile["role_id"] ? "selected" : ""; ?>><?= $role["role_display"] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <button type="button" class="btn btn-primary" disabled>Ganti Password</button>
                <div class="card-body">
                    <form action="<?php echo route_to('profile.update.pwd', $profile["id"]) ?>" method="post">
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-5">
                                <label for="inputPasswordLama" class="col-form-label"><b>Password Lama</b></label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="inputPasswordLama" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-5">
                                <label for="inputPasswordBaru" class="col-form-label"><b>Password Baru</b></label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="inputPasswordBaru" type="password" name="new_password" required>
                            </div>
                        </div>
                        <div class="row mt-4 g-3 align-items-center">
                            <div class="col-md-5">
                                <label for="inputKonfirmasiPassword" class="col-form-label"><b>Konfirmasi Password</b></label>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="inputKonfirmasiPassword" type="password" name="c_password" required>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-outline-primary">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>