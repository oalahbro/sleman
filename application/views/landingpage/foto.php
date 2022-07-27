    <!--  ======================= Start Main Area ================================ -->
    <main class="site-main mt-5 mb-5">

    	<!--  ======================= Start Main Content ================================ -->
    	<section class="site-banner mt-8">
    		<div class="container">
    			<div class="row text-center">
    				<div class="col-12">
    					<div class="about-title m-5">
    						<div class="p-4 shadow d-inline-block borderDewandik2">
    							<h3 class="fw-bold mb-0 d-inline-block"><?= $title ?></h3>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="container py-lg-5 shadow borderDewandik px-4">
    			<div class="row justify-content-center">
    				<div class="col-12">
    					<form method="GET" action="<?= base_url('index/search_foto'); ?>">
    						<div class="input-group mx-auto mb-4 w-50 flex-nowrap">
    							<input type="text" class="form-control" placeholder="Cari Foto . . . " name="cari" aria-label="Username" aria-describedby="addon-wrapping">
    							<div class="input-group-append">
    								<button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
    							</div>
    						</div>
    					</form>
    				</div>
    			</div>
    			<div class="row pt-3">
    				<?php if ($foto == null) : ?>
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
    					<?php foreach ($foto as $k) : ?>
    						<div class="col-lg-3 ml-1 mr-1 mt-2 mb-3 col-md-6 col-sm-12">
    							<div class="card h-100 border-light shadow">
    								<?php if ($k->foto == '' || $k->foto == null) { ?>
    									<td width="150px"><img src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada Foto" class="img-fluid"></td>
    								<?php } else { ?>
    									<img src="<?= base_url() ?>uploads/images/<?= $k->foto ?>" class="img-fluid rounded p-1" alt="...">
    								<?php } ?>
    								<div class="card-body">
    									<p class="card-text"><i class="text-primary fad fa-calendar"></i> <?= indonesian_date($k->tgl_fotogk) ?></p>
    									<h6 class="card-title"><b><?= $k->judul_foto ?></b>: <?= word_limiter(strip_tags($k->deskripsi_foto), 10) ?></h6>
    								</div>
    								<div class="card-footer text-center">
    									<a href="<?= base_url('index/detail_foto/' . $k->id_foto); ?>" class="btn btn-primary btn-md m-2 fw-bold text-center">Lihat Detail</a>
    								</div>
    							</div>
    						</div>
    					<?php endforeach; ?>
    				<?php endif; ?>
    			</div>
    			<div class="row">
    				<div class="col-md-12">
    					<?= $halaman; ?>
    				</div>
    			</div>
    		</div>
    	</section>

    	<!--  ======================== End Main Content ==============================  -->


    </main>
    <!--  ======================= End Main Area ================================ -->
    <!-- </div> -->