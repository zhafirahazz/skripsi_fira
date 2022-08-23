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
                    <h5 class="d-inline align-middle m-3"><b>Form Perhitungan Internal Rate of Return (IRR)</b></h5>
                    <div class="card-body">
                        FORM WKWK
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>