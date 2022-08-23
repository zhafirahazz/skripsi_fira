<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Internal Rate of Return (IRR)</h2>
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #ffdd99;">
                <!-- Page Heading -->
                IRR merupakan tingkat diskonto yang membentuk NPV sama dengan nol (0) guna sebagai tingkat pengembalian yang berwujud.
                Cara menghitung IRR adalah dengan proses trial-and-error atau coba-coba dan disesuaikan hingga NPV = 0
                <br>IRR dapat dihitung menggunakan rumus: <br>
                <img src="/img/rumus_irr.png"><br>
                Keterangan:<br>
                iNPV<sub>(+)</sub> = suku bunga positif<br>
                iNPV<sub>(-)</sub> = suku bunga negatif<br>
                NPV<sub>(+)</sub> = NPV dengan hasil positif<br>
                NPV<sub>(-)</sub> = NPV dengan hasil negatif<br>
                <br>
                Indikator IRR adalah jika IRR lebih besar dari tingkat pengembalian yang sudah ditetapkan maka proyek layak dijalankan,
                tetapi jika IRR lebih kecil dari tingkat pengembalian yang sudah ditetapkan maka proyek tidak layak dijalankan/ ditolak.
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <h5 class="d-inline align-middle m-3"><b>Hasil Perhitungan Internal Rate of Return (IRR)</b></h5>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="irr" class="form-label">IRR</label>
                                <input type="text" class="form-control" id="irr" placeholder="0" disabled>
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