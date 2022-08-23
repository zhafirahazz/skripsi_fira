<?php $this->extend('templates/admin/admin_layout')?>

<?php $this->section('content')?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Tambah Student Management</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('student.store') ?>" method="post">
                    <input class="form-control mt-4" placeholder="Nama Siswa" type="text" name="name">
                    <label class="mt-4" for="class">Pilih Kelas Siswa</label>
                    <select class="form-control" name="class">
                        <option value="1">Kelas X</option>
                        <option value="2">Kelas XI</option>
                        <option value="3">Kelas XII</option>
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
