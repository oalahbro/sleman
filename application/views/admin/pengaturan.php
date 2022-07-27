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
    <section class="content">
        <div class="card">
            <div class="row">
                <div class="col-12" style="align-items: center; padding: 30px;">
                    <form method="post" action="<?= base_url('admin/pengaturan/update') ?>" enctype="multipart/form-data">
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
                                        <?php if ($data['gambar_logo'] == '' || $data['gambar_logo'] == null) { ?>
                                            <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/logo/default-image.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        <?php } else { ?>
                                            <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/logo/<?= $data['gambar_logo'] ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-file mb-2 dropzone-wrapper">
                                <input type="file" class="dropzone" name="logo" id="logo" accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="logo"><?= $data['gambar_logo'] ?></label>
                            </div>
                            <small id="logo" class="form-text text-muted">Pilihlah File foto pengurus berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar Banner (Beranda)</label><br>
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
                                        <?php if ($data['gambar_beranda'] == '' || $data['gambar_beranda'] == null) { ?>
                                            <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/banner/default-image.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        <?php } else { ?>
                                            <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/banner/<?= $data['gambar_beranda'] ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-file mb-2 dropzone-wrapper">
                                <input type="file" class="dropzone" name="banner" id="banner" accept="image/png, image/jpg, image/jpeg">
                                <label class="custom-file-label" for="banner"><?= $data['gambar_beranda'] ?></label>
                            </div>
                            <small id="banner" class="form-text text-muted">Pilihlah File foto banner di halaman utama Max ukuran file 2 MB. Format (JPG/PNG)</small>
                        </div>
                        <div class="form-group">
                            <label for="visi"><i class="fas fa-paragraph"></i> Isi Visi dan Misi</label>
                            <textarea class="textarea" name="visi" id="visi"><?= $data['visi_misi'] ?></textarea>
                            <small class="form-text text-muted">Bisa di isi konten postingan</small>
                        </div>
                        <div class="form-group">
                            <label for="sambutan"><i class="fas fa-paragraph"></i> Isi Sambutan</label>
                            <textarea class="textarea" name="sambutan" id="sambutan"><?= $data['sambutan'] ?></textarea>
                            <small class="form-text text-muted">Bisa di isi konten postingan</small>
                        </div>
                        <div class="form-group">
                            <label for="sejarah"><i class="fas fa-paragraph"></i> Isi Sejarah</label>
                            <textarea class="textarea" name="sejarah" id="sejarah"><?= $data['sejarah'] ?></textarea>
                            <small class="form-text text-muted">Bisa di isi konten postingan</small>
                        </div>
                        <div class="form-group">
                            <label for="anggaran"><i class="fas fa-paragraph"></i> Isi Anggaran</label>
                            <textarea class="textarea" name="anggaran" id="anggaran"><?= $data['anggaran'] ?></textarea>
                            <small class="form-text text-muted">Bisa di isi anggaran</small>
                        </div>
                        <center>
                            <div class="footer">
                                <input type="hidden" name="id_edit" value="<?= $data['id_pengaturan'] ?>">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </section>