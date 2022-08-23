<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Benefit/ Cost Ratio (BCR)</h2>
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #ffdd99;">
                <!-- Page Heading -->
                Benefit/cost ratio merupakan nilai biaya dibagi nilai manfaat. Benefit/cost ratio dapat dihitung menggunakan rumus:
                <br>
                <img src="/img/rumus_bcr.png"><br>
                Keterangan:<br>
                Bt = Benefit/ manfaat pada tahun ke-t<br>
                Ct = Cost/ biaya pada tahun ke-t<br>
                r = tingkat suku bunga yang berlaku (%)<br>
                n = lamanya periode waktu (tahun)<br>
                t = umur proyek<br>
                <br>
                Indikator BCR adalah jika BCR < 1 maka proyek tidak layak untuk dilakukan, sedangkan jika BCR ≥ 1 maka proyek layak untuk dilakukan. </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <h5 class="d-inline align-middle m-3"><b>Hasil Perhitungan Benefit/ Cost Ratio (BCR)</b></h5>
                        <div class="card-body">
                            <form action="" method="post">
                            <div class="mb-3">
                                <label for="bcr" class="form-label">BCR</label>
                                <input type="text" class="form-control" id="bcr" placeholder="0" disabled>
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