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
                if ($data['anggaran'] == null) : ?>
                    <div class="col-md-12 text-center">
                        <img src="<?= base_url('assets/dist/icon/noList.svg'); ?>" alt="" class="img-rounded img-responsive img-fluid" width="100">
                        <div class="mt-2 error-template">
                            <h4>Mohon Maaf</h4>
                            <h5><i class="fas fa-info-circle text-primary"></i> Anggaran Dasar Masih Belum Update Informasi-nya.</h5>
                            <div class="error-details">
                                Sampai saat ini Anggaran Dasar dan Anggaran Rumah Tangga (AD/ART) Dewan Pendidikan Kabupaten Sleman sedang dalam tahap finalisasi. Dokumen mengenai AD/ART akan disampaikan di sini, jika sudah tersedia. Terima kasih
                            </div>
                            <div class="error-actions mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 text-center">
                                        <a href="<?= base_url(); ?>" class="btn btn-outline-primary"><i class="fas fa-home"></i> kembali ke Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="container mt-5 mb-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 mb-5">
                                        <div class="card border-light justify-content-center">
                                            <div class="text-center mb-2">
                                                <?php
                                                $img = base_url('assets/dist/img/logo/dewandik.png');
                                                ?>
                                                <img class="card-img" src="<?= $img ?>" style="width: 200px;" alt="gambar-post">
                                            </div>
                                            <div class="card-header text-center">
                                                <h4 class="card-title">Anggaran Dasar dan Anggaran Dasar Rumah Tangga</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="deskripsi">
                                                    <p><?= htmlspecialchars_decode($data['anggaran']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!--  ======================== End Main Content ==============================  -->


    </main>
    <!--  ======================= End Main Area ================================ -->
    <!-- </div> -->