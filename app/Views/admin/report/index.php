<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>

<div class="container-fluid mt-4 mb-4">
    <h2 class="d-inline align-middle me-4 ">Laporan</h2>
    <div class="row mt-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header"><strong>Laporan BCR</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printBCR()">Cetak</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header"><strong>Laporan NPV</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printNPV()">Cetak</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header"><strong>Laporan IRR</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printIRR()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header"><strong>Laporan PP</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printPP()">Cetak</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-header"><strong>Laporan ROI</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printROI()">Cetak</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="bg-primary text-white card-header"><strong>Laporan Lengkap</strong></div>
                <div class="card-body">
                    <button class="btn btn-primary" onclick="printLengkap()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow print mt-4">
        <div class="card-body" id="preview">
            <div id="print-header">
                <h4><strong><em>SMA IT Abu Bakar Boarding School Kulon Progo</em></strong></h4>
                <strong>Daerah Istimewa Yogyakarta - Indonesia</strong>
                <div class="mt-4 text-center">
                    <strong>Laporan Lengkap</strong>
                    <hr class="divider" style="height: 2px; background-color: #000;" />
                    <hr class="divider" style="height: 1px; background-color: #000;" />
                </div>
            </div>

            <div id="print-preview">
                <!-- BCR SECTION -->
                <div id="bcr-section">
                    <div id="bcr-title" class="mt-4 text-center">
                        <strong><em>Benefit-Cost Ratio (BCR)</em></strong>
                    </div>
                    <div id="bcr-preview" class="mt-2">
                        <table style="width: 100%;" border="1">
                            <thead class="text-center">
                                <th width="10%">No.</th>
                                <th width="30%">Tahun ke-</th>
                                <th width="30%">Biaya</th>
                                <th width="30%">Manfaat</th>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $length; $i++) : ?>
                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $costs[$i]->name_cost ?></td>
                                        <td>Rp<?= number_format($costs[$i] != null ? $costs[$i]->price : 0, 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($benefits[$i] != null ? $benefits[$i]->nominal : 0, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endfor ?>
                                <tr class="row-gray">
                                    <td colspan="3"><strong>Nilai BCR (r = <?= $bcrr ?> )</strong></td>
                                    <td><strong><?= $bcr ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="1" class="mt-4" style="width: 100%">
                            <tr class="row-gray">
                                <td><strong>Kesimpulan :</strong></td>
                            </tr>
                            <tr>
                                <td><?= $messageBCR ?></td>
                            </tr>
                        </table>
                    </div>
                </div>


                <!-- NPV SECTION -->


                <div id="npv-section">
                    <div id="npv-title" class="mt-4 mb-2 text-center">
                        <strong><em>Net-Present Value (NPV)</em></strong>
                    </div>

                    <div id="npv-preview">
                        <table style="width: 100%;" border="1">
                            <tbody>
                                <tr class="row-gray">
                                    <td colspan="2"><strong>Nilai Proyek</strong></td>
                                    <td><strong>Rp<?= number_format($costs[0] != null ? $costs[0]->price : 0, 0, ',', '.') ?></strong></td>

                                </tr>
                            </tbody>
                            <thead class="text-center">
                                <th width="10%">No.</th>
                                <th width="45%">Tahun Ke-</th>
                                <th width="45%">Cashflow</th>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $length; $i++) : ?>
                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $costs[$i]->name_cost ?></td>
                                        <td>Rp<?= number_format($cashflows[$i] != null ? $cashflows[$i]["cashflow"] : 0, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endfor ?>
                                <tr class="row-gray">
                                    <td colspan="2"><strong>Nilai NPV (r = <?= $npvr ?>)</strong></td>
                                    <td><strong><?= $npv ?></strong></td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="1" class="mt-4" style="width: 100%">
                            <tr class="row-gray">
                                <td><strong>Kesimpulan :</strong></td>
                            </tr>
                            <tr>
                                <td><?= $messageNPV ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- IRR SECTION -->


                <div id="irr-section">
                    <div id="irr-title" class="mt-4 mb-2 text-center">
                        <strong><em>Internal Rate of Return (IRR)</em></strong>
                    </div>

                    <div id="irr-preview">
                        <table style="width: 100%;" border="1">
                            <table style="width: 100%;" border="1">
                                <thead class="text-center">
                                    <th width="10%">No.</th>
                                    <th width="22.5%">Tahun ke-</th>
                                    <th width="22.5%">Biaya</th>
                                    <th width="22.5%">Manfaat</th>
                                    <th width="22.5%">Cashflow</th>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < $length; $i++) : ?>
                                        <tr>
                                            <td><?= ($i + 1) ?></td>
                                            <td><?= $costs[$i]->name_cost ?></td>
                                            <td>Rp<?= number_format($costs[$i] != null ? $costs[$i]->price : 0, 0, ',', '.') ?></td>
                                            <td>Rp<?= number_format($benefits[$i] != null ? $benefits[$i]->nominal : 0, 0, ',', '.') ?></td>
                                            <td>Rp<?= number_format($cashflows[$i] != null ? $cashflows[$i]["cashflow"] : 0, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endfor ?>
                                    <tr class="row-gray">
                                        <td colspan="4"><strong>Nilai IRR</strong></td>
                                        <td><strong><?= $irr ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table border="1" class="mt-4" style="width: 100%">
                                <tr class="row-gray">
                                    <td><strong>Kesimpulan :</strong></td>
                                </tr>
                                <tr>
                                    <td><?= $messageIRR ?></td>
                                </tr>
                            </table>
                    </div>
                </div>


                <!-- PP SECTION -->


                <div id="pp-section">
                    <div id="pp-title" class="mt-4 mb-2 text-center">
                        <strong><em>Payback Period (PP)</em></strong>
                    </div>

                    <div id="pp-preview">
                        <table style="width: 100%;" border="1">
                            <thead class="text-center">
                                <th width="10%">No.</th>
                                <th width="22.5%">Tahun ke-</th>
                                <th width="22.5%">Biaya</th>
                                <th width="22.5%">Manfaat</th>
                                <th width="22.5%">Aliran Kas</th>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $length; $i++) : ?>
                                    <tr>
                                        <td><?= ($i + 1) ?></td>
                                        <td><?= $costs[$i]->name_cost ?></td>
                                        <td>Rp<?= number_format($costs[$i] != null ? $costs[$i]->price : 0, 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($benefits[$i] != null ? $benefits[$i]->nominal : 0, 0, ',', '.') ?></td>
                                        <td>Rp<?= number_format($cashflows[$i] != null ? $cashflows[$i]["cashflow"] : 0, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endfor ?>
                                <tr class="row-gray">
                                    <td colspan="4"><strong>Nilai PP</strong></td>
                                    <td><strong><?= $pp ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="1" class="mt-4" style="width: 100%">
                            <tr class="row-gray">
                                <td><strong>Kesimpulan :</strong></td>
                            </tr>
                            <tr>
                                <td><?= $messagePP ?></td>
                            </tr>
                        </table>
                    </div>
                </div>


                <!-- ROI SECTION -->


                <div id="roi-section">
                    <div id="roi-title" class="mt-4 mb-2 text-center">
                        <strong><em>Return Of Investment (ROI)</em></strong>
                    </div>

                    <div id="roi-preview">
                        <table style="width: 100%;" border="1">
                            <thead class="text-center">
                                <th width="10%">No.</th>
                                <th width="45%">Total Biaya</th>
                                <th width="45%">Total Manfaat</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><?= $costROI[0]->price ?></td>
                                    <td><?= $benefitROI[0]->nominal ?></td>
                                </tr>
                                <tr class="row-gray">
                                    <td colspan="2"><strong>Nilai ROI</strong></td>
                                    <td><strong><?= $roi ?> %</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="1" class="mt-4" style="width: 100%">
                            <tr class="row-gray">
                                <td><strong>Kesimpulan :</strong></td>
                            </tr>
                            <tr>
                                <td><?= $messageROI ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card print shadow mt-4">
        <div class="card-body" id="print-wrapper">
            <div id="print-area">
                <div id="print-header">
                    <h4><strong><em>SMA IT Abu Bakar Boarding School Kulon Progo</em></strong></h4>
                    <strong>Daerah Istimewa Yogyakarta - Indonesia</strong>
                    <div class="mt-4 text-center">
                        <strong id="print-title">Laporan Lengkap</strong>
                        <hr class="divider" style="border-top: solid 2px #000" />
                        <hr class="divider" style="border-top: solid 1px #000" />
                    </div>
                </div>
                <div id="print-body" class="mt-4"></div>
                <div id="print-footer" class="mt-4">
                    <table style="width: 100%;">
                        <tbody>
                            <th width="30%"></th>
                            <th width="40%"></th>
                            <th width="30%"></th>
                        </tbody>
                        <tbody class="text-center">
                            <tr>
                                <td>Mengetahui</td>
                                <td></td>
                                <td>Yogyakarta, <?= date('j F Y') ?></td>
                            </tr>
                            <tr>
                                <td>Kepala Sekolah</td>
                                <td></td>
                                <td>Admin</td>
                            </tr>
                            <tr style="height:5rem ;">
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>( <?= $kepsek ?> )</td>
                                <td></td>
                                <td>( <?= $admin ?> )</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>

<?php $this->section('script') ?>


<script>
    function printBCR() {
        setPrintArea(document.getElementById('bcr-preview'), 'Laporan Benefit-Cost Ratio')
        printReport()
    }

    function printNPV() {
        setPrintArea(document.getElementById('npv-preview'), 'Laporan Net-Present Value')
        printReport()


    }

    function printIRR() {
        setPrintArea(document.getElementById('irr-preview'), 'Laporan Internal Rate Of Return')
        printReport()

    }

    function printPP() {
        setPrintArea(document.getElementById('pp-preview'), 'Laporan Payback Period')
        printReport()

    }

    function printROI() {
        setPrintArea(document.getElementById('npv-preview'), 'Laporan Return Of Invesment')
        printReport()

    }

    function printLengkap() {
        setPrintArea(document.getElementById('print-preview'), 'Laporan Lengkap')
        printReport()

    }

    function printReport() {
        let printContent = document.getElementById('print-wrapper').innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent
        window.print()
        document.body.innerHTML = originalContent
    }

    function setPrintArea(content, title) {
        document.getElementById('print-title').innerText = title;
        document.getElementById('print-body').innerHTML = content.outerHTML;

    }
</script>

<?php $this->endSection() ?>