<?= $this->load->view('landingpage/template/header2', [], true) ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-12 text-center">
				<img src="<?= base_url('assets/dist/icon/not_found.svg') ?>" alt="" class="img-rounded img-responsive img-fluid" width="400" />
				<div class="error-template">
					<h1>404</h1>
					<h2><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman belum tersedia atau tidak ditemukan.</h2>
					<div class="error-details">
						Halaman yang anda tuju tidak tersedia. Silahkan klik tombol dibawah untuk kembali
					</div>
					<div class="error-actions mt-5">
						<div class="row justify-content-center">
							<div class="col-md-6 text-center">
								<?php if (user_logged_in()) { ?>
									<a href="<?= site_url('home') ?>" class="btn btn-outline-primary rounded-pill"><i class="fas fa-tachometer-alt"></i> kembali ke Beranda</a>
								<?php } else { ?>
									<a href="<?= site_url() ?>" class="btn btn-outline-primary rounded-pill"><i class="fas fa-arrow-left"></i> kembali ke Beranda</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->load->view('landingpage/template/footer2', [], true) ?>
