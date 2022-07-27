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


    </section>
    <div class="card-body">
        <div class="px-2">
            <?= flashdata('pesan');
            unset($_SESSION['pesan']); ?>
        </div>

        <?php foreach ($sekolah as $detSekolah) { ?>

            <form action="<?= base_url() . 'admin/sekolah/update'; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_sekolah" value="<?= $detSekolah->id_sekolah ?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Sekolah:</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan nama..." value="<?= $detSekolah->nama_sekolah ?>">
                        <small id="nama" class="form-text text-muted">Masukkan nama sekolah yang sesuai</small>
                        <?= form_error('nama'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Sekolah:</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" maxlength="255" placeholder="Masukkan deskripsi..." ><?= $detSekolah->alamat_sekolah ?></textarea>
                        <small id="alamat" class="form-text text-muted">Masukkan deskripsi maksimum 255 karakter</small>
                        <?= form_error('alamat'); ?>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telp:</label>
                        <input type="number" class="form-control" name="notelp" id="notelp" value="<?= $detSekolah->no_telepon ?>" rows="3" maxlength="255" placeholder="Masukkan deskripsi...">
                        <small id="notelp" class="form-text text-muted">Masukkan deskripsi maksimum 255 karakter</small>
                        <?= form_error('notelp'); ?>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Pilih Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="PAUD" <?= $detSekolah->kategori_sekolah === 'PAUD' ? 'selected' : '' ?>>PAUD dan TK</option>
                            <option value="SD" <?= $detSekolah->kategori_sekolah === 'SD' ? 'selected' : '' ?>>SD</option>
                            <option value="SMP" <?= $detSekolah->kategori_sekolah === 'SMP' ? 'selected' : '' ?>>SMP</option>
                            <option value="SMA" <?= $detSekolah->kategori_sekolah === 'SMA' ? 'selected' : '' ?>>SMA</option>
                            <option value="SMK" <?= $detSekolah->kategori_sekolah === 'SMK' ? 'selected' : '' ?>>SMK</option>
                            <option value="KULIAH" <?= $detSekolah->kategori_sekolah === 'KULIAH' ? 'selected' : '' ?>>KULIAH</option>
                            <option value="SLB" <?= $detSekolah->kategori_sekolah === 'SLB' ? 'selected' : '' ?>>SLB</option>
                        </select>
                        <?= form_error('kategori'); ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="foto">Foto Sekolah</label><br>
                        <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/slide/<?= $detSekolah->files ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" name="foto" id="foto">
                            <label class="custom-file-label" for="foto"><?= $detSekolah->files ?></label>
                        </div>
                        <small id="foto" class="form-text text-muted">Pilihlah File foto sekolah berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                    </div> -->
                </div>
                <div class="form-group text-center">
                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>data_sekolah">Kembali</a>
                    <button class="btn btn-success px-3 mr-1" type="submit"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>

    </div>
</div>
</div>


</div>

<?php } ?>
