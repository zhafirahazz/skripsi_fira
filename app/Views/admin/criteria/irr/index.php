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
                    <div class="card-header">
                        <h4><strong>Form perhitungan IRR</strong></h4>
                    </div>
                    <div class="card-body">

                        <div>
                            <div class="form-group row">
                                <div class="col align-bottom">
                                    <label class="align-bottom" for="rr">Tingkat Pengembalian</label>
                                </div>
                                <div class="col align-bottom">
                                    <input class="form-control align-bottom" value="<?= $rr ?>" type="number" name="rr" id="rr">
                                </div>
                                <div class="col align-bottom">
                                    <span class="align-bottom">%</span>
                                </div>
                                <div class="col-6"></div>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <th>Tahun</th>
                                <th>Cost</th>
                                <th>Benefit</th>
                                <th>Cash Flow</th>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $length; $i++) : ?>
                                    <tr>
                                        <td><?php echo $costs[$i]->name_cost; ?></td>
                                        <td><?php echo $costs[$i]->price; ?></td>
                                        <td><?php echo $benefits[$i]->nominal; ?></td>
                                        <td><?php echo ($benefits[$i]->nominal - $costs[$i]->price) ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                        <div class="mt-2 text-right">
                            <a id="irrCalculator">
                                <button class="btn btn-primary">Hitung</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(() => {
        setAction($('#rr').val())
        $('#rr').on('input', (event) => {
            setAction($('#rr').val())
        })
    })

    function setAction(r) {
        const BASE_URL = "<?php echo route_to('irr.output') ?>"
        let url = `${BASE_URL}?r=${r}`
        console.log(url)
        $('#irrCalculator').attr("href", url)
    }
</script>
<?php $this->endSection() ?>