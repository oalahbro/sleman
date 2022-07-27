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
                        <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <?= flashdata('pesan');
        unset($_SESSION['pesan']); ?>
    </div>
    <?php foreach ($video as $f) { ?>
        <section class="content">
            <div class="card">
                <div class="row">
                    <div class="col-12" style="align-items: center; padding: 30px;">
                        <form action="<?= site_url('admin/video/update') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_video" value="<?= $f->id_video ?>">

                            <div class="modal-body">
                                <div class="form-group">
                                    <?= form_label('Judul', 'judul_vid') ?>
                                    <?= form_input([
                                        'class'       => 'form-control',
                                        'id'          => 'judul_vid',
                                        'name'        => 'judul_vid',
                                        'placeholder' => 'judul video',
                                        // 'required'    => '',
                                    ], set_value('judul_vid', $f->judul_vid)) ?>

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
                                    ], set_value('deskripsi_vid', $f->deskripsi_vid)) ?>
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
                                    ], set_value('tanggal_vid', $f->tanggal_vid)) ?>
                                    <small id="tanggal_foto" class="form-text text-muted">Masukkan tanggal video yang sesuai</small>
                                    <?= form_error('tanggal_vid'); ?>
                                </div>
                                <div class="form-group">
                                    <?= form_label('Link YouTube', 'link') ?>
                                    <?= form_input([
                                        'class'       => 'form-control',
                                        'id'          => 'link',
                                        'name'        => 'link',
                                        'placeholder' => 'link youtube',
                                        // 'required'    => '',
                                        'pattern'     => '^(?:https?:\\/\\/)?(?:www\\.)?(?:youtube\\.com\\/watch\\?v=([a-zA-Z0-9_]+)|youtu\\.be\\/([a-zA-Z\\d_]+))(?:&.*)?$',
                                    ], set_value('link', $f->link)) ?>
                                    <small id="link" class="form-text text-muted">Masukkan link video yang sesuai</small>
                                    <?= form_error('link'); ?>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>video_gk">Kembali</a>
                                <button class="btn btn-success px-3 mr-1" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</div>
