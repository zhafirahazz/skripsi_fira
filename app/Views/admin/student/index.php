<?php $this->extend('templates/admin/admin_layout') ?>

<?php $this->section('content') ?>
<div class="container-fluid mt-4">
    <h2 class="d-inline align-middle me-4 ">Student Management</h2>
    <a class="d-inline align-middle" href="<?php echo route_to('student.create') ?>">
        <button class="btn btn-outline-primary btn-sm float-right">Tambah Siswa</button>
    </a>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Page Heading -->
                Daftar siswa di SMA IT Abu Bakar <i>Boarding School</i> Kulon Progo
            </div>
        </div>
        <div class="card shadow">

        <?php if (isset($_SESSION['alert_success'])) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo ($_SESSION['alert_success']) ?>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo ($_SESSION['alert']) ?>
                </div>
            <?php endif ?>
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo ($_SESSION['success']) ?>
                </div>
            <?php endif ?>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #cceeff;">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($students as $index => $student) : ?>
                                <tr>
                                    <td><?= ($index + 1) ?></td>
                                    <td><?= $student["name"] ?></td>
                                    <td><?= $student["class_display"] ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-auto">
                                                <a href="<?php echo route_to('student.edit', $student["id"]) ?>"><button class="btn btn-success btn-sm">
                                                        <i class="fa-solid fa-pen-to-square fa-fw"></i> Edit</button></a>
                                                <form class="d-inline" method="post" action="<?php echo route_to('student.delete', $student["id"]) ?>" onclick="return confirm('Delete data?');">
                                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can fa-fw"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>