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
                <a class="btn btn-primary" href="<?= base_url() ?>redaction/tambah1">
                    <i class="fas fa-plus-circle"></i> <?= $judul ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="redaksi" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jabatan Redaksi</th>
                                    <th>Gambar</th>
                                    <th>Nama Pengurus</th>
                                    <th>Masa Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($redaksi as $str) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td width="150px"><?= $str->jenis_redaksi ?></td>
                                        <?php if ($str->gambar == '' || $str->gambar == null) { ?>
                                            <td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada Foto" class="img-fluid"></td>
                                        <?php } else { ?>
                                            <td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/<?= $str->gambar ?>" alt="<?= $str->gambar ?>" srcset="" class="img-fluid"></td>
                                        <?php } ?>
                                        <td><?= $str->nama_pengurus ?></td>
                                        <td><?= $str->masa_jabatan ?></td>
                                        <td class="text-center" width="160px">
                                            <!-- <a class="btn mb-2 btn-primary btn-sm mr-2" href="<?= base_url() ?>admin/Reg/edit/<?= $str->id_ ?>"><i class="fa fa-edit"></i></a> -->
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>redaction/edit/<?= $str->id_redaksi ?>"><i class="fas fa-edit"></i> <b>Edit</b></a>
                                            <a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $str->id_redaksi ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
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

<?php foreach ($redaksi as $rd) { ?>
    <form action="<?= base_url() ?>admin/redaksi/delete/" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="modal-hapus<?= $rd->id_redaksi; ?>" aria-hidden="true">
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
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus file <b><?= $rd->nama_pengurus ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="hidden" name="id_hapus" value="<?= $rd->id_redaksi; ?>" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
