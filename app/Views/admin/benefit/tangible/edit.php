<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Edit Tangible Benefit</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('tangible.update', $item["id"]) ?>" method="post">
                        <input class="form-control mt-4" value="<?= $item['benefit'] ?>" type="text" name="benefit">
                        <input class="form-control mt-4" value="<?= $item['quantity'] ?>" type="number" name="quantity">
                        <label class="mt-4" for="class">Pilih Satuan</label>
                        <select class="form-control" name="unit_id">
                            <?php foreach ($units as $unit) : ?>
                                <option value="<?= $unit["id"] ?>" <?= $unit["id"] == $item["unit_id"] ? "selected" : ""; ?>><?= $unit["unit_name"] ?></option>
                            <?php endforeach ?>
                        </select>
                        <input class="form-control mt-4" value="<?= $item['unit_price'] ?>" type="number" name="unit_price">
                        <textarea class="form-control mt-4" name="description"><?= $item['description'] ?></textarea>
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