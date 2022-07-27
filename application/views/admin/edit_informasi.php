<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <h2 class="font-weight-bolder mb-0">Edit Data</h2>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="flash-data" data-flashdata="<?= flashdata('message'); ?>"></div>

    </section>
    <div class="card-body">
        <div class="px-2">
            <?= flashdata('pesan'); ?>
        </div>

        <?php foreach ($informasi as $detInformasi) { ?>

            <form action="<?= base_url() . 'admin/informasi/update'; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_informasi" value="<?= $detInformasi->id_informasi ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" required class="form-control" name="tanggal" id="tanggal" value="<?= $detInformasi->tanggal_info ?>">
                    </div>
                    <div class="form-group">
                        <label for="judul">Ubah Judul</label>
                        <input type="text" pattern="[a-zA-Z0-9 ,.-]{2,100}" title="Masukkan minimal 2, maksimum 100, hanya alphabet, spasi, dash dan underscore" required class="form-control" name="judul" value="<?= $detInformasi->judul_informasi ?>">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Ubah Deskripsi</label>
                        <textarea class="form-control" pattern="[a-zA-Z0-9 ,.-]{2,250}" name="deskripsi" id="deskripsi" rows="3" maxlength="250" placeholder="Masukkan Deskripsi..." required><?= $detInformasi->deskripsi_info ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Upload Thumbnail</label><br>
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
                                    <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/informasi/<?= $detInformasi->thumbnail_info ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mb-2 dropzone-wrapper">
                            <input type="file" class="dropzone" name="thumbnail" id="foto" accept="image/png, image/jpg, image/jpeg">
                            <label class="custom-file-label" for="foto"><?= $detInformasi->thumbnail_info ?></label>
                        </div>
                        <small id="foto" class="form-text text-muted">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                    </div>
                    <!-- <div class="form-group">
                                <label for="thumbnail">Upload Thumbnail</label><br>
                                <?php if ($detInformasi->thumbnail_info !== null) { ?>
                                <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/informasi/<?= $detInformasi->thumbnail_info ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                <?php } else { ?>
                                <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                <?php } ?>
                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" name="thumbnail" id="foto">
                                    <label class="custom-file-label" for="thumbnail">Masukkan foto berukuran 753 x 258 . .</label>
                                </div>
                                <small id="foto" class="form-text text-muted">Pilihlah File foto thumbnail berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                            </div> -->
                    <div class="form_group">
                        <label for="konten">Ubah Informasi</label>
                        <textarea class="textarea" class="form-control" name="konten" id="konten" rows="10" cols="80"><?= $detInformasi->konten_info ?>
                                </textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Ubah Status Tampil:</label>
                        <select class="custom-select" name="status" id="status" required>
                            <option value="" selected>Ubah Status Tampil</option>
                            <option value="1" <?= $detInformasi->status_info === '1' ? 'selected' : '' ?>>AKTIF</option>
                            <option value="0" <?= $detInformasi->status_info === '0' ? 'selected' : '' ?>>NONAKTIF</option>
                        </select>
                    </div>
                </div>
                <div class="form-group text-center">
                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>admin/informasi">Kembali</a>
                    <button class="btn btn-primary px-3 mr-1" type="submit">Simpan</button>
                </div>
            </form>

    </div>
</div>
</div>


</div>

<?php } ?>
