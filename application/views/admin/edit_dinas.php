<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <h2 class="font-weight-bolder mb-0">Edit Data Dinas Terkait</h2>
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
    </section>
    <div class="card-body">
        <div class="px-2">
            <?= flashdata('pesan');
            unset($_SESSION['pesan']);
            ?>
        </div>

        <?php foreach ($dinas as $f) { ?>

            <form action="<?= base_url() . 'admin/dinas/update'; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_diter" value="<?= $f->id_diter ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_dinas">Nama Dinas:</label>
                        <input type="text" class="form-control" name="nama_dinas" id="nama_dinas" aria-describedby="nama" placeholder="Masukkan judul foto..." value="<?= $f->nama_dinas ?>">
                        <small id="nama_dinas" class="form-text text-muted">Masukkan nama dinas yang sesuai</small>
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
                                    <?php if ($f->logo == '' || $f->logo == null) { ?>
                                        <img id="prev_foto1" src="<?= base_url() ?>uploads/images/default.jpg" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                    <?php } else { ?>
                                        <img id="prev_foto1" src="<?= base_url() ?>uploads/images/<?= $f->logo ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mb-2 dropzone-wrapper">
                            <input type="file" class="dropzone" name="logo" id="logo" accept="image/png, image/jpg, image/jpeg">
                            <label class="custom-file-label" for="logo">
                                <?php if ($f->logo == '' || $f->logo == null) { ?>
                                    Belum ada gambar
                                <?php } else { ?>
                                    <?= $f->logo ?>
                                <?php } ?>
                            </label>
                        </div>
                        <small id="logo" class="form-text text-muted">Pilihlah File foto Max 1 MB. Format (JPG/JPEG/PNG)</small>
                    </div>
                    <div class="form-group">
                        <label for="link">Link Website</label>
                        <input type="text" class="form-control" name="link" id="link" value="<?= $f->link ?>" placeholder="Masukkan Link Website...">
                        <small class="form-text text-muted">Merupakan Link Website</small>
                        <?= form_error('link'); ?>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select class="custom-select" name="status" id="status">
                            <option value="" selected>Pilih Status</option>
                            <option value="1" <?= $f->status === '1' ? 'selected' : '' ?>>Tampilkan</option>
                            <option value="0" <?= $f->status === '0' ? 'selected' : '' ?>>Sembunyikan</option>
                        </select>
                        <small id="status" class="form-text text-muted">Pilih Status Tampilkan Atau Sembunyikan</small>
                        <?= form_error('status'); ?>
                    </div>
                </div>
                <div class="form-group text-center">
                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>dinas">Kembali</a>
                    <button class="btn btn-success px-3 mr-1" type="submit"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>

    </div>
</div>
</div>


</div>

<?php } ?>