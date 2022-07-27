<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div>
            <?= flashdata('pesan');
            unset($_SESSION['pesan']); ?>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus-circle"></i> <?= $judul ?></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="cat" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($kategori as $ktg) {
                                ?>
                                    <tr>
                                        <td class="text-center" width="100px"><?= $no++ ?></td>
                                        <td><?= $ktg->nama_kategori; ?></td>
                                        <td class="text-center" width="250px">
                                            <button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modal-edit<?= $ktg->id_kategori; ?>"><b><i class="fas fa-edit"></i>
                                                    Edit</b></button>
                                            <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal_hapus<?= $ktg->id_kategori; ?>"><i class="fas fa-trash"></i>
                                                <b>Hapus</b></button>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
foreach ($kategori as $ktg) {
    $ID_CT = $ktg->id_kategori;
    $NM_CT = $ktg->nama_kategori; ?>
    <!-- modal hapus data kategori -->
    <div class="modal fade" id="modal_hapus<?= $ID_CT; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title" id="myModalLabel">Hapus Data</h3>
                </div>
                <form action="<?= base_url('admin/category/hapus'); ?>" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus data <b><?= $NM_CT; ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ID_CT" value="<?= $ID_CT; ?>">
                        <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Batal</button>
                        <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit kategori -->
    <div class="modal fade" id="modal-edit<?= $ID_CT; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title title-1" id="myModalLabel">Edit Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/category/update_kategori'); ?>">
                    <div class="modal-body">
                        <input type="hidden" name="id_kategori" value="<?= $ktg->id_kategori ?>" class="form-control">
                        <div class="form-group">
                            <input type="text" name="nama_kategori1" id="nama_kategori1" class="form-control" autocomplete="off" value="<?= $NM_CT; ?>">
                            <small id=" nama_kategori1" class="form-text text-muted">Masukkan nama kategori tidak boleh menggunakan karakter spesial.</small>
                            <?= form_error('nama_kategori1'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
} ?>

<!-- Modal tambah kategori -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title title-1" id="myModalLabel">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/category/tambah_kategori'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $ID_CT; ?>">
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" autocomplete="off" placeholder="Masukkan Nama Kategori . ." aria-describedby="namakategori" maxlength="100" onkeypress="return event.charCode < 48 || event.charCode  >57">
                        <small id=" nama_kategori" class="form-text text-muted">Masukkan nama kategori tidak boleh menggunakan karakter spesial.</small>
                        <?= form_error('nama_kategori'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
