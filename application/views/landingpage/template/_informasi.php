<h4 class="text-center text-uppercase mt-5">Informasi Terbaru</h4>

<section class="bg-main-blue mt-3 mb-5 py-5">
	<div class="container">
		<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<?php foreach (array_chunk($informasi, 4, true) as $i => $blg) { ?>

					<div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
						<div class="row g-3">
							<?php foreach ($blg as $b) { ?>
								<div class="col-6 col-md-3">
									<div class="card bg-main-blue border-0 text-white">
										<?php
										$img = base_url('assets/dist/img/logo/' . $data['gambar_logo']);
										if ($b->foto_post !== null) {
											$img = base_url('uploads/images/' . $b->foto_post);
										}
										?>
										<img src="<?= $img ?>" class="bg-white card-img borderDewandik" alt="<?= $b->judul_post ?>" />
										<div class="card-img-overlay borderBTM">
											<h5 class="card-title fw-normal text-truncate">
												<?= anchor('post/detail/' . $b->permalink, $b->judul_post, ['class' => 'text-light text-decoration-none', 'title' => $b->judul_post]) ?>
											</h5>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>