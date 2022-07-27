<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $tittle; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $tittle; ?></li>
                    </ol>
                </div>
            </div>
            <div class="flash-data" data-flashdata="<?= flashdata('message'); ?>"></div>
        </div>

    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <?php foreach ($sliderr as $detSliderr) { ?>

                    <form action="<?= base_url() . 'admin/slider_kedua/update'; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_fotoslider" value="<?= $detSliderr->id_fotoslider ?>">
                        <input type="hidden" name="foto_slider" value="<?= $detSliderr->file_slider ?>">

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Slider:</label>
                                <input type="text" pattern="[a-zA-Z0-9 ]{2,100}" title="Masukkan minimal 2, maksimum 100, hanya alphabet, spasi, dash dan underscore" required class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan nama..." value="<?= $detSliderr->foto_slider ?>">
                                <small id="nama" class="form-text text-success">Masukkan nama slider yang sesuai</small>
                                <?= form_error('nama'); ?>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Slider:</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" maxlength="255" placeholder="Masukkan deskripsi..." required><?= $detSliderr->deskripsi_slider ?></textarea>
                                <small id="deskripsi" class="form-text text-success">Masukkan deskripsi maksimum 255 karakter</small>
                                <?= form_error('deskripsi'); ?>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto Slider</label><br>
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
                                            <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/slide2/<?= $detSliderr->file_slider ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-file mt-2 mb-2 dropzone-wrapper">
                                    <input type="file" class="dropzone" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="foto"><?= $detSliderr->file_slider ?></label>
                                </div>
                                <small id="foto" class="form-text text-success">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>slider_2">Kembali</a>
                            <button class="btn btn-warning px-3 mr-1" type="submit"><i class="far fa-save"></i> Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </section>
</div>


</div>

<?php } ?>
