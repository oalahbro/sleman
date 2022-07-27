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
                        <li class="breadcrumb-item"><a href="<?= base_url('structure') ?>">Struktur</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="px-2">
            <?= flashdata('pesan') ?>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="row">
                <div class="col-12" style="align-items: center; padding: 30px;">
                    <?= form_open_multipart('structure/submit') ?>
                    <div class="form-group">
                        <?php
                        $jabatan_option = ['' => '--Pilih Jabatan--'];

                        foreach ($jabatan as $jbt) {
                            $jabatan_option[$jbt->id_jabatan] = $jbt->jenis_jabatan;
                        }
                        ?>
                        <?= form_label('Jabatan', 'dijabat') ?>
                        <?= form_dropdown('jabatan', $jabatan_option, set_select('jabatan'), ['id' => 'dijabat', 'class' => 'form-control selectpicker', 'data-live-search' => 'true']) ?>
                        <small class="form-text text-muted">Pilih Jabatan</small>
                        <?= form_error('jabatan') ?>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar Pegawai</label><br />
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
                                    <img id="prev_foto1" src="<?= base_url('assets/dist/img/upload.png') ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px" />
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mb-2 dropzone-wrapper">
                            <input type="file" class="dropzone" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg" />
                            <label class="custom-file-label" for="foto">Masukkan foto berukuran 500 x 500 . .</label>
                        </div>
                        <small id="image" class="form-text text-muted">Pilihlah File foto pengurus berukuran 500 x 500. Max 2 MB. Format (JPG/PNG)</small>
                    </div>
                    <div class="form-group">
                        <label for="nama_pengurus">Nama Pengurus:</label>
                        <?= form_input([
                            'name'        => 'nama_pengurus',
                            'class'       => 'form-control',
                            'maxlength'   => '200',
                            'placeholder' => 'Masukkan nama...',
                            'required'    => '',
                        ], set_value('nama_pengurus')) ?>
                        <small id="nama_pengurus" class="form-text text-muted">Masukkan nama pengurus</small>
                        <?= form_error('nama_pengurus') ?>
                    </div>
                    <div class="form-group">
                        <label for="masjab">Masa Jabatan:</label>
                        <?= form_input([
                            'class'       => 'form-control',
                            'name'        => 'masjab',
                            'id'          => 'masjab',
                            'placeholder' => 'Masukkan masa jabatan...',
                            'required'    => '',
                        ], set_value('masjab')) ?>
                        <small id="masjab" class="form-text text-muted">Masukkan masa jabatan</small>
                        <?= form_error('masjab') ?>
                    </div>
                    <div class="footer text-center">
                        <a href="<?= base_url('structure') ?>" class="btn btn-secondary" hr>Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
