<!-- Content Wrapper. Contains page content -->
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
                        <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Beranda</a></li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus-circle"></i> <?= $judul; ?></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dinas" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Dinas</th>
                                    <th>Gambar(Logo)</th>
                                    <th>Link Website</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($dinas as $dns) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td><?= $dns['nama_dinas']; ?></td>
                                        <?php if ($dns['logo'] == '' || $dns['logo'] == null) { ?>
                                            <td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/default.jpg" alt="Belum Ada Foto" class="img-fluid"></td>
                                        <?php } else { ?>
                                            <td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/<?= $dns['logo'] ?>" alt="<?= $dns['logo'] ?>" srcset="" class="img-fluid"></td>
                                        <?php } ?>
                                        <td><?= $dns['link']; ?></td>

                                        <td class="text-center" width="50px"><?php
                                                                                if ($dns['status'] === '0') {
                                                                                    echo "<span class='badge badge-danger p-2'> Tidak Tampil</span>";
                                                                                } else {
                                                                                    echo "<span class='badge badge-primary p-2'> Tampil</span>";
                                                                                }
                                                                                ?>
                                        </td>
                                        <td class="text-center" width="180px">
                                            <!-- <button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modalEdit<? //= $dns['id_diter']; 
                                                                                                                                        ?>"><i class="fas fa-edit"></i>
                                                <b>Edit</b></button> -->
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>dinas/edit/<?= $dns['id_diter'] ?>"><b><i class="fas fa-edit"></i> Edit</b></a>

                                            <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modalDelete<?= $dns['id_diter']; ?>"><i class="fas fa-trash"></i>
                                                <b>Hapus</b></button>
                                        </td>
                                    <?php $i++;
                                endforeach; ?>
                                    </tr>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Data Dinas Terkait</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/dinas/tambah'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_dinas">Nama Dinas:</label>
                        <input type="text" class="form-control" name="nama_dinas" id="nama_dinas" aria-describedby="nama_dinas" placeholder="Masukkan Nama Dinas...">
                        <small id="nama_dinas" class="form-text text-muted">Masukkan Nama Dinas</small>
                        <?= form_error('nama_dinas'); ?>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar Logo</label><br>
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
                            <label class="custom-file-label" for="file">Masukkan foto 1mb</label>
                        </div>
                        <small id="image" class="form-text text-muted">Pilihlah File foto Max 1 MB. Format (JPG/JPEG/PNG)</small>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Website:</label>
                        <input type="text" class="form-control" name="link" id="link" maxlength="255" placeholder="Masukkan Link Website...">
                        <small id="link" class="form-text text-muted">Masukkan Link Website</small>
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

<?php foreach ($dinas as $dns) :
    $id         = $dns['id_diter'];
    $nama_dinas = $dns['nama_dinas'];
    $logo       = $dns['logo'];
    $link       = $dns['link'];
    $status     = $dns['status'];
?>
    <!-- <div class="modal fade" id="modalEdit<?= $id; ?>" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Edit Data Dinas Terkait</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'admin/dinas/edit' ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_dinas">Nama Dinas</label>
                                <input type="text" id="nama_dinas1" value="<?= $nama_dinas ?>" name="nama_dinas1" class="form-control" placeholder="Masukkan Nama Dinas">
                                <small class="form-text text-muted">Masukkan Nama Dinas</small>
                                <?= form_error('nama_dinas1'); ?>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Logo</label><br>
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
                                            <?php if ($logo == '' || $logo == null) { ?>
                                                <img id="prev_foto1" src="<?= base_url() ?>uploads/images/default.jpg" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                            <?php } else { ?>
                                                <img id="prev_foto1" src="<?= base_url() ?>uploads/images/<?= $logo ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-file mb-2 dropzone-wrapper">
                                    <input type="file" class="dropzone" name="file1" id="file1" accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="file1">
                                        <?php if ($logo == '' || $logo == null) { ?>
                                            Belum ada gambar
                                        <?php } else { ?>
                                            <?= $logo ?>
                                        <?php } ?>
                                    </label>
                                </div>
                                <small id="image" class="form-text text-muted">Pilihlah File foto Max 1 MB. Format (JPG/JPEG/PNG)</small>
                            </div>
                            <div class="form-group">
                                <label for="link">Link Website</label>
                                <input type="text" class="form-control" name="link1" id="link1" value="<?= $link ?>" placeholder="Masukkan Link Website...">
                                <small class="form-text text-muted">Merupakan Link Website</small>
                                <?= form_error('link1'); ?>
                            </div>
                            <div>
                                <label for="status">Status</label>
                                <select class="custom-select" name="status1" id="status1">
                                    <option value="" selected>Pilih Status</option>
                                    <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Tampilkan</option>
                                    <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Sembunyikan</option>
                                </select>
                                <small id="status" class="form-text text-muted">Pilih Status Tampilkan Atau Sembunyikan</small>
                                <?= form_error('status1'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_diter" value="<?= $id ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="modalDelete<?= $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/dinas/delete'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus data <b><?= $nama_dinas; ?></b> ini?</h4>
                        </div>
                        <input type="hidden" name="id_diter" value="<?= $id; ?>">
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
