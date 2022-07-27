<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="px-2">
            <?= flashdata('pesan') ?>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <div class="text-right">
                <a class="btn btn-primary" href="<?= base_url('structure/tambah') ?>">
                    <i class="fas fa-plus-circle"></i> Struktur</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="struktur" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jenis Jabatan</th>
                                    <th>Gambar</th>
                                    <th>Nama Pengurus</th>
                                    <th>Masa Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($struktur as $str) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $str->jenis_jabatan ?></td>
                                        <?php
                                        if ($str->image === '' || $str->image === null) {
                                            $img = base_url('assets/dist/img/user/default.jpg');
                                        } else {
                                            $img = base_url('uploads/images/' . $str->image);
                                        } ?>
                                        <td width="150px"><img width="150px" height="150px" src="<?= $img ?>" alt="<?= $str->nama_pengurus ?>" class="img-fluid"></td>
                                        <td><?= $str->nama_pengurus ?></td>
                                        <td><?= $str->masa_jabatan ?></td>
                                        <td class="text-center" width="160px">
                                            <!-- <a class="btn mb-2 btn-primary btn-sm mr-2" href="<?= base_url() ?>admin/Reg/edit/<?= $str->id_ ?>"><i class="fa fa-edit"></i></a> -->
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>structure/edit/<?= $str->id_struktur ?>"><i class="fas fa-edit"></i> <b>Edit</b></a>
                                            <a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $str->id_struktur ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
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
<?php foreach ($struktur as $st) { ?>
    <form action="<?= base_url() ?>admin/struktur/delete/" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="modal-hapus<?= $st->id_struktur; ?>" aria-hidden="true">
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
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus file <b><?= $st->nama_pengurus ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="hidden" name="id_hapus" value="<?= $st->id_struktur; ?>" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
