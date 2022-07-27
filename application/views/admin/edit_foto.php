<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<h2 class="font-weight-bolder mb-0">Edit Data Foto</h2>
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

		<?php foreach ($foto as $f) { ?>

			<form action="<?= base_url() . 'admin/Foto/update'; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_foto" value="<?= $f->id_foto ?>">

				<div class="modal-body">
					<div class="form-group">
						<label for="judul_foto">Judul Foto:</label>
						<input type="text" class="form-control" name="judul_foto" id="judul_foto" aria-describedby="nama" placeholder="Masukkan judul foto..." value="<?= $f->judul_foto ?>">
						<small id="judul_foto" class="form-text text-muted">Masukkan nama foto yang sesuai</small>
						<?= form_error('judul_foto'); ?>
					</div>
					<div class="form-group">
						<label for="deskripsi_foto">Deskripsi Foto:</label>
						<textarea class="form-control" name="deskripsi_foto" id="deskripsi_foto" rows="3" maxlength="255" placeholder="Masukkan deskripsi foto..."><?= $f->deskripsi_foto ?></textarea>
						<small id="deskripsi_foto" class="form-text text-muted">Masukkan deskripsi maksimum 255 karakter</small>
						<?= form_error('deskripsi_foto'); ?>
					</div>
					<div class="form-group">
						<label for="foto">Foto Giat Kerja</label><br>
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
									<?php if ($f->foto == '' || $f->foto == null) { ?>
										<img id="prev_foto1" src="<?= base_url() ?>uploads/images/default.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
									<?php } else { ?>
										<img id="prev_foto1" src="<?= base_url() ?>uploads/images/<?= $f->foto ?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="custom-file mb-2 dropzone-wrapper">
							<input type="file" class="dropzone" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
							<label class="custom-file-label" for="foto"><?= $f->foto ?></label>
						</div>
						<small id="foto" class="form-text text-muted">Pilihlah File foto berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
					</div>
				</div>
				<div class="form-group text-center">
					<a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>foto_gk">Kembali</a>
					<button class="btn btn-success px-3 mr-1" type="submit"><i class="fas fa-save"></i> Simpan</button>
				</div>
			</form>

	</div>
</div>
</div>


</div>

<?php } ?>
