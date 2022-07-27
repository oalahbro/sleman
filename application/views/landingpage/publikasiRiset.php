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
    					<form method="GET" action="<?= base_url('index/search'); ?>">
    						<div class="input-group mx-auto mb-4 w-50 flex-nowrap">
    							<input type="text" class="form-control" placeholder="Cari Publikasi . . . " name="cari" aria-label="Username" aria-describedby="addon-wrapping">
    							<div class="input-group-append">
    								<button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
    							</div>
    						</div>
    					</form>
    				</div>
    			</div>
    			<?php if ($publikasi == null) : ?>
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

    				<hr>
    				<?php foreach ($publikasi as $pub) : ?>
    					<div class="card border-0 w-100 mb-3">
    						<div class="card-body">
    							<h5 class="card-text text-primary"><?= $pub->judul_riset ?></h5>
    							<h6 class="card-title"><?= $pub->nama_pembuat ?></h6>
    							<p class="text-muted"><i class="fad fa-calendar text-primary"></i> <?= indonesian_date($pub->tgl); ?></p>

    							<div class="">
    								<a class="btn btn-primary" href="<?= base_url("download/get/{$pub->id_publikasi}"); ?>" style="text-decoration: none;"><i class="fas <?= FontAwesomeIcon(get_mime_by_extension($pub->file)) ?>"></i> Unduh </a>
    							</div>
    							<hr>
    						</div>
    					</div>
    				<?php endforeach; ?>
    			<?php endif; ?>
    			<div class="row">
    				<div class="col-md-12">
    					<?= $halaman ?>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!--  ======================== End Main Content ==============================  -->

    </main>
    <!--  ======================= End Main Area ================================ -->