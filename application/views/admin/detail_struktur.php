<div class="container-fluid mb-5">

    <div class="row justify-content-center py-3">
        <div class="col-md-8 card p-0">
            <div class="card-header pb-0">
                <h2 class="font-weight-bolder mb-0">Detail Data</h2>
                <ul class="breadcrumb bg-transparent ml-n3 mt-n3 mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/struktur"></i> Struktur</a></li>
                    <li class="breadcrumb-item active">Detail Struktur</li>
                </ul>
            </div>
            <div class="card-body">
                <?php foreach ($struktur as $str) { ?>
                    <section class="content">
                        <div class="card">
                            <div class="row">
                                <div class="col-12" style="align-items: center; padding: 30px;">
                                    <form>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" name="jabatan" id="jabatan" value="<?= $str->jenis_jabatan ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Gambar Pegawai</label><br>
                                            <!-- <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px"> -->
                                            <!-- <div class="custom-file mb-2"> -->
                                            <div class="preview-zone hidden">
                                                <div class="box box-solid">
                                                    <div class="box-body">
                                                        <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/struk/<?= $str->image ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-file mb-2 dropzone-wrapper">
                                                <input type="file" class="dropzone" name="foto" id="foto" value="<?= $str->image ?>">
                                                <label class="custom-file-label" for="foto"><?= $str->image ?></label>
                                            </div>
                                            <!--<small id="image" class="form-text text-muted">Pilihlah File foto pegawai berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_pengurus">Nama Pegawai:</label>
                                            <input class="form-control" name="nama_pengurus" id="nama_pengurus" value="<?= $str->nama_pengurus ?>" maxlength="255"></input>
                                            <!--<small id="nama_pengurus" class="form-text text-muted">Masukkan nama pegawai</small>-->
                                            <!--<?php //php echo form_error('nama_pengurus');
                                                ?>-->
                                        </div>
                                        <div class="form-group">
                                            <label for="masjab">Masa Jabatan:</label>
                                            <input class="form-control" name="masjab" id="masjab" value="<?= $str->masa_jabatan ?>"></input>
                                            <!--<small id="masjab" class="form-text text-muted">Masukkan masa jabatan</small>-->
                                            <?php //php echo form_error('masjab');
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="masir">Masa Jabatan:</label>
                                            <input class="form-control" name="masir" id="masir" value="<?= $str->masa_berakhir ?>"></input>
                                            <!--<small id="masir" class="form-text text-muted">Masukkan masa jabatan</small>-->
                                            <?php //php echo form_error('masir');
                                            ?>
                                        </div>
                                        <center>
                                            <div class="footer">
                                                <!--<input class="form-control" hidden name="id_struktur" id="id_struktur" value="<?php //= $str->id_struktur
                                                                                                                                    ?>" placeholder="Masukkan masa jabatan..." required></input>-->
                                                <a href="<?= base_url('admin/struktur') ?>" class="btn btn-secondary" hr>Tutup</a>
                                                <!--<button type="submit" class="btn btn-success">Update</button>-->
                                            </div>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
    </div>