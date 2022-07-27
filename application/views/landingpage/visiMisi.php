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
                <?php
                if ($data['visi_misi'] == null) : ?>
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
                    <div class="m-4 rounded">
                        <div class="content row pt-2 pl-2 pr-2">
                            <div class="col-md-12 mb-5">
                                <div class="card border-light justify-content-center">
                                    <div class="text-center mb-2">
                                        <?php
                                        $img = base_url('assets/dist/img/logo/dewandik.png');
                                        ?>
                                        <img class="card-img" src="<?= $img; ?>" style="width: 250px;" alt="gambar-post">
                                    </div>
                                    <div class="card-header text-center">
                                        <h4 class="card-title">Visi dan Misi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="deskripsi">
                                            <p><?= htmlspecialchars_decode($data['visi_misi']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12 p-5 bg-warning">
                                <p class="text-dark text-center">@Preneur_Academy</p>
                            </div> -->
                        </div>
                    </div>
                <?php endif; ?>
                <div>
                    <p class="font-weight-bold">Bagikan postingan</p>
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </div>
            </div>
        </section>

        <!--  ======================== End Main Content ==============================  -->


    </main>
    <!--  ======================= End Main Area ================================ -->
    <!-- </div> -->