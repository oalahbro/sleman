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
            unset($_SESSION['pesan']);
            ?>
        </div>
    </div>
    <?php foreach ($banner as $str) { ?>
        <section class="content">
            <div class="card">
                <div class="row">
                    <div class="col-12" style="align-items: center; padding: 30px;">
                        <form method="post" action="<?= base_url('admin/banner/update'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="image">Gambar Banner</label><br>
                                <!-- <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px"> -->
                                <!-- <div class="custom-file mb-2"> -->
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
                                            <img id="prev_foto1" src="<?= base_url() ?>uploads/images/<?= $str->foto_banner ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-file mb-2 dropzone-wrapper">
                                    <input type="file" class="dropzone" name="foto" id="foto" value="<?= $str->foto_banner ?>" accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="foto"><?= $str->foto_banner ?></label>
                                </div>
                                <small id="image" class="form-text text-muted">Pilihlah File gambar Max 2 MB. Format (JPG/PNG)</small>
                            </div>
                            <div class="form-group">
                                <label for="nama_pengurus">Link Banner:</label>
                                <input class="form-control" name="link_banner" id="link_banner" value="<?= $str->link_banner ?>" maxlength="255" placeholder="Masukkan nama..."></input>
                                <small id="link_bannner" class="form-text text-muted">Masukkan link yang valid</small>
                                <?= form_error('link_banner'); ?>
                            </div>
                            <div>
                                <label for="status">Status</label>
                                <select class="custom-select" name="status_banner" id="status_banner">
                                    <option value="" selected>Pilih Status</option>
                                    <option value="1" <?= $str->status_banner === '1' ? 'selected' : '' ?>>Tampilkan</option>
                                    <option value="0" <?= $str->status_banner === '0' ? 'selected' : '' ?>>Sembunyikan</option>
                                </select>
                                <small id="status" class="form-text text-muted">Pilih Status Tampilkan Atau Sembunyikan</small>
                                <?= form_error('status_banner'); ?>
                            </div>
                            <center>
                                <div class="footer">
                                    <input class="form-control" hidden name="id_banner" id="id_banner" value="<?= $str->id_banner ?>" placeholder="Masukkan ..."></input>
                                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>banner">Kembali</a>
                                    <button class="btn btn-success px-3 mr-1" type="submit"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</div>