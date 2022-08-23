<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4">Procurement Cost</h2>
    <a class="d-inline align-middle" href="<?php echo route_to('procurement.create') ?>">
        <button class="btn btn-outline-primary btn-sm float-right">Tambah Data</button>
    </a>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Page Heading -->
                Procurement cost atau biaya pengadaan merupakan biaya yang dikeluarkan berhubungan dengan pengadaan hardware/ perangkat keras.
                Biaya ini pada umumnya dikeluarkan pada tahun pertama sebelum suatu investasi dioperasikan.
            </div>
        </div>
        <div class="card shadow">

            <?php if (isset($_SESSION['alert_success'])) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo ($_SESSION['alert_success']) ?>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-success">
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

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #cceeff;">
                            <th>No.</th>
                            <th>Kebutuhan</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $jumlah = 0;
                            foreach ($costs as $index => $cost) :
                                $jumlah += $cost["quantity"] * $cost["unit_price"]; ?>
                                <tr>
                                    <td><?= ($index + 1) ?></td>
                                    <td><?= $cost["necessity"] ?></td>
                                    <td><?= number_format($cost["quantity"]) ?></td>
                                    <td><?= $cost["unit_name"] ?></td>
                                    <td>Rp<?= number_format($cost["unit_price"] ? round($cost["unit_price"]) : 0, 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($cost["quantity"] * $cost["unit_price"], 0, ',', '.') ?></td>
                                    <td><?= $cost["description"] ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="<?php echo route_to('procurement.read', $cost["id"]) ?>"><button class="btn btn-primary btn-sm"><i class="fa-solid fa-eyes fa-fw"></i> Detail</button></a>
                                                <a class="d-inline" href="<?php echo route_to('procurement.edit', $cost["id"]) ?>"><button class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square fa-fw"></i> Edit</button></a>
                                                <form class="d-inline" method="post" action="<?php echo route_to('procurement.delete', $cost["id"]) ?>" onclick="return confirm('Delete data?');">
                                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can fa-fw"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align: center;"><b>Jumlah</b></td>
                            <td colspan="3"><b>Rp<?php echo number_format($jumlah, 0, ',', '.') ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>