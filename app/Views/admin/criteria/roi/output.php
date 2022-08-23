<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Return on Investment (ROI)</h2>
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #ffdd99;">
                <!-- Page Heading -->
                ROI adalah metode yang berguna dalam keputusan penganggaran modal di mana tingkat pengembalian investasi dihitung dengan cara
                perbandingan keuntungan investasi dengan biaya investasi yang kemudian dikali 100%.
                <br>ROI dapat dihitung menggunakan rumus: <br>
                <img src="/img/rumus_roi.png"><br>
                Indikator ROI yaitu proyek dapat diterima/ layak apabila ROI > 0%, sedangkan proyek ditolak/ tidak layak apabila ROI < 0%.
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <h5 class="d-inline align-middle m-3"><b>Hasil Perhitungan Return on Investment (ROI)</b></h5>
                    <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                                <label for="roi" class="form-label">ROI</label>
                                <input type="text" class="form-control" id="roi" placeholder="0" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                <input type="text" class="form-control" id="kesimpulan" placeholder="text" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php $this->endSection() ?>