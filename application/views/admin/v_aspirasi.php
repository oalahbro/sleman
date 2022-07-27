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
				<?php if ($aspirasi == null) : ?>
					<button class="btn btn-sm btn-primary disabled">
						<i class="fas fa-check-double"></i> Tandai Seluruh Data Aspirasi Terbaca</button>
					<button class="btn btn-sm btn-success disabled">
						<i class="fas fa-file-excel"></i> Export Excell</button>
				<?php else : ?>
					<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalReadAll">
						<i class="fas fa-check-double"></i> Tandai Seluruh Data Aspirasi Terbaca</button>
					<!-- <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDelete">
						<i class="fas fa-file-excel"></i> Export Excell</button> -->
					<button data-toggle="modal" data-target="#modalExport" class="btn btn-sm btn-success">
						<i class="fas fa-file-excel"></i> Export Excell</button>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<?php if ($aspirasi == null) : ?>
							<!-- Jika Belum Terdapat data -->
							<div class="col-md">
								<div class="card-body text-center mt-4">
									<img src="<?= base_url('assets/dist/icon/noList.svg'); ?>" alt="noData" class="img-rounded img-responsive img-fluid" width="100">
								</div>
								<div class="card-body pt-0 mt-4">
									<h3 class="text-center text-bold text-muted">Belum terdapat data</h3>
								</div>
							</div>
						<?php else : ?>
							<div class="row">

								<?php $i = 1;

								foreach ($aspirasi as $feedback) {
									$grav_url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($feedback->email))) . '?d=mp&s=70'; ?>
									<div class="col-md-6 col-sm-12">
										<div class="card p-3">
											<div class="d-flex flex-row mb-3">
												<?php if ($feedback->read_msg === '0') { ?>
													<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
														<span class="visually-hidden"></span>
													</span>
												<?php } ?>
												<img src="<?= $grav_url ?>" width="70" alt="" class="rounded-circle" />
												<div class="d-flex flex-column ml-2">
													<?php if ($feedback->read_msg === '0') {
														$class = 'warning';
														$icon  = 'info-circle';
														$text  = 'Belum dibaca';
													} else {
														$class = 'success';
														$icon  = 'check-double';
														$text  = 'Sudah dibaca';
													} ?>
													<span><?= $feedback->nama ?></span>
													<span class="text-black-50"><?= $feedback->email ?></span>
													<div>
														<?php
														$pclass = 'success';
														$ptext                      = 'Dipublikasikan';
														$paksi                      = 'Batal dipublikasikan';
														if ($feedback->status === '0') {
															$pclass = 'warning';
															$ptext  = 'Tidak Dipublikasikan';
															$paksi  = 'Publikasikan';
														}

														$sclass = 'success';
														$stext  = 'Tampil di slider';
														$saksi  = 'Jangan tampilkan pada slider';
														if ($feedback->slider === '0') {
															$sclass = 'warning';
															$stext  = 'Tidak tampil slider';
															$saksi  = 'Tampilkan pada slider';
														}

														if ($feedback->tipe === 'kritik') {
															$bclass = 'danger';
															$btext  = 'Kritik';
														} else {
															$bclass = 'info';
															$btext  = 'Saran';
														} ?>
														<span class="badge badge-<?= $pclass ?>"><?= $ptext ?></span>
														<span class="badge badge-<?= $sclass ?>"><?= $stext ?></span>
													</div>
												</div>
											</div>
											<h6><span class="text-<?= $class ?>"><i class="fas fa-<?= $icon ?>"></i> <?= $text ?></span></h6>
											<div class="form-group text-justify">

												<h6><?php
													$string = strip_tags($feedback->isi);
													if (strlen($string) > 200) {

														// truncate string
														$stringCut = substr($string, 0, 200);
														$endPoint  = strrpos($stringCut, ' ');

														//if the string doesn't contain any space then it will cut without word basis.
														$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
														$string .= '...';
													}
													echo $string; ?></h6>
											</div>

											<div class="row">
												<div class="col-6 text-left">
													<h5><span class="badge badge-<?= $bclass ?>"><?= $btext ?></span></h5>
												</div>
												<div class="col-6 text-right">
													<div class="dropdown">
														<button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fas fas fa-angle-down"></i>
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<?= anchor('admin/aspirasi/ubah/status/' . $feedback->id_aspirasi . '/' . $feedback->status, $paksi, ['class' => 'dropdown-item']) ?>
															<?= anchor('admin/aspirasi/ubah/slider/' . $feedback->id_aspirasi . '/' . $feedback->slider, $saksi, ['class' => 'dropdown-item']) ?>
															<?= anchor('aspirasi/detail/' . $feedback->id_aspirasi, 'Lihat Detail', ['class' => 'dropdown-item']) ?>
															<?= anchor('admin/aspirasi/hapus/' . $feedback->id_aspirasi, 'Hapus', ['class' => 'dropdown-item del']) ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
								} ?>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
								<?= $halaman; ?>
							</div>
						</div>
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

<!-- Modal Baca Seluruh Aspirasi -->
<div class="modal fade" id="modalReadAll">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Tandai Seluruh Aspirasi Sudah Dibaca</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/Aspirasi/all'); ?>" method="POST">
				<div class="modal-body">
					<div class="text-center">
						<img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/read.svg" width=80% alt="delete-img">
						<h4 class="mb-4">Apakah anda yakin untuk menandai seluruh pesan aspirasi telah terbaca?</h4>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-primary">Iya <i class="fas fa-check-double"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Export Excell -->
<div class="modal fade" id="modalExport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Export Data Aspirasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/Aspirasi/export'); ?>" method="POST">
				<div class="modal-body">
					<div class="text-center">
						<img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/download.svg" width=80% alt="delete-img">
						<h4 class="mb-4">Apakah anda ingin export data aspirasi ini?</h4>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-success">Iya <i class="fas fa-file-excel"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal Hapus Data -->
<div class="modal fade" id="modalDelete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Kosongkan Seluruh Data Aspirasi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/Aspirasi/empty'); ?>" method="POST">
				<div class="modal-body">
					<div class="text-center">
						<img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/empty.svg" width=80% alt="delete-img">
						<h4 class="mb-4">Apakah anda yakin untuk mengkosongkan data aspirasi ini?</h4>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
					<button type="submit" class="btn btn-danger">Iya <i class="fas fa-exclamation-triangle"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>
