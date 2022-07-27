<!-- Content Wrapper. Contains page content -->
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
		<div class="flash-data" data-flashdata="<?= flashdata('message'); ?>"></div>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="card-header">
			<div class="text-right">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
					<i class="fas fa-plus-circle"></i> <?= $judul ?></button>
			</div>
		</div>
		<div class="container py-lg-5 shadow borderDewandik px-4">
			<div class="m-4 rounded">
				<div class="content row pt-2 pl-2 pr-2">
					<!-- /.card-header -->
					<table id="data_sekolah" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Sekolah</th>
								<th>Deskripsi Sekolah</th>
								<th>Foto Sekolah</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;

                            foreach ($sekolah as $detSekolah) : ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $detSekolah->fotos ?></td>
									<td><?= $detSekolah->deskripsis ?></td>
									<td><img width="150" height="150" src="<?= base_url() ?>assets/dist/img/slide/<?= $detSekolah->files ?>" alt="<?= $detSekolah->fotos ?>" srcset="" class="img-fluid"></td>
									<td>
										<a class="btn mb-2 btn-primary btn-sm mr-2" href="<?= base_url() ?>admin/sekolah/edit/<?= $detSekolah->id_sekolah ?>"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Apakah anda yakin ingin menghapus item ini?');" href="<?= base_url() ?>admin/sekolah/hapus/<?= $detSekolah->id_sekolah ?>" class="btn btn-danger mb-2 btn-sm"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php $i++;
                            endforeach; ?>
						</tbody>
					</table>
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




<!-- Modal tambah slider -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title title-1" id="myModalLabel">Tambah Data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= base_url('admin/sekolah/tambah'); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama Sekolah:</label>
						<input type="text" pattern="[a-zA-Z0-9 ]{2,100}" title="Masukkan minimal 2, maksimum 100, hanya alphabet, spasi, dash dan underscore" required class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan nama..." value="<?= set_value('nama') ?>">
						<small id="nama" class="form-text text-muted">Masukkan nama sekolah yang sesuai</small>
						<?= form_error('nama'); ?>
					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi Sekolah:</label>
						<textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" maxlength="255" placeholder="Masukkan deskripsi..." required><?= set_value('deskripsi') ?></textarea>
						<small id="deskripsi" class="form-text text-muted">Masukkan deskripsi maksimum 250 karakter</small>
						<?= form_error('deskripsi'); ?>
					</div>
					<div class="form-group">
						<label for="foto">Foto Sekolah</label><br>
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
							<input type="file" class="dropzone" name="foto" id="foto" required accept="image/png, image/jpg, image/jpeg">
							<label class="custom-file-label" for="foto">Masukkan foto berukuran 753 x 258 . .</label>
						</div>
						<small id="foto" class="form-text text-muted">Pilihlah File foto sekolah berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="save-btn" class="btn btn-success">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
