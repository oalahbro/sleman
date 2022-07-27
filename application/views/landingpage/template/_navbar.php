<div class="container-xxl my-5" id="navtop">
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow navbar_dewandik borderDewandik px-4">
		<a class="navbar-brand d-flex align-items-center" href="<?= site_url() ?>">
			<img src="<?= base_url('assets/dist/img/logo/' . $data['gambar_logo']) ?>" width="100" alt="logo" />
			<h1 class="mb-0 ms-3 d-none d-sm-block">Dewan Pendidikan<br />Kabupaten Sleman</h1>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dewandikMenu" aria-controls="dewandikMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="dewandikMenu">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<?= anchor('', 'Beranda', ['class' => 'nav-link']) ?>
					<!-- <a class="nav-link active" aria-current="page" href="#">Beranda</a> -->
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Berita
					</a>
					<ul class="dropdown-menu text-center borderDewandik py-5" aria-labelledby="navbarDropdown">
						<li><?= anchor('laporan-utama', 'Laporan Utama', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('opini-wacana', 'Opini Wacana', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('laporan-khusus', 'Laporan Khusus', ['class' => 'dropdown-item']) ?></li>
					</ul>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Profil
					</a>
					<ul class="dropdown-menu text-center borderDewandik py-5" aria-labelledby="navbarDropdown">
						<li><?= anchor('visi-misi', 'Visi Misi', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('struktur', 'Struktur', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('sejarah', 'Sejarah', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('ad-art', 'AD/ART', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('sambutan', 'Sambutan', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('tim-redaksi', 'Tim Redaksi', ['class' => 'dropdown-item']) ?></li>

					</ul>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Giat Kerja
					</a>
					<ul class="dropdown-menu text-center borderDewandik py-5" aria-labelledby="navbarDropdown">
						<li><?= anchor('foto', 'Foto', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('video', 'Video', ['class' => 'dropdown-item']) ?></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><?= anchor('liputan', 'Liputan', ['class' => 'dropdown-item']) ?></li>
					</ul>
				</li>

				<li class="nav-item">
					<?= anchor('publikasi-riset', 'Publikasi Riset', ['class' => 'nav-link']) ?>
				</li>
				<li class="nav-item">
					<?= anchor('informasi-publik', 'Informasi Publik', ['class' => 'nav-link']) ?>
				</li>
				<li class="nav-item">
					<?= anchor('dinas-terkait', 'Dinas Terkait', ['class' => 'nav-link']) ?>
				</li>
			</ul>
		</div>
	</nav>
</div>