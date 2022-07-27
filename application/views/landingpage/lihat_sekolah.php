<main class="site-main mt-5 mb-5">

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
                    <table id="lihat_sekolah" class="table table-bordered table-striped">
                        <?php if ($sekolah === null) : ?>
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
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($sekolah as $reg) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $reg->nama_sekolah ?></td>
                                        <td><?= $reg->alamat_sekolah ?></td>
                                        <td><?= $reg->no_telepon ?></td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
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
        <div class="text-center p-3">
            <a class="btn btn-primary px-3 mr-1 " href="<?= base_url() ?>data-sekolah">Kembali</a>
        </div>
    </section>
</main>