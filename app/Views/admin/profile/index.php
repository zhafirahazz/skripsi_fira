<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h4><u><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</u></h4>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                        <label for="" class="col-form-label">:</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="staticName" value="<?= $profiles['name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <label for="" class="col-form-label">:</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $profiles['email'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="staticRole" class="col-sm-2 col-form-label">Role</label>
                        <label for="" class="col-form-label">:</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="staticRole" value="<?= $profiles['role_display'] ?>">
                        </div>
                    </div>
                    <a href="<?php echo route_to('profile.edit', $profiles["id"]) ?>"><button class="btn btn-outline-primary">
                            <i class="fa-solid fa-pen-to-square fa-fw"></i> Edit</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>