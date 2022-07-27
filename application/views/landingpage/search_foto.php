<main class="site-main mt-5 mb-5">
    <?php //var_dump($result); die;
    ?>

    <!-- ======= Breadcrumbs ======= -->
    <!-- End Breadcrumbs -->
    <!-- ======= Blog Section ======= -->
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
                    <form action="<?= base_url() ?>index/search_foto" method="get">
                        <div class="input-group mx-auto mb-4 w-50 flex-nowrap">
                            <input type="text" class="form-control" value="<?= $cari ?>" placeholder="Cari Video . . . " name="cari" aria-label="Username" aria-describedby="addon-wrapping">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <h5 class="pb-4 mb-4 border-bottom">
                    <?php if ($hasil !== 'Tidak ditemukan') {
                        echo '<i class="fas fa-search text-success"></i> Data ditemukan' . ' ' . $data->num_rows();
                    } else {
                        echo '<i class="fas fa-search text-danger"></i> Data tidak ditemukan';
                    } ?>
                </h5>
                <!--  ======================= Awalan Blog post ============================== -->
                <?php if ($hasil === 'Tidak ditemukan') : ?>
                    <!-- Jika Belum Terdapat data -->
                    <div class="col-md justify-content-center">
                        <div class="card-body text-center mt-4">
                            <img src="<?= base_url('assets/dist/icon/noList.svg'); ?>" alt="noData" class="img-rounded img-responsive img-fluid" width="100">
                        </div>
                        <div class="card-body pt-0 mt-4 text-center">
                            <h3 class="text-center text-bold text-muted">Data tidak ditemukan</h3>
                            <a href="<?= base_url('foto'); ?>" class="btn btn-primary text-center">&larr; Kembali</a>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($data->result() as $rowResult) : ?>
                        <div class="col-lg-3 ml-1 mr-1 mt-2 mb-3 col-md-6 col-sm-12">
                            <div class="card h-100 border-light shadow">
                                <img class="rounded" src="<?= base_url('uploads/images/' . $rowResult->foto) ?>" alt="gambar-kelas">
                                <div class="card-body">
                                    <p class="card-text"><i class="text-primary fad fa-calendar"></i> <?= indonesian_date($rowResult->tgl_fotogk) ?></p>
                                    <h6 class="card-title"><b><?= $rowResult->judul_foto ?></b>: <?= word_limiter(strip_tags($rowResult->deskripsi_foto), 10) ?></h6>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="<?= base_url('index/detail_foto/' . $rowResult->id_foto); ?>" class="btn btn-primary btn-md m-2 fw-bold text-center">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->