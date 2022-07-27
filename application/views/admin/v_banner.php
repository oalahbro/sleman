<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="px-2">
            <?= flashdata('pesan');
            unset($_SESSION['pesan']);
            ?>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> <?= $judul; ?></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="fotogk" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($banner as $ft) {
                                ?>
                                    <tr>
                                        <td class="text-center" width="10px"><?= $no++ ?></td>
                                        <td width="120px"><img width="200px" height="150px" src="<?= base_url() ?>uploads/images/<?= $ft['foto_banner']; ?>" alt="<?= $ft->foto_banner ?>" srcset="" class="img-fluid"></td>
                                        <td width="5px"><?= $ft['link_banner']; ?></td>
                                        <td class="text-center" width="50px"><?php
                                                                                if ($ft['status_banner'] === '0') {
                                                                                    echo "<span class='btn btn-sm btn-secondary m-1'> <i class='fas fa-eye-slash'></i> <b>Tidak Tampil</b> </span>";
                                                                                } else {
                                                                                    echo "<span class='btn btn-sm btn-success m-1'> <i class='fas fa-eye'> </i> <b>Tampil</b> </span>";
                                                                                }
                                                                                ?>
                                        </td>
                                        <td class="text-center" width="100px">
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>banner/edit/<?= $ft['id_banner'] ?>"><i class="fas fa-edit"></i> <b>Edit</b></a>
                                            <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modalDelete<?= $ft['id_banner'] ?>"><i class="fas fa-trash"></i>
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
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title title-1" id="myModalLabel">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/banner/tambah1'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Gambar Banner</label><br>
                        <div class="preview-zone hidden">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <div><b>Preview</b></div>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-danger btn-xs remove-preview">
                                            <i class="fa fa-times"></i> Reset
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mb-2 dropzone-wrapper">
                            <input type="file" class="dropzone" name="file" id="file" accept="image/png, image/jpg, image/jpeg">
                            <label class="custom-file-label" for="file">Masukkan gambar max 2 MB</label>
                        </div>
                        <small id="image" class="form-text text-muted">Pilihlah File gambar Max 2 MB. Format (JPG/JPEG/PNG)</small>

                    </div>
                    <div class="form-group">
                        <!-- <input type="hidden" class="form-control" id="" name="ID_TAGS" value="<?= $id_foto; ?>"> -->
                        <label for="link_banner">Link Banner</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="Masukkan Link Banner yang Valid . ." aria-describedby="judfot" maxlength="100" autocomplete="off">
                        <small id="link_banner" class="form-text text-muted">Masukkan link banner yang valid</small>
                        <?= form_error('link'); ?>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="custom-select" name="status" id="status">
                            <option value="" selected>Pilih Status</option>
                            <option value="1">Tampilkan</option>
                            <option value="0">Sembunyikan</option>
                        </select>
                        <small id="status" class="form-text text-muted">Pilih Status Tampilkan Atau Sembunyikan</small>
                        <?= form_error('status'); ?>
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

<?php foreach ($banner as $dns) :
    $id         = $dns['id_banner'];
    $foto       = $dns['foto_banner'];
    $link       = $dns['link_banner'];
    $status     = $dns['status_banner'];
?>



    <div class="modal fade" id="modalDelete<?= $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/banner/delete'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus data ini?</h4>
                        </div>
                        <input type="hidden" name="id_banner" value="<?= $id; ?>">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




















<?php endforeach; ?>