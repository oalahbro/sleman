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
    <?php foreach ($redaksi as $str) { ?>
        <section class="content">
            <div class="card">
                <div class="row">
                    <div class="col-12" style="align-items: center; padding: 30px;">
                        <form method="post" action="<?= base_url('admin/redaksi/update'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Redaksi</label>
                                <select name="struktur_redaksi" value="<?= $str->id_struktur_redaksi; ?>" class="form-control selectpicker" data-live-search="true">
                                    <!-- <option value="<?= $str->id_struktur_redaksi; ?>">
                                        <?= $str->jenis_redaksi; ?>
                                    </option> -->
                                    <?php
                                    // $id = $str->id_struktur_redaksi;
                                    $data = $this->db->query('SELECT * FROM struktur_redaksi')->result_array();

                                    foreach ($data as $key) { ?>
                                        <option value="<?= $key['id_struktur_redaksi'] ?>" <?= ($key['id_struktur_redaksi'] === $str->id_struktur_redaksi) ? 'selected' : '' ?>>
                                            <?= $key['jenis_redaksi']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small class="form-text text-muted">Pilih Jabatan</small>
                                <?= form_error('struktur_redaksi'); ?>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Pengurus</label><br>
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
                                            <?php if ($str->gambar == '' || $str->gambar == null) { ?>
                                                <img id="prev_foto1" src="<?= base_url() ?>uploads/images/default.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                            <?php } else { ?>
                                                <img id="prev_foto1" src="<?= base_url() ?>uploads/images/<?= $str->gambar ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-file mb-2 dropzone-wrapper">
                                    <input type="file" class="dropzone" name="foto" id="foto" value="<?= $str->gambar ?>" accept="image/png, image/jpg, image/jpeg">
                                    <label class="custom-file-label" for="foto"><?= $str->gambar ?></label>
                                </div>
                                <small id="image" class="form-text text-muted">Pilihlah File foto pengurus berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                            </div>
                            <div class="form-group">
                                <label for="nama_pengurus">Nama Pengurus:</label>
                                <input class="form-control" name="nama_pengurus" id="nama_pengurus" value="<?= $str->nama_pengurus ?>" maxlength="255" placeholder="Masukkan nama..."></input>
                                <small id="nama_pengurus" class="form-text text-muted">Masukkan nama pengurus</small>
                                <?= form_error('nama_pengurus'); ?>
                            </div>
                            <div class="form-group">
                                <label for="masjab">Masa Jabatan:</label>
                                <input class="form-control" name="masjab" id="masjab" value="<?= $str->masa_jabatan ?>" placeholder="Masukkan masa jabatan..."></input>
                                <small id="masjab" class="form-text text-muted">Masukkan masa jabatan</small>
                                <?= form_error('masjab'); ?>
                            </div>
                            <center>
                                <div class="footer">
                                    <input class="form-control" hidden name="id_redaksi" id="id_redaksi" value="<?= $str->id_redaksi ?>" placeholder="Masukkan masa jabatan..."></input>
                                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>redaction">Kembali</a>
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
