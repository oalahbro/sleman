
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
          <h2 class="font-weight-bolder mb-0">Tambah Data</h2>
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



                    <form action="<?= base_url() . 'admin/informasi/tambah'; ?>" method="post" enctype="multipart/form-data">


                        <div class="modal-body">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" pattern="[a-zA-Z0-9 ,.-]{2,100}" name=" judul" id="judul" rows="3" maxlength="100" placeholder="Masukkan Judul..." value="<?= set_value('judul') ?>" required>
                                <small id="judul" class="form-text text-muted">Judul maksimum 100 karakter</small>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" pattern="[a-zA-Z0-9 ,.-]{2,250}" name="deskripsi" id="deskripsi" rows="3" maxlength="250" placeholder="Masukkan Deskripsi..." required><?= set_value('deskripsi') ?></textarea>
                                <small id="deskripsi" class="form-text text-muted">Deskripsi maksimum 250 karakter</small>
                            </div>
                            <div class="form-group">
							<label for="thumbnail">Upload Thumbnail</label><br>
							<!-- <img id="prev_foto1" src="<?= base_url()?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px"> -->
							<!-- <div class="custom-file mb-2"> -->
                                    <div class="preview-zone hidden">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <div><b>Preview</b></div>
                                                <div class="box-tools pull-right">
                                                        <button type="button"
                                                            class="btn btn-danger btn-xs remove-preview">
                                                            <i class="fa fa-times"></i> Reset
                                                        </button>
                                                    </div>
                                            </div>
                                            <div class="box-body">
                                                <img id="prev_foto1" src="<?= base_url()?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
											</div>
                                        </div>
                                    </div>
							<div class="custom-file mb-2 dropzone-wrapper">
                                <input type="file" class="dropzone" name="thumbnail" id="foto" required accept="image/png, image/jpg, image/jpeg">
								<label class="custom-file-label" for="foto">Masukkan foto berukuran 753 x 258 . .</label>
							</div>
							<small id="foto" class="form-text text-muted">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
						</div>
                            <!-- <div class="form-group">
                                <label for="thumbnail">Upload Thumbnail</label><br>
                                <img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" name="thumbnail" id="foto" required>
                                    <label class="custom-file-label" for="thumbnail">Masukkan foto berukuran 753 x 258 . .</label>
                                </div>
                                <small id="thumbnail" class="form-text text-muted">Pilihlah File foto thumbnail berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                            </div> -->
                            <div class="form-group">
                                <label for="deskripsi">Informasi</label>
                                <!-- <textarea class="form-control" name="editor1" id="ckeditor"></textarea> -->
                                <textarea class="textarea" class="form-control" name="konten" id="konten" placeholder="Isi artikel disini..." required></textarea>
                            </div>
                            <input type="hidden" readonly required class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d H:i:s') ?>">
                            <div class="form-group">
                                <label for="status">Status Tampil Informasi</label>
                                <select class="custom-select" name="status" id="status" required>
                                    <option value="" selected>Pilih Status</option>
                                    <option value="1">AKTIF</option>
                                    <option value="0">NONAKTIF</option>
                                </select>
                            </div>
                        </div>
                </div>
                        <div class="form-group text-center">
                                <a href="<?= base_url('admin/informasi') ?>" class="btn btn-secondary" hr>Tutup</a>
                                <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>


</div>

