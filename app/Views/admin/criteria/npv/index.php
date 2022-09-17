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
                        <div >
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="inputR" class="col-form-label">r</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" value="<?= $r ?>" id="inputR" class="form-control">
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
                            <a id="npvCalculator">
                                <button class="btn btn-outline-primary btn-sm">Hitung</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
            setAction($('#inputR').val())
            $('#inputR').on('input',(event) => {
                setAction($('#inputR').val())
            })
        })

        function setAction(r) {
            const BASE_URL = "<?php echo route_to('npv.output') ?>"
            let url = `${BASE_URL}?r=${r}`
            $('#npvCalculator').attr("href", url)
        }
</script>

<?php $this->endSection() ?>