<main>
	<section class="site-banner my-5" id="top-banner">
		<div class="container">
			<img src="<?= base_url('assets/dist/img/banner/' . $data['gambar_beranda']) ?>" alt="banner-img" class="borderDewandik w-100 img-fluid">
		</div>
	</section>

	<section class="navbar_area">
		<div class="container nav-menu bg-white text-center">
			<ul class="list-inline">
				<li class="list-inline-item mx-5 _nav">
					<a class="text-decoration-none" href="<?= base_url('regulasi') ?>">Regulasi</a>
				</li>
				<li class="list-inline-item mx-5 _nav">
					<a class="text-decoration-none" href="<?= base_url('daftar-aspirasi') ?>">Aspirasi Publik</a>
				</li>
				<li class="list-inline-item mx-5 _nav">
					<a class="text-decoration-none" href="<?= base_url('data-sekolah') ?>">Data Sekolah Formal/Non Formal</a>
				</li>
			</ul>
		</div>
	</section>

	<?= $this->load->view('landingpage/template/_slide1', [], true) ?>

	<?= $this->load->view('landingpage/template/_slide2', [], true) ?>

	<?= $this->load->view('landingpage/template/_informasi', [], true) ?>

</main>