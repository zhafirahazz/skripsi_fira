<?php $this->extend('templates/admin/admin_layout')?>

<?php $this->section('content')?>
<div class="container mt-4">
    <h2 class="d-inline align-middle me-4 ">Intangible Benefit</h2>

    <div class="row mt-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo route_to('intangible.store') ?>" method="post">
                    <input class="form-control mt-4" placeholder="Manfaat Baru" type="text" name="benefit">
                    <input class="form-control mt-4" placeholder="Kuantitas" type="number" name="quantity">
                    <label class="mt-4" for="class">Pilih Satuan</label>
                    <select class="form-control" name="unit_id">
                        <option value="1">buah</option>
                        <option value="2">orang</option>
                        <option value="3">jam</option>
                        <option value="4">hari</option>
                        <option value="5">bulan</option>
                        <option value="6">tahun</option>
                        <option value="7">kali</option>
                        <option value="8">RIM</option>
                        <option value="9">semester</option>
                        <option value="10">ujian</option>
                        <option value="11">kelas</option>
                        <option value="12">buku</option>
                    </select>
                    <input class="form-control mt-4" placeholder="Harga Satuan" type="number" name="unit_price">
                    <textarea class="form-control mt-4" placeholder="Keterangan" name="description"></textarea>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection()?>
