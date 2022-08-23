<?php $this->extend('templates/admin/admin_layout')?>

<?php $this->section('content')?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Edit Student Management</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('student.update', $student["id"]) ?>" method="post">
                    <input class="form-control mt-4" value="<?= $student['name'] ?>" type="text" name="name">
                    <label class="mt-4" for="class">Pilih Kelas Siswa</label>
                    <select class="form-control" name="class_id">
                            <?php foreach ($classes as $class) : ?>
                                <option value="<?= $class["id"] ?>" <?= $class["id"] == $student["class_id"] ? "selected" : ""; ?>><?= $class["class_display"] ?></option>
                            <?php endforeach ?>
                        </select>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection()?>
