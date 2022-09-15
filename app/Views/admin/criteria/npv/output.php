<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Net Present Value (NPV)</h2>
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #ffdd99;">
                <!-- Page Heading -->
                NPV adalah total perbandingan dari pengurangan manfaat dan biaya dengan penjumlahan dari satu dan tingkat
                suku bunga yang berlaku pada periode tertentu selama jumlah periode terjadi.
                <br>NPV dapat dihitung menggunakan rumus: <br>
                <img src="/img/rumus_npv.png"><br>
                Keterangan:<br>
                B = Benefit/ manfaat<br>
                C = Cost/ biaya<br>
                r = tingkat suku bunga yang berlaku (%)<br>
                n = jumlah periode terjadinya biaya dan manfaat (tahun)<br>
                <br>
                Indikator NPV adalah jika NPV bernilai positif, maka proyek diterima, sedangkan apabila NPV bernilai
                negatif, maka proyek tidak diterima.
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <h5 class="d-inline align-middle m-3"><b>Hasil Perhitungan Net Present Value (NPV)</b></h5>
                    <div class="card-body">
                        <form action="" method="post">
                        <div class="mb-3">
                                <label for="npv" class="form-label">NPV</label>
                                <input type="text" class="form-control" id="npv" placeholder="0" value="<?= $npv ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="kesimpulan" class="form-label">Kesimpulan</label>
                                <input type="text" class="form-control" id="kesimpulan" placeholder="text" value="<?= $message ?>" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>