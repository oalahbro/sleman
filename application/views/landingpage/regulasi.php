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
                <div class="m-4 rounded">
                    <div class="content row pt-2 pl-2 pr-2">
                        <table id="regulasi" class="table table-bordered table-striped">
                            <thead>
                                <?php if ($regulasi === null) : ?>
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
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Judul Regulasi</th>
                                        <th>Isi Regulasi</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($regulasi as $p) :
                                        $id    = $p['id_regulasi'];
                                        $judul = $p['judul'];
                                        $isi   = $p['isi'];
                                ?>
                                    <tr>
                                        <td class="text-center" width="100px"><?= $no; ?></td>
                                        <td><?= $judul ?></td>
                                        <td><?= htmlspecialchars_decode($isi); ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Judul Regulasi</th>
                                    <th>Isi Regulasi</th>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                        </table>
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
