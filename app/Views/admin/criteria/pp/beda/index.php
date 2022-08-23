<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Payback Period (PP)</h2>
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #ffdd99;">
                <!-- Page Heading -->
                PP adalah lama waktu yang dibutuhkan untuk mengembalikan biaya investasi awal.
                <br>• Apabila arus kas pertahun jumlahnya sama dapat dilihat pada rumus:
                <br><img src="/img/rumus_pp_sama.png"><br>
                • Apabila arus kas pertahun jumlahnya berbeda dapat dilihat pada rumus:
                <br><img src="/img/rumus_pp_beda.png"><br>
                Keterangan:<br>
                n = tahun terakhir di mana jumlah arus kas belum bisa menutup investasi awal<br>
                a = jumlah investasi awal<br>
                b = jumlah kumulatif arus kas tahun ke-n<br>
                c = jumlah kumulatif arus kas tahun ke n+1 <br>
                <br>
                Indikator PP yaitu proyek layak dijalankan/ diterima apabila PP lebih cepat dari umur investasi,
                sedangkan proyek tidak layak dijalankan/ ditolak apabila PP lebih lama dari umur investasi.
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputN" class="col-form-label">n</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="inputN" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputA" class="col-form-label">a</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="inputA" class="form-control" placeholder="0" disabled>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputB" class="col-form-label">b</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="inputB" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputC" class="col-form-label">c</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="inputC" class="form-control">
                                </div>
                            </div>
                            <a href="">
                                <button class="btn btn-outline-primary btn-sm">Hitung</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>