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
                    <h5 class="d-inline align-middle m-3"><b>Form Perhitungan Net Present Value (NPV)</b></h5>
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
        calculateNPV()
    })

    function calculateNPV() {
        let benefitsData = <?= json_encode($benefits) ?>;
        let costsData = <?= json_encode($costs) ?>;

        let rate = $('#inputR').val()

        let length = benefitsData.length > costsData.length ? benefitsData.length : costsData.length;

        let NPV = 0;
        for (let i = 0; i < length; i++) {
            let benefit = benefitsData[i] ? benefitsData[i] : null;
            let cost = costsData[i] ? costsData[i] : null;
            
            tahun = benefit == null? Number.parseInt(cost.name_cost) : Number.parseInt(benefit.name_benefit)
            benefit = benefit == null ? 0 : benefit.nominal
            cost = cost == null ? 0 : cost.price
            let temp = ((benefit - cost) / Math.pow((1 + (rate / 100)), tahun))
            NPV = NPV + (Number.isNaN(temp)? 0 : temp)
        }
        let kelayakan = NPV > 0 ? 'DITERIMA' : 'TIDAK DITERIMA'

        let message = `Nilai NPV adalah ${NPV} sehingga proyek ${kelayakan} untuk dilakukan`;
        $('#result').text(message)
    }
</script>

<?php $this->endSection() ?>