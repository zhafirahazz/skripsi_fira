<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Edit Teacher Management</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('teacher.update', $teacher["id"]) ?>" method="post">
                        <input class="form-control mt-4" value="<?= $teacher['name'] ?>" type="text" name="name" required>
                        <input class="form-control mt-4" value="<?= $teacher['nip'] ?>" type="text" name="nip" required>
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