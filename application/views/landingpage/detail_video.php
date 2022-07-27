<?php foreach ($video as $vid) { ?>
    <main class="site-main mt-5 mb-5">
        <!--  ======================= Awalan Banner=======================  -->
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
                <div class="card mb-3">

                    <div class="ratio ratio-16x9 rounded">
                        <iframe src="https://www.youtube.com/embed/<?= IDYouTube($vid->link) ?>?rel=0" title="YouTube video" allowfullscreen></iframe>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title px-4 text-justify about"><?= $vid->judul_vid ?></h5>
                        <small class="d-block px-4 text-secondary"><?= $vid->tanggal_vid ?></small>
                        <hr>
                        <p class="px-4 text-justify">
                            <?= $vid->deskripsi_vid ?>
                        </p>

                        <div class="text-center m-3">
                            <a href="<?= site_url('video') ?>" class="btn btn-block btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
                <!-- <form>
                    <div class="form-group">
                        <label for="komentar">Tinggalkan Komentar</label>
                        <textarea class="form-control shadow" id="komentar" rows="3"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="komentar">Nama</label>
                            <input type="text" class="form-control shadow" placeholder="Masukan Nama">
                        </div>
                        <div class="col">
                            <label for="komentar">Email</label>
                            <input type="email" class="form-control shadow" placeholder="Masukan Email">
                        </div>
                        <div class="col">
                            <label for="komentar">Website</label>
                            <input type="text" class="form-control shadow" placeholder="Masukan Website">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-3">Post</button>
                </form> -->
            </div>
        </section>
    </main>
<?php } ?>
