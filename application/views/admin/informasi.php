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
		<?= flashdata('pesan');
        unset($_SESSION['pesan']); ?>
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="card-header">
			<div class="text-right">
				<a class="btn btn-primary" href="<?= base_url('admin/informasi/add'); ?>"><i class="fas fa-plus-circle"></i> Tambah Informasi</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Judul</th>
									<th>Deskripsi</th>
									<th>Foto</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;

                                foreach ($informasi as $detInformasi) : ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $detInformasi->judul_informasi ?></td>
										<td><?= $detInformasi->deskripsi_info ?></td>
										<td><img width="150" height="150" src="<?= base_url() ?>assets/dist/img/informasi/<?= $detInformasi->thumbnail_info ?>" alt="<?= $detInformasi->judul_informasi ?>" srcset="" class="img-fluid"></td>
										<td><?= $detInformasi->tanggal_info ?></td>
										<td>
											<?php
                                            if ($detInformasi->status_info === 1) {
                                                echo '<a data-toggle="tooltip" data-placement="top" title="Sembunyikan" class="btn mb-2 btn-danger btn-sm mr-2" href="' . base_url("admin/informasi/ubah_status/{$detInformasi->id_informasi}") . '"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>';
                                            } elseif ($detInformasi->status_info === 0) {
                                                echo '<a data-toggle="tooltip" data-placement="top" title="Tampilkan" class="btn mb-2 btn-success btn-sm mr-2" href="' . base_url("admin/informasi/ubah_status2/{$detInformasi->id_informasi}") . '"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                            }
                                            ?>
											<a class="btn mb-2 btn-primary btn-sm mr-2" href="<?= base_url() ?>admin/informasi/edit/<?= $detInformasi->id_informasi ?>"><i class="fa fa-edit"></i></a>
											<a onclick="return confirm('Apakah anda yakin ingin menghapus item ini?');" href="<?= base_url() ?>admin/informasi/hapus/<?= $detInformasi->id_informasi ?>" class="btn btn-danger mb-2 btn-sm"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php $i++;
                                endforeach; ?>
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
