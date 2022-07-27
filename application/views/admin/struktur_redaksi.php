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
        <div class="px-2">
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
                        <table id="struktur_redaksi" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jenis Redaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($struktur_redaksi as $str_redaksi) : ?>
                                    <tr>
                                        <td class="text-center" width="100px"><?= $i ?></td>
                                        <td><?= $str_redaksi->jenis_redaksi ?></td>
                                        <td class=" text-center" width="250px">
                                            <!-- <a class="btn mb-2 btn-primary btn-sm mr-2" href="<?= base_url() ?>admin/Reg/edit/<?= $jbt->ID_REG ?>"><i class="fa fa-edit"></i></a> -->
                                            <button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modal-edit<?= $str_redaksi->id_struktur_redaksi ?>"><i class="fas fa-edit"></i> <b>Edit</b></button>
                                            <a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $str_redaksi->id_struktur_redaksi ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
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




<!-- Modal tambah slider -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title-1" id="myModalLabel">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/struktur_redaksi/tambah'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_struktur_redaksi" id="id_struktur_redaksi" value="<?= set_value('id_struktur_redaksi') ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jenis Redaksi:</label>
                        <input type="text" class="form-control" name="jenis_redaksi" id="jenis_redaksi" placeholder="Masukkan jenis redaksi..." value="<?= set_value('jenis_redaksi') ?>">
                        <small class="form-text text-muted">Masukkan Jenis Redaksi</small>
                        <?= form_error('jenis_redaksi'); ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php foreach ($struktur_redaksi as $r) {
    $id    = $r->id_struktur_redaksi;
    $jenis = $r->jenis_redaksi;
    //$isi = $r->ISI;
?>
    <div class="modal fade" id="modal-edit<?= $id ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title title-1" id="myModalLabel">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('admin/struktur_redaksi/edit'); ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenis_jabatan">Jenis Redaksi:</label>
                            <input type="text" class="form-control" name="jenis_redaksi1" id="jenis_redaksi1" placeholder="Masukkan jenis redaksi..." value="<?= $jenis ?>">
                            <small class="form-text text-muted">Masukkan Jenis Redaksi</small>
                            <?= form_error('jenis_redaksi1'); ?>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_struktur_redaksi" value="<?= $id ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <form action="<?= base_url() ?>admin/struktur_redaksi/delete/" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="modal-hapus<?= $r->id_struktur_redaksi; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus file <b><?= $r->jenis_redaksi ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="hidden" name="id_hapus" value="<?= $r->id_struktur_redaksi; ?>" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
} ?>
