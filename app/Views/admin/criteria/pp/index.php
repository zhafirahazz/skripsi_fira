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
                    <div class="card-header">
                        <h4><strong>Form perhitungan Payback Period</strong></h4>
                    </div>



                    <div class="card-body">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-auto">
                                <label for="inputUsiaProyek" class="col-form-label">Usia Proyek</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" value="5" id="inputUsiaProyek" class="form-control">
                            </div>
                            <div class="col-auto">
                                <label for="" class="col-form-label">Tahun</label>
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

                        <a id="ppCalculator">
                            <button class="btn btn-outline-primary btn-sm">Hitung</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(() => {
        setAction($('#inputUsiaProyek').val())
        $('#inputUsiaProyek').on('input', (event) => {
            setAction($('#inputUsiaProyek').val())
        })
    })

    function setAction(r) {
        const BASE_URL = "<?php echo route_to('pp.output') ?>"
        let url = `${BASE_URL}?u=${r}`
        $('#ppCalculator').attr("href", url)
    }
</script>
<?php $this->endSection() ?>