<!--  ======================= Start Main Area ================================ -->
<main class="site-main mt-5 mb-5">

    <!--  ======================= Start Main Content ================================ -->
    <section class="site-banner mt-8">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <div class="about-title m-5">
                        <div class="p-4 shadow d-inline-block borderDewandik2">
                            <h3 class="fw-bold mb-0 d-inline-block"><?= $judul ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-lg-5 shadow borderDewandik px-4">
            <div class="m-4 rounded">
                <div class="content row pt-2 pl-2 pr-2">
                    <?php foreach ($dtfoto as $dtf) : ?>
                        <div class="col-md-12 mb-5">
                            <div class="card border-light justify-content-center">
                                <div class="text-center mb-2">
                                    <?php if ($dtf->foto == '' || $dtf->foto == null) { ?>
                                        <td width="150px"><img src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada Foto" class="img-fluid"></td>
                                    <?php } else { ?>
                                        <img src="<?= base_url() ?>uploads/images/<?= $dtf->foto ?>" class="img-fluid rounded p-1" alt="...">
                                    <?php } ?>
                                </div>
                                <div class="card-body">
                                    <div class="card-title p-5">
                                        <h5 class=""><b><?= $dtf->judul_foto ?>: </b><?= $dtf->deskripsi_foto ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center m-3">
                    <a href="<?= base_url(); ?>foto" class="btn btn-block btn-primary">Kembali</a>
                </div>
            </div>
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