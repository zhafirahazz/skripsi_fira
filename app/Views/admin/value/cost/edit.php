<?php $this->extend('templates/admin/admin_layout')?>

<?php $this->section('content')?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Edit Cost Value</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('cost_value.update', $value["id"]) ?>" method="post">
                    <input required class="form-control mt-4" value="<?= $value['name_cost'] ?>" type="text" name="name">
                    <input required class="form-control mt-4" value="<?= $value['price'] ?>" type="text" name="price">
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
