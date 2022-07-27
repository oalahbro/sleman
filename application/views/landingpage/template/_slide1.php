<section id="permen" class="bg-main-blue my-5 py-5">
	<div class="container">

		<div id="carouselPermen" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner text-center">
				<?php
				$i = 0;
				if ($slide == null) { ?>
					<div class="carousel-item text-white active">
						<div class="sld">
							<img src="<?= base_url('/assets/dist/img/kosong.png') ?>" width="150px" class="img-fluid mb-3" alt="gambar tidak ada data" />
							<p class="lead">Belum Terdapat Regulasi Untuk di Tampilkan</p>
						</div>
					</div>
				<?php } else { ?>
					<?php
					foreach ($slide as $s) {
						$judul     = $s->judul;
						$deskripsi = $s->isi; ?>
						<div class="carousel-item text-white <?= $i === 0 ? 'active' : '' ?>">
							<div class="sld">
								<img src="<?= base_url('/assets/dist/img/slider/garuda.png') ?>" width="150px" class="img-fluid mb-3" alt="gambar garuda pancasila" />
								<p class="lead"><?= $judul ?></p>
							</div>
						</div>
					<?php $i++;
					} ?>
				<?php } ?>
				<!-- <div class="carousel-item text-white">
					<div class="sld">
						<img src="<?= base_url('/assets/dist/img/slider/garuda.png') ?>" width="150px" class="img-fluid mb-3" alt="gambar garuda pancasila" />
						<p class="lead">Keputusan Bersama Menteri Pendidikan dan Kebudayaan, Menteri Agama, Menteri Kesehatan, dan Menteri dalam Negeri Republik Indonesia Nomor: 04/KB/2020; 737 Tahun 2020.</p>
					</div>
				</div>
				<div class="carousel-item text-white">
					<div class="sld">
						<img src="<?= base_url('/assets/dist/img/slider/garuda.png') ?>" width="150px" class="img-fluid mb-3" alt="gambar garuda pancasila" />
						<p class="lead">Pendidikan sebagaimana telah diubah dengan Peraturan Pemerintah Republik Indonesia
							Nomor 66 tahun 2010 tentang Perubahan atas Peraturan Pemerintah Nomor 17 tahun 2010 Tentang Pengelolaan dan Penyelenggaraan Pendidikan.</p>
					</div>
				</div> -->
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselPermen" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselPermen" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>

	</div>
</section>

<div class="text-center my-5">
	<a href="<?= base_url('regulasi') ?>" class="btn btn-outline-primary btn-lg rounded-pill px-5">Lihat Selengkapnya <i class="fal fa-arrow-right"></i></a>
</div>