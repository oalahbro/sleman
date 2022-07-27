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
        <?= flashdata('pesan');
        unset($_SESSION['pesan']); ?>
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
                        <table id="video" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Judul Video</th>
                                    <th>Deskripsi Video</th>
                                    <th>Tanggal Video</th>
                                    <th>Thumbnail Video</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($video->result() as $detVideo) { ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td width="150px"><?= $detVideo->judul_vid ?></td>
                                        <td><?= word_limiter($detVideo->deskripsi_vid) ?></td>
                                        <td width="150px"><?= indonesian_date($detVideo->tanggal_vid) ?></td>
                                        <td width="150px">
                                            <img width="150px" height="150px" src="<?= thumbYouTube(IDYouTube($detVideo->link)) ?>" alt="<?= $detVideo->judul_vid ?>" class="img-fluid" />
                                        </td>
                                        <td class="text-center" width="160px">
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>video_gk/edit/<?= $detVideo->id_video ?>"><i class="fa fa-edit"></i> <b>Edit</b></a>
                                            <a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $detVideo->id_video ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                }
                                ?>
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
            <?= form_open_multipart('admin/video/tambah', [], []) ?>
            <div class="modal-body">
                <div class="form-group">
                    <?= form_label('Judul', 'judul_vid') ?>
                    <?= form_input([
                        'class'       => 'form-control',
                        'id'          => 'judul_vid',
                        'name'        => 'judul_vid',
                        'placeholder' => 'judul video',
                        // 'required'    => '',
                    ], set_value('judul_vid')) ?>
                    <small class="form-text text-muted">Masukkan judul video yang sesuai</small>
                    <?= form_error('judul_vid'); ?>
                </div>
                <div class="form-group">
                    <?= form_label('Deskripsi', 'deskripsi_vid') ?>
                    <?= form_textarea([
                        'class'       => 'form-control',
                        'id'          => 'deskripsi_vid',
                        'maxlength'   => 255,
                        'name'        => 'deskripsi_vid',
                        'placeholder' => 'deskripsi video ..',
                        // 'required'    => '',
                        'rows'        => 3,
                    ], set_value('deskripsi_vid')) ?>
                    <small class="form-text text-muted">Masukkan deskripsi maksimum 255 karakter</small>
                    <?= form_error('deskripsi_vid'); ?>
                </div>
                <div class="form-group">
                    <?= form_label('Tanggal Kegiatan', 'tanggal_vid') ?>
                    <?= form_input([
                        'class'       => 'form-control',
                        'id'          => 'tanggal_vid',
                        'name'        => 'tanggal_vid',
                        'placeholder' => 'tanggal video ..',
                        // 'required'    => '',
                        'type'        => 'date',
                    ], set_value('tanggal_vid')) ?>
                    <small class="form-text text-muted">Masukkan tanggal video yang sesuai</small>
                    <?= form_error('tanggal_vid'); ?>
                </div>

                <div class="form-group">
                    <?= form_label('Link YouTube', 'link') ?>
                    <?= form_input([
                        'class'       => 'form-control',
                        'id'          => 'link',
                        'name'        => 'link',
                        'placeholder' => 'link youtube',
                        //'required'    => '',
                        'pattern'     => '^(?:https?:\\/\\/)?(?:www\\.)?(?:youtube\\.com\\/watch\\?v=([a-zA-Z0-9_]+)|youtu\\.be\\/([a-zA-Z\\d_]+))(?:&.*)?$',
                    ], set_value('link')) ?>
                    <small class="form-text text-muted">Masukkan link yang sesuai</small>
                    <?= form_error('link'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php foreach ($video->result() as $vd) { ?>
    <form action="<?= base_url() ?>admin/video/delete/" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="modal-hapus<?= $vd->id_video; ?>" aria-hidden="true">
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
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus file dari <b><?= $vd->judul_vid ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="hidden" name="id_hapus" value="<?= $vd->id_video; ?>" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>