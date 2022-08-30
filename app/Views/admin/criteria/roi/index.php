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
                Indikator ROI yaitu proyek dapat diterima/ layak apabila ROI > 0%, sedangkan proyek ditolak/ tidak layak apabila ROI < 0%. </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <h5 class="d-inline align-middle m-3"><b>Form Perhitungan Return on Investment (ROI)</b></h5>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="biayaAwalInput" class="form-label">Biaya Investasi</label>
                                    <input type="text" class="form-control" id="biayaAwalInput"
                                    value="<?= $costs == null? 0 : $costs->price ?>"
                                    placeholder="0" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="profitInput" class="form-label">Keuntungan Investasi</label>
                                    <input type="text" class="form-control" id="profitInput" placeholder="0"
                                    value="<?= $benefits == null ? 0 : $benefits->nominal ?>"
                                    disabled>
                                </div>
                                <a href="">
                                    <button class="btn btn-outline-primary btn-sm">Hitung</button></a>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-2">
                    <div class="card-header">
                        Kesimpulan
                    </div>
                    <div class="card-body">
                        <p id="result"></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(()=>{
            calculateRoi()
        })

        function calculateRoi(){
            let benefit = $('#profitInput').val()
            let cost = $('#biayaAwalInput').val()

            console.log(`${benefit} / ${cost}`)

            let roi = (benefit/cost) * 100

            let kesimpulan = roi > 0 ? 'DITERIMA' : 'TIDAK DITERIMA'

            let msg = `Nilai ROI adalah ${roi} % sehingga proyek dinyatakan ${kesimpulan}`
            $('#result').text(msg)
        }
    </script>

    <?php $this->endSection() ?>