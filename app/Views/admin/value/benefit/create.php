<?php $this->extend('templates/admin/admin_layout')?>

<?php $this->section('content')?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Tambah Benefit Value</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('benefit_value.store') ?>" method="post">
                    <input class="form-control mt-4" placeholder="Nilai Manfaat Baru" type="number" name="name">
                    <input class="form-control mt-4" placeholder="Nominal Nilai Manfaat" type="number" name="nominal">
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
