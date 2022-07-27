<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Edit Post</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
						<li class="breadcrumb-item active">Edit Post</li>
					</ol>
				</div>
			</div>
			<div class="px-2">
				<?= flashdata('message');
				unset($_SESSION['message']); ?>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-primary card-outline">
						<?= form_open_multipart('admin/post/edit'); ?>
						<div class="card-body">
							<div class="form-group">
								<label for="judul2"><i class="fas fa-pencil-alt"></i> Judul</label>
								<!-- <textarea class="textarea" class="form-control" name="judul" placeholder="Isi Konten" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea> -->
								<input type="text" class="form-control" id="judul2" name="judul2" value="<?= $data['judul_post'] ?>" placeholder="Masukkan Judul Konten">
								<small class="form-text text-muted">Berisi keterangan berupa judul konten, contoh: " Workshop pada masa pandemi covid-19 "</small>
								<?= form_error('judul2'); ?>
							</div>
							<div class="form-group">
								<label for="deskripsi"><i class="fas fa-list"></i> Deskripsi</label>
								<textarea class="form-control" rows="4" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Post"><?= $data['deskripsi_post'] ?></textarea>
								<small class="form-text text-muted">Bisa diisi deskripsi singkat postingan boleh dikosongi</small>
								<?= form_error('deskripsi'); ?>
							</div>
							<div class="form-group">
								<label for="isi"><i class="fas fa-paragraph"></i> Isi Konten</label>
								<textarea class="textarea" name="konten" id="konten" placeholder="Isi Konten" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= htmlspecialchars_decode($data['konten_post']) ?></textarea>
								<small class="form-text text-muted">Bisa diisi konten postingan</small>
								<?= form_error('konten'); ?>
							</div>
							<div class="form-group">
								<label for="kategori"><i class="fas fa-list"></i> Kategori</label>
								<select class="form-control" name="kategori" id="kategori">
									<option value="">-- Pilih Kategori --</option>
									<?php foreach ($category as $row) : ?>
										<?php if ($data['id_kategori'] === $row['id_kategori']) : ?>
											<option value="<?= $row['id_kategori']; ?>" selected><?= $row['nama_kategori']; ?></option>
										<?php else : ?>
											<option value="<?= $row['id_kategori']; ?>"><?= $row['nama_kategori']; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								<small class="form-text text-muted">Pilih Kategori</small>
								<?= form_error('kategori'); ?>
							</div>
							<button type="reset" class="btn btn-secondary" id="btn-reset" value="reset"><i class="fas fa-eraser"></i> Reset</button>
						</div>
					</div>
					<div class="button p-3">
					</div>
				</div>

				<div class="col-md-4">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<?php
								$img = base_url('assets/dist/icon/image.svg');

								if ($data['foto_post'] !== null) {
									$img = base_url('uploads/images/' . $data['foto_post']);
								}

								?>
								<img src="<?= $img ?>" onClick="triggerClick()" id="profileDisplay" width="200px">
								<?php if (!empty($data['foto_post'])) : ?>
									<a href="<?= site_url('admin/post/delete_foto/' . $data['id_post']) ?>" class="my-2 btn btn-danger btn-sm del">Hapus Foto</a>
								<?php endif; ?>

								<?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
								<h3 class="profile-username text-center text-bold">
									</span>
									<div class="form-group">
										<label for="image">Unggah Thumbnail</label>
										<div class="input-group input-group-sm mb-3">
											<div class="custom-file">
												<input type="file" name="foto" onChange="displayImage(this)" id="inputGroupFile01" class="form-control" accept=".png, .jpg, .jpeg" />
											</div>
										</div>
									</div>
								</h3>
							</div>
							<div class="text text-center">
								<small class="text-danger text-center text-bold">(Ukuran file gambar max 2 mb.)</small>
							</div>
							<label for="kategori"><i class="fas fa-list"></i> Status</label>
							<select class="form-control" id="status" name="status">
								<option value="">-- Pilih Status --<i class="bi bi-eye"></i></option>
								<option value="1" <?= $data['post_status'] === '1' ? 'selected' : '' ?>>Published</option>
								<option value="0" <?= $data['post_status'] === '0' ? 'selected' : '' ?>>Draft</option>
							</select>
							<small class="form-text text-muted">Pilih Status</small>
							<?= form_error('status'); ?>
							<!-- <div class="button"> -->
							<input type="hidden" name="id_post" value="<?= $data['id_post'] ?>">
							<button type="submit" class="btn btn-success btn-block mt-3"><i class="fas fa-save"></i> Simpan</button>
							<a href="<?= base_url('post') ?>" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Kembali</a>
							<!-- </div> -->
						</div>
						<?= form_close() ?>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
		<!-- /.col -->
	</section>
</div>