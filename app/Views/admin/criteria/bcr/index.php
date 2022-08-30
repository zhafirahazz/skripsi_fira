<?php

use App\Models\Benefit;

$this->extend('templates/admin/admin_layout') ?>

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
                        <h5 class="d-inline align-middle m-3"><b>Form Perhitungan Benefit/ Cost Ratio (BCR)</b></h5>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row g-3 align-items-center mb-3">
                                    <div class="col-auto">
                                        <label for="inputR" class="col-form-label">r</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="number" value="5" id="inputR" class="form-control">
                                    </div>
                                    <div class="col-auto">
                                        <label for="" class="col-form-label">%</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?php foreach ($benefits as $benefit) : ?>
                                            <div class="mb-3">
                                                <label for="benefitInput" class="form-label">Manfaat tahun ke <?= $benefit->name_benefit ?></label>
                                                <input type="text" class="form-control" id="benefitInput" value="<?= $benefit->nominal ?>" disabled>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="col">
                                        <?php foreach ($costs as $cost) : ?>

                                            <div class="mb-3">
                                                <label for="costInput" class="form-label">Biaya tahun ke <?= $cost->name_cost ?></label>
                                                <input type="text" class="form-control" id="costInput" value="<?= $cost->price ?>" disabled>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                                <a href="<?php echo route_to('bcr.hitung') ?>">
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

        $(document).ready(() => {
            calculateBCR()
        })

        function calculateBCR() {
            let benefitsData = <?= json_encode($benefits) ?>;
            let costsData = <?= json_encode($costs) ?>;

            let rate = $('#inputR').val()

            let benefit = benefitsData.reduce((prev, curr) => {
                return prev + (curr.nominal / Math.pow((1 + (rate / 100)),Number.parseInt(curr.name_benefit)))
            }, 0)
            
            let cost = costsData.reduce((prev, curr, index) => {
                return prev + (curr.price / Math.pow((1 + (rate / 100)),Number.parseInt(curr.name_cost)))
            }, 0)

            let BCR = benefit/cost;

            let kelayakan = BCR < 1 ? 'TIDAK LAYAK' : 'LAYAK'

            let message = `Nilai BCR adalah ${BCR} sehingga proyek ${kelayakan} untuk dilakukan`;
            $('#result').text(message)
        }
    </script>
    <?php $this->endSection() ?>