<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Project Value</h2>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Page Heading -->
                Nilai proyek merupakan nilai biaya yang dikeluarkan di tahun 0, yaitu saat pengembangan sistem.
                Nilai proyek meliputi Procurement Cost, Start Up Cost, dan Project Related Cost.
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #cceeff;">
                            <th>No.</th>
                            <th>Nama Proyek</th>
                            <th>Biaya</th>
                        </thead>
                        <tbody>
                            <?php $jumlah = 0;
                            foreach ($row as $index => $rows) :
                                $jumlah += $rows->total;?>
                                <tr>
                                    <td><?= ($index + 1) ?></td>
                                    <td><?= $rows->display?></td>
                                    <td>Rp<?= number_format($rows->total, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tr>
                            <td colspan="2" style="text-align: center;"><b>Jumlah</b></td>
                            <td><b>Rp<?php echo number_format($jumlah, 0, ',', '.') ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>