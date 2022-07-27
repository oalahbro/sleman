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
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row pt-3">
                            <?php if ($dinas->result() === null) : ?>
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
                                <?php foreach ($dinas->result() as $dns) { ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row justify-content-center">
                                                <!-- <div class="col-sm-4 text-right">
                                                    </div> -->
                                                <div class="col-sm-8 mt-2 mb-2">
                                                    <div class="card border-0 shadow">
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <?php if ($dns->logo == '' || $dns->logo == null) { ?>
                                                                        <img src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada logo" class="img-fluid rounded" width="100px">
                                                                    <?php } else { ?>
                                                                        <img src="<?= base_url() ?>uploads/images/<?= $dns->logo ?>" class="img-fluid rounded" alt="..." width="100px">
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-sm-7">
                                                                    <h5 class="card-title"><?= $dns->nama_dinas ?></h5>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <a href="<?= $dns->link ?>" target="_blank" class="btn btn-primary"><i class="fas fa-arrow-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-5 col-sm-5 fw-bold text-uppercase"><?= $dns->nama_dinas ?></div>
                                                <div class="col-md-2 col-sm-2"><a href="<?= $dns->lindinas ?>" class="btn btn-primary" target="_blank"><i class="fas fa-arrow-right"></i></a></div> -->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  ======================== End Main Content ==============================  -->


    </main>
    <!--  ======================= End Main Area ================================ -->
    <!-- </div> -->