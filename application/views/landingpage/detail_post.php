    <!--  ======================= Start Main Area ================================ -->
    <main class="site-main mt-5 mb-5">

    	<!--  ======================= Start Main Content ================================ -->
    	<section class="site-banner mt-8">
    		<div class="container py-lg-5 shadow borderDewandik px-4">
    			<div class="card border-0">
    				<div class="card-body">
    					<div class="row pt-3">
    						<div class="col-sm-8">
    							<div class="col-md-12 mb-5">
    								<div class="card border-light justify-content-center">
    									<div class="card-header bg-white">
    										<h5 class="card-title fw-bold"><?= $post->judul_post ?></h5>
    										<div class="ket d-flex m-3">
    											<p class="card-text m-1"><i class="text-primary fad fa-calendar"></i> <?= indonesian_date($post->tanggal_post) ?></p>
    											<?php if ($post->nama_kategori === 'Laporan Utama') {
													$link     = 'laporan-utama';
													$kategori = 'Laporan Utama';
												} elseif ($post->nama_kategori === 'Laporan Khusus') {
													$link     = 'laporan-khusus';
													$kategori = 'Laporan Khusus';
												} elseif ($post->nama_kategori === 'Opini / Wacana') {
													$link     = 'opini-wacana';
													$kategori = 'Opini / Wacana';
												} elseif ($post->nama_kategori === 'Informasi Publik') {
													$link     = 'informasi-publik';
													$kategori = 'Informasi Publik';
												} else {
													$link     = 'liputan';
													$kategori = 'Liputan';
												} ?>
    											<a class="text-dark m-1" style="text-decoration: none;" href="<?= base_url($link); ?>"><i class="fad fa-folder text-info"></i> <?= $post->nama_kategori; ?></a>
    											<a href="#komen" style="text-decoration: none;" class="text-dark m-1"><i class="fad fa-comments text-primary"></i> Komentar <?= $komen ?></a>
    										</div>
    									</div>
    									<?php if ($post->foto_post !== null) { ?>
    										<div class="text-center mt-2 mb-2">
    											<img class="img-fluid" src="<?= base_url('uploads/images/') . $post->foto_post ?>" style="width: 500px;" alt="gambar-post <?= $post->judul_post ?>" />
    											<br>
    											<small class="text-dark-50"><?= $post->deskripsi_post ?></small>
    										</div>
    									<?php } else { ?>
    										<div class="text-center mt-2 mb-2">
    											<img class="img-fluid" src="<?= base_url('uploads/images/dewandik.png') ?>" style="width: 500px;" alt="gambar-post <?= $post->judul_post ?>" />
    											<br>
    											<small class="text-dark-50"><?= $post->deskripsi_post ?></small>
    										</div>
    									<?php } ?>
    									<div class="card-body">
    										<div class="deskripsi">
    											<div><?= htmlspecialchars_decode($post->konten_post) ?></div>
    										</div>
    									</div>
    								</div>
    							</div>

    							<hr />
    							<div class="bagikan mb-4">
    								<p class="font-weight-bold">Bagikan postingan</p>
    								<!-- ShareThis BEGIN -->
    								<div class="sharethis-inline-share-buttons"></div>
    								<!-- ShareThis END -->
    							</div>

    							<div class="komentar" id="komen">
    								<h4 class="h6 font-weight-bold mb-4">Komentar</h4>

    								<?= $komentar ?>

    								<p class="notice error text-center">
    									<?= flashdata('error_msg');
										unset($_SESSION['error_msg']);
										?></p><br />
    								<div id="info_balas"></div>

    								<?= form_open('kirim_komentar', ['id' => 'form_komentar', 'name' => 'Komentar', 'onsubmit' => "return validate()"], ['parent_id' => '', 'id_post' => $post->id_post, 'url' => current_url()]) ?>

    								<div class="mb-3">
    									<label class="form-label" for="comment">Komentar</label>
    									<textarea placeholder="isi komentar Anda" rows="5" class="form-control" name="comment_body" id="comment"></textarea>
    									<div id="errorisi" style="color: red;"></div>
    								</div>

    								<div class="row">
    									<div class="mb-3 col-sm-6">
    										<label class="form-label" for="name">Nama</label>
    										<input class="form-control" placeholder="nama Anda" type="text" name="comment_name" id="name" value="<?= set_value('comment_name', ($this->session->has_userdata('cnama') ? $this->session->cnama : '')) ?>" />
    										<div id="errornama" style="color: red;"></div>
    									</div>

    									<div class="mb-3 col-sm-6">
    										<label class="form-label" for="email">Email</label>
    										<input class="form-control" placeholder="email Anda" name="comment_email" id="email" value="<?= set_value('comment_email', ($this->session->has_userdata('cemail') ? $this->session->cemail : '')) ?>" />
    										<div id="erroremail" style="color: red;"></div>
    									</div>
    								</div>

    								<div id="submit_button" class="mt-3">
    									<button class="btn btn-outline-success rounded-pill" type="submit">Tambah Komentar</button>
    								</div>
    								<?= form_close() ?>
    							</div>

    						</div>
    						<div class="col-sm-4">
    							<div class="sticky-top Sidebar">
    								<div class="card mb-4 border-light shadow-sm">
    									<div class="card-header"><i class="fad fa-fire-alt text-danger"></i> Artikel Terbaru</div>
    									<div class="card-body">
    										<?php foreach ($list as $ls) { ?>
    											<div class="border-bottom mb-3 pb-2">
    												<div class="tp d-flex">
                                                        <h6>
    														<?= anchor('post/detail/' . $ls->permalink, word_limiter($ls->judul_post, 15), ['class' => 'text-decoration-none fw-bold'], ['title' => $ls->judul_post]) ?>
                                                        </h6>
    												</div>
    												<div class="bt">
    													<?= word_limiter(strip_tags(htmlspecialchars_decode($ls->konten_post)), 15) ?>
    												</div>
    											</div>
    										<?php } ?>
    									</div>
    								</div>
    								<div class="card mb-4 border-light shadow-sm">
    									<div class="card-header"><i class="fad fa-fire-alt text-danger"></i> Events</div>
    									<div class="card-body">
    										<?php if ($list1 == null) : ?>
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
    											<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    												<div class="carousel-inner">
    													<div class="carousel-inner">
    														<?php
															$i = 0;
															foreach ($list1 as $ls) { ?>
    															<div class="carousel-item <?= $i == 0 ? "active" : "" ?>" data-bs-interval="5000">
    																<a href=" <?= $ls->link_banner ?>" target="_blank"><img src="<?= base_url('uploads/images/' . $ls->foto_banner) ?>" style="width: 100px;" class="d-block w-100" alt="..."></a>
    															</div>
    														<?php $i++;
															} ?>
    													</div>
    												</div>
    												<!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    												<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    												<span class="visually-hidden">Previous</span>
    											</button>
    											<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    												<span class="carousel-control-next-icon" aria-hidden="true"></span>
    												<span class="visually-hidden">Next</span>
    											</button> -->
    											</div>
    										<?php endif; ?>
    										<div class="mb-3 pb-2">
    											<div class="tp text-center">
    											</div>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!--  ======================== End Main Content ==============================  -->
    </main>
    <script>
    	function validate() {
    		var mail_format = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    		var nama = document.Komentar.comment_name.value;
    		var email = document.Komentar.comment_email.value;
    		var isi = document.Komentar.comment_body.value;
    		var status = false;

    		if (nama == "") {
    			document.getElementById("errornama").innerHTML =
    				"<b>Silahkan isi nama anda</b>";
    			status = false;
    		} else {
    			document.getElementById("errornama").innerHTML = " ";
    			status = true;
    		}

    		if (email.match(mail_format)) {
    			document.getElementById("erroremail").innerHTML = " ";
    		} else {
    			document.getElementById("erroremail").innerHTML =
    				"<b>Format Email salah</b>";
    			status = false;
    		}

    		if (isi == "") {
    			document.getElementById("errorisi").innerHTML =
    				"<b>Silahkan isi komentar</b>";
    			status = false;
    		} else {
    			document.getElementById("errorisi").innerHTML = " ";
    		}

    		return status;
    	}
    </script>
    <!--  ======================= End Main Area ================================ -->
    <!-- </div> -->
