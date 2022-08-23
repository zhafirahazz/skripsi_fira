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
                    <h5 class="d-inline align-middle m-3"><b>Hasil Perhitungan Payback Period (PP) dengan Arus Kas Pertahun Sama</b></h5>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="pp" class="form-label">PP</label>
                                <input type="text" class="form-control" id="pp" placeholder="0" disabled>
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