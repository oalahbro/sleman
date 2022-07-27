<section id="permen" class="bg-main-blue my-5 py-5">
	<div class="container">

		<div id="carouselPermen2" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner text-center">
				<?php
				$i = 0;
				if ($saran->num_rows() == 0) { ?>
					<div class="carousel-item text-white active">
						<div class="sld2">
							<img src="<?= base_url('/assets/dist/img/kosong.png') ?>" width="150px" class="img-fluid mb-3" alt="gambar tidak ada data" />
							<p class="lead">Belum Terdapat aspirasi Untuk di Tampilkan</p>
						</div>
					</div>
				<?php } else { ?>
					<?php
					foreach ($saran->result() as $feedback) {
						$grav_url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($feedback->email))) . '?d=mp&s=100'; ?>
						<div class="carousel-item text-white <?= $i === 0 ? 'active' : '' ?>">
							<div class="sld2 justify-content-center">
								<img src="<?= $grav_url ?>" class="rounded-circle" alt="<?= 'Aspirasi publik ' . $feedback->nama ?>" />
								<p class="lead"><?= $feedback->nama ?></p>
								<p class="lead"><?php
												$string = strip_tags($feedback->isi);
												if (strlen($string) > 300) {

													// truncate string
													$stringCut = substr($string, 0, 300);
													$endPoint  = strrpos($stringCut, ' ');

													//if the string doesn't contain any space then it will cut without word basis.
													$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
													$string .= '...';
												}
												echo $string; ?></p>
							</div>
						</div>
					<?php $i++;
					} ?>
				<?php } ?>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselPermen2" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselPermen2" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>

	</div>
</section>

<div class="text-center my-5">
	<a href="<?= base_url('daftar-aspirasi') ?>" class="btn btn-outline-primary btn-lg rounded-pill px-5">Lihat Selengkapnya <i class="fal fa-arrow-right"></i></a>
</div>