<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
						<li class="breadcrumb-item active"><?= $title; ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
		<div class="px-2">
			<?= flashdata('pesan');
			unset($_SESSION['pesan']); ?>
		</div>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="card-header">
			<div class="text-right">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus-circle"></i> <?= $title; ?></button>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<table id="publikasi" class="table table-bordered table-striped">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama Pembuat</th>
									<th>Judul Riset</th>
									<th>File</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($publikasi as $pb) {
								?>
									<tr>
										<td class="text-center"><?= $no++ ?></td>
										<td><?= $pb->nama_pembuat; ?></td>
										<td><?= $pb->judul_riset; ?></td>
										<td>
											<i class="fas <?= FontAwesomeIcon(get_mime_by_extension($pb->file)) ?>"> <?= $pb->file ?>
										</td>
										<td class="text-center" width="160px">
											<button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modal-edit<?= $pb->id_publikasi; ?>"><b><i class="fas fa-edit"></i>
													Edit</b></button>
											<button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $pb->id_publikasi; ?>"><i class="fas fa-trash"></i>
												<b>Hapus</b></button>
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

<?php foreach ($publikasi as $p) { ?>
	<?= form_open_multipart('admin/riset/edit', ['name' => 'riset1', 'onsubmit' => "return validate2()"]) ?>
	<div class="modal fade" id="modal-edit<?= $p->id_publikasi ?>" aria-hidden="true" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h4 class="modal-title">Edit Publikasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama Pembuat</label>
						<input type="text" name="nama" value="<?= $p->nama_pembuat; ?>" class="form-control" placeholder="Nama Menu">
						<small class="form-text text-muted">Isikan Nama Pembuat</small>
						<div id="errornama1" style="color: red;"></div>
					</div>
					<div class="form-group">
						<label for="judul_riset">Judul</label>
						<input type="text" name="judul" value="<?= $p->judul_riset; ?>" class="form-control" placeholder="Judul riset">
						<small class="form-text text-muted">Judul</small>
						<div id="errorjudul1" style="color: red;"></div>
					</div>
					<div class="form-group">
						<div class="custom-file">
							<input type="file" name="berkas" value="<?= $p->file; ?>" class="custom-file-input" id="file" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
							<label class="custom-file-label" for="file"><?= $p->file; ?></label>
						</div>
						<small class="form-text text-muted">Unggah file publikasi. *maksimal ukuran 10mb</small>
						<div id="errorfile1" style="color: red;"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<input type="hidden" name="id_edit" value="<?= $p->id_publikasi; ?>" required>
					<button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>
	<?= form_close() ?>
	<form action="<?= base_url() . 'admin/riset/delete' ?>" method="post" enctype="multipart/form-data">
		<div class="modal fade" id="modal-hapus<?= $p->id_publikasi; ?>" aria-hidden="true">
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
							<img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img"> -->
							<h4 class="mb-4">Apakah anda yakin untuk menghapus file ini?</h4>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<input type="hidden" name="id_hapus" value="<?= $p->id_publikasi; ?>" required>
						<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php } ?>

<!-- Modal tambah Tags -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title title-1" id="myModalLabel">Tambah Publikasi Riset</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('admin/riset/tambah_publikasi', ['name' => 'riset', 'onsubmit' => "return validate()"]) ?>

			<div class="modal-body">
				<div class="form-group">

					<label for="nama_pembuat">Nama Pembuat</label>
					<input type="text" name="nama_pembuat" id="nama_pembuat" class="form-control" placeholder="Masukkan Nama Pembuat . ." aria-describedby="namapem" maxlength="100" autocomplete="off">
					<small class="form-text text-muted">Isikan Nama Pembuat</small>

					<div id="errornama" style="color: red;"></div>
				</div>
				<div class="form-group">

					<label for="judul_riset">Judul</label>
					<input type="text" name="judul_riset" id="judul_riset" class="form-control" placeholder="Masukkan judul" maxlength="100" autocomplete="off">
					<small class="form-text text-muted">Isikan Judul Riset</small>

					<div id="errorjudul" style="color: red;"></div>
				</div>
				<div class="form-group">
					<!-- <input type="hidden" class="form-control" id="" name="ID_TAGS" value="<?= $ID_TAGSS; ?>"> -->

					<label for="file">File Publikasi</label>
					<input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" placeholder="Masukkan Nama File . ." aria-describedby="namafile" maxlength="100" autocomplete="off">
					<small class="form-text text-muted">Unggah file publikasi. *maksimal ukuran 10mb</small>
					<div id="errorfile" style="color: red;"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" id="save-btn" class="btn btn-success"><i class="far fa-save"></i> Tambah</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script>
	function validate() {

		var nama = document.riset.nama_pembuat.value;
		var judul = document.riset.judul_riset.value;
		var file = document.riset.file.value;
		var status = false;

		// Validasi tambah
		if ((nama == "")) {
			document.getElementById("errornama").innerHTML =
				"<b>Nama tidak boleh kosong</b>";
			status = false;
		} else if (nama.match(/[^a-zA-Z0-9 '"]/g, "")) {
			document.getElementById("errornama").innerHTML =
				"<b>Nama tidak boleh menggunakan karakter spesial</b>";
			status = false;
		} else {
			document.getElementById("errornama").innerHTML = " ";
			status = true;
		}

		if (judul == "") {
			document.getElementById("errorjudul").innerHTML =
				"<b>Judul tidak boleh kosong</b>";
			status = false;
		} else if (judul.match(/[^a-zA-Z0-9 '"]/g, "")) {
			document.getElementById("errorjudul").innerHTML =
				"<b>Judul tidak boleh menggunakan karakter spesial</b>";
			status = false;
		} else {
			document.getElementById("errorjudul").innerHTML = " ";
			status = true;
		}

		if (file == "") {
			document.getElementById("errorfile").innerHTML =
				"<b>File tidak boleh kosong</b>";
			status = false;
		} else {
			document.getElementById("errorfile").innerHTML = " ";
		}
		return status;
	}
</script>

<script>
	function validate2() {
		var nama1 = document.riset1.nama.value;
		var judul1 = document.riset1.judul.value;
		var file1 = document.riset1.berkas.value;
		var status1 = false;

		// Validasi edit
		if ((nama1 == "")) {
			document.getElementById("errornama1").innerHTML =
				"<b>Nama tidak boleh kosong</b>";
			status1 = false;
		} else if (nama1.match(/[^a-zA-Z0-9 '"]/g, "")) {
			document.getElementById("errornama1").innerHTML =
				"<b>Nama tidak boleh menggunakan karakter spesial</b>";
			status1 = false;
		} else {
			document.getElementById("errornama1").innerHTML = " ";
			status1 = true;
		}

		if (judul1 == "") {
			document.getElementById("errorjudul1").innerHTML =
				"<b>Judul tidak boleh kosong</b>";
			status1 = false;
		} else if (judul1.match(/[^a-zA-Z0-9 '"]/g, "")) {
			document.getElementById("errorjudul1").innerHTML =
				"<b>Judul tidak boleh menggunakan karakter spesial</b>";
			status1 = false;
		} else {
			document.getElementById("errorjudul1").innerHTML = " ";
			status1 = true;
		}

		if (file1 == "") {
			document.getElementById("errorfile1").innerHTML =
				"<b>File tidak boleh kosong</b>";
			status1 = false;
		} else {
			document.getElementById("errorfile1").innerHTML = " ";
		}
		return status1;
	}
</script>