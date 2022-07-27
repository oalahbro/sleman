
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
          <h2 class="font-weight-bolder mb-0">Edit Data</h2>
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

                <?php foreach ($slider as $detSlider) { ?>

                    <form action="<?= base_url() . 'admin/slider/update'; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_foto" value="<?= $detSlider->id_foto ?>">

                        <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Slider:</label>
                        <input type="text" pattern="[a-zA-Z0-9 ]{2,100}" title="Masukkan minimal 2, maksimum 100, hanya alphabet, spasi, dash dan underscore" required
                            class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan nama..." value="<?= $detSlider->foto?>">
                        <small id="nama" class="form-text text-muted">Masukkan nama slider yang sesuai</small>
                        <?= form_error('nama'); ?>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Slider:</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" maxlength="255" placeholder="Masukkan deskripsi..." required><?= $detSlider->deskripsi?></textarea>
                        <small id="deskripsi" class="form-text text-muted">Masukkan deskripsi maksimum 255 karakter</small>
                        <?= form_error('deskripsi'); ?>
                    </div>
                    <div class="form-group">
							<label for="foto">Foto Slider</label><br>
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
													<img id="prev_foto1" src="<?= base_url()?>assets/dist/img/slide/<?= $detSlider->file?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
											</div>
                                        </div>
                                    </div>
							<div class="custom-file mb-2 dropzone-wrapper">
								<input type="file" class="dropzone" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
								<label class="custom-file-label" for="foto"><?= $detSlider->file?></label>
							</div>
							<small id="foto" class="form-text text-muted">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
						</div>
                    <!-- <div class="form-group">
                        <label for="foto">Foto Slider</label><br>
                        <img id="prev_foto1" src="<?= base_url()?>assets/dist/img/slide/<?= $detSlider->file?>" class="img-responsive img-thumbnail" alt="Preview Image" width="300px">
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" name="foto" id="foto">
                            <label class="custom-file-label" for="foto"><?= $detSlider->file?></label>
                        </div>
                        <small id="foto" class="form-text text-muted">Pilihlah File foto slider berukuran 710 x 285. Max 3 MB. Format (JPG/PNG)</small>
                    </div> -->
                </div>
                        <div class="form-group text-center">
                            <a class="btn btn-primary px-3 mr-1" href="<?= base_url() ?>admin/slider">Kembali</a>
                            <button class="btn btn-primary px-3 mr-1" type="submit">Simpan</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>

<?php } ?>
