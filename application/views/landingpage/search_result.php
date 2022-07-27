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
                    <form action="<?= base_url() ?>index/search" method="get">
                        <div class="input-group mx-auto mb-4 w-50 flex-nowrap">
                            <input type="text" class="form-control" value="<?= $cari ?>" placeholder="Cari Publikasi . . . " name="cari" aria-label="Username" aria-describedby="addon-wrapping">
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
                            <a href="<?= base_url('publikasi-riset'); ?>" class="btn btn-primary text-center">&larr; Kembali</a>
                        </div>
                    </div>
                <?php else : ?>
                                <?php foreach ($data->result() as $pub) : ?>
                                    <div class="card border-0 w-100 mb-3">
                                        <div class="card-body">
                                            <h5 class="card-text text-primary"><?= $pub->judul_riset ?></h5>
                                            <h6 class="card-title"><?= $pub->nama_pembuat ?></h6>
                                            <p class="text-muted"><i class="fad fa-calendar text-primary"></i> <?= indonesian_date($pub->tgl); ?></p>
                                            <hr>
                                            <div class="">
                                                <a class="btn btn-primary" href="<?= base_url("download/get/{$pub->id_publikasi}"); ?>" style="text-decoration: none;"><i class="fas <?= FontAwesomeIcon(get_mime_by_extension($pub->file)) ?>"></i> Pdf</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

            </div>
        <?php endif; ?>
        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->