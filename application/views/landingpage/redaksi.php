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
                <?php if ($struktur_redaksi == null) : ?>
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
                    <?php foreach ($struktur_redaksi as $jab) :
                        $id       = $jab->id_struktur_redaksi;
                        $sredaksi = $this->db->query('SELECT * FROM redaksi, struktur_redaksi WHERE redaksi.id_struktur_redaksi = struktur_redaksi.id_struktur_redaksi AND redaksi.id_struktur_redaksi =' . $id)->result();
                    ?>
                        <div class="card border-0">
                            <div class="card-header">
                                <?= $jab->jenis_redaksi ?>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($sredaksi == null) : ?>
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
                                        <?php foreach ($sredaksi as $struk) : ?>
                                            <div class="col-md-6">
                                                <div class="card mb-3" style="max-width: 600px;">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4">
                                                            <?php if ($struk->gambar == '' || $struk->gambar == null) { ?>
                                                                <td width="150px"><img src="<?= base_url() ?>uploads/images/default.png" alt="Belum Ada Foto" class="img-fluid"></td>
                                                            <?php } else { ?>
                                                                <img src="<?= base_url() ?>uploads/images/<?= $struk->gambar ?>" class="img-fluid rounded p-1" alt="...">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?= $struk->nama_pengurus ?></h5>
                                                                <p class="card-text"><?= $struk->masa_jabatan ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
                <hr>
                <div class="bagikan">
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