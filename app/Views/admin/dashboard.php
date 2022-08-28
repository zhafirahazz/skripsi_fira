<?php $this->extend('templates/admin/admin_layout') ?>
<?php $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <br>
    <!-- Content Row Cost-->
    <div class="row">
        <?php
        foreach ($cost_stat as $cost) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?= $cost->category_display ?>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($cost->total, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <!-- Content Row Benefit-->
    <div class="row">
        <?php
        foreach ($benefit_stat as $benefit) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?= $benefit->category_display ?>        
                            </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($benefit->total, 0, ",", ".") ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-wallet fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data User (Pengguna)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user_count[0]->count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-table fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Guru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $teacher_count[0]->count ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-table fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Biaya</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="px-2">
                        <canvas id="costChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <canvas id="studentPieChart" class="img-fluid">

                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Manfaat</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="px-2">
                        <canvas id="benefitChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Approach -->
        <div class="col-xl-4 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sekilas Website</h6>
                </div>
                <div class="card-body">
                    <p style="text-align: justify;"> <b>Website Perhitungan Investasi</b> ini dibuat untuk pihak SMA IT Abu Bakar Boarding School Kulon Progo (ABBSKP). Dengan website ini diharapkan
                        mempermudah pihak sekolah dalam menghitung kriteria investasi, mendapatkan informasi, mencari data, dan menyimpan data.
                        Website ini dikelola oleh Admin atau Pengelola IT dan dipantau oleh Kepala Sekolah.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const context = document.getElementById('studentPieChart').getContext('2d');
    const studentChart = new Chart(context, {
        type: "pie",
        data: {
            labels: <?= json_encode($student_count["label"]) ?>,
            datasets: [{
                label: 'Jumlah Siswa',
                data: <?= json_encode($student_count["values"]) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    })

    const costContext = document.getElementById('costChart').getContext('2d')
    const costChart = new Chart(costContext, {
        type: "bar",
        data: {
            labels: <?= json_encode($cost_chart["label"]) ?>,
            datasets: [{
                label: 'Nilai Biaya',
                data: <?= json_encode($cost_chart["values"]) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    })

    const benefitContext = document.getElementById('benefitChart').getContext('2d')
    const benefitChart = new Chart(benefitContext, {
        type: "bar",
        data: {
            labels: <?= json_encode($benefit_chart["label"]) ?>,
            datasets: [{
                label: 'Nilai Manfaat',
                data: <?= json_encode($benefit_chart["values"]) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    })
</script>
<?= $this->endSection() ?>