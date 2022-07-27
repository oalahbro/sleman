<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $tittle; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
						<li class="breadcrumb-item active"><?= $tittle; ?></li>
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
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="card-header">
			<div class="text-right">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> <?= $tittle; ?></button>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<table id="fotogk" class="table table-bordered table-striped">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Foto</th>
									<th>Judul</th>
									<th>Deskripsi</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($foto as $ft) {
								?>
									<tr>
										<td class="text-center" width="100px"><?= $no++ ?></td>
										<?php if ($ft->foto == '' || $ft->foto == null) { ?>
											<td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada Foto" class="img-fluid"></td>
										<?php } else { ?>
											<td width="150px"><img width="150px" height="150px" src="<?= base_url() ?>uploads/images/<?= $ft->foto ?>" alt="<?= $ft->foto ?>" srcset="" class="img-fluid"></td>
										<?php } ?>
										<td><?= $ft->judul_foto; ?></td>
										<td><?= $ft->deskripsi_foto; ?></td>
										<td><?= $ft->tgl_fotogk; ?></td>
										<td class="text-center" width="160px">
											<a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>foto_gk/edit/<?= $ft->id_foto ?>"><b><i class="fas fa-edit"></i> Edit</b></a>
											<a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $ft->id_foto; ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
										</td>
									</tr>
								<?php
								} ?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal tambah Tags -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title title-1" id="myModalLabel">Tambah Foto Giat Kerja</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= base_url('admin/Foto/tambah_foto'); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<!-- <input type="hidden" class="form-control" id="" name="ID_TAGS" value="<?= $id_foto; ?>"> -->
						<label for="judul_foto">Judul Foto</label>
						<input type="text" name="judul_foto" id="judul_foto" class="form-control" placeholder="Masukkan Judul Foto . ." aria-describedby="judfot" maxlength="100" autocomplete="off">
						<small id="judul_foto" class="form-text text-muted">Masukkan nama foto yang sesuai</small>
						<?= form_error('judul_foto'); ?>
					</div>
					<div class="form-group">
						<!-- <input type="hidden" class="form-control" id="" name="ID_TAGS" value="<?= $id_foto; ?>"> -->

						<label for="deskripsi_foto">Deskripsi Foto</label>
						<textarea class="form-control" name="deskripsi_foto" id="deskripsi_foto" class="form-control" placeholder="Masukkan Deskripsi Foto . ." aria-describedby="desfot" maxlength="100" autocomplete="off"></textarea>
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
									<img id="prev_foto1" src="<?= base_url() ?>assets/dist/img/upload.png" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
								</div>
							</div>
						</div>
						<div class="custom-file mb-2 dropzone-wrapper">
							<input type="file" class="dropzone" name="foto" id="foto">
							<label class="custom-file-label" for="foto">Masukkan foto berukuran 753 x 258 . .</label>
						</div>
						<small id="foto" class="form-text text-muted">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php foreach ($foto as $f) { ?>

	<form action="<?= base_url() . 'admin/foto/delete' ?>" method="post" enctype="multipart/form-data">
		<div class="modal fade" id="modal-hapus<?= $f->id_foto; ?>" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<h4 class="modal-title">Hapus Data</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body justify-content-center">
						<div class="text-center">
							<img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
							<h4 class="mb-4">Apakah anda yakin untuk menghapus file dari <b><?= $f->judul_foto ?></b> ini?</h4>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<input type="hidden" name="id_hapus" value="<?= $f->id_foto; ?>" required>
						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } ?>
