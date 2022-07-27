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
                <?php if ($saran->num_rows() > 0) { ?>
                    <div class="content row pt-2 pl-2 pr-2">
                        <table id="aspirasi" class="table table-striped">
                            <thead>
                                <?php if ($saran === null) : ?>
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
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Isi Aspirasi</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;

                                    foreach ($saran->result_array() as $r) { ?>
                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= indonesian_date($r['tanggal']) ?></td>
                                        <td><?= $r['nama'] ?></td>
                                        <td><?= $r['tipe'] ?></td>
                                        <td><?= $r['isi'] ?></td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php
                                    } ?>
                            </tbody>
                        <?php endif; ?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info text-center">Belum Ada Aspirasi dari publik untuk ditampilkan.</div>
                <?php } ?>
            </div>
            <div>
                <p class="font-weight-bold">Bagikan halaman</p>
                <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons"></div>
                <!-- ShareThis END -->
            </div>

            <hr style="width: 30%; height: 3px" class="text-primary mx-auto my-5" />

            <div class="row">
                <div class="col-lg-6 col-12-md text-center mb-2">
                    <img src="<?= base_url() ?>assets/dist/icon/sapiens_2.svg" class="img-fluid card-img" alt="gambar-aspirasi">
                </div>
                <div class="col-lg-6 col-12-md mt-2">
                    <div class="text-center col-lg-12 col-12-md">
                        <h3 class="fw-bold">Kirim Aspirasi</h3>
                    </div>

                    <?= flashdata('pesan') ?>

                    <?= form_open('daftar-aspirasi/submit', ['name' => 'asp', 'class' => 'needs-validation', 'novalidate' => '']) ?>

                    <div class="row mb-3">
                        <div class="form-group col-sm-12">
                            <?= form_label('Nama', 'nama') ?>
                            <?= form_input([
                                'name'        => 'nama',
                                'class'       => 'form-control',
                                'placeholder' => 'nama',
                                'id'          => 'nama',
                                'required'    => '',
                                'value'       => set_value('nama'),
                            ]) ?>
                            <div class="invalid-feedback <?= (form_error('nama') !== '' ? 'd-block' : '') ?>">
                                <?= (form_error('nama') !== '' ? form_error('nama') : 'Mohon isi nama Anda.') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-sm-12">
                            <?= form_label('Email', 'email') ?>
                            <?= form_input([
                                'name'        => 'email',
                                'class'       => 'form-control',
                                'placeholder' => 'email',
                                'id'          => 'email',
                                'type'        => 'email',
                                'required'    => '',
                                'value'       => set_value('email'),
                            ]) ?>
                            <div class="invalid-feedback <?= (form_error('email') !== '' ? 'd-block' : '') ?>">
                                <?= (form_error('email') !== '' ? form_error('email') : 'Mohon masukkan email yang valid.') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-sm-12">
                            <?= form_label('Jenis', 'tipe') ?>
                            <?= form_dropdown('tipe', ['kritik' => 'Kritik', 'saran' => 'Saran'], ['saran'], ['class' => 'form-select', 'id' => 'tipe', 'required' => '']) ?>
                            <div class="invalid-feedback <?= (form_error('tipe') !== '' ? 'd-block' : '') ?>">
                                <?= (form_error('tipe') !== '' ? form_error('tipe') : 'Silakan pilih jenis aspirasi.') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-sm-12">
                            <?= form_label('Isi Aspirasi', 'isi') ?>
                            <?= form_textarea(['class' => 'form-control', 'rows' => '5', 'name' => 'isi', 'id' => 'isi', 'placeholder' => 'isian Aspirasi', 'required' => '', 'value' => set_value('isi')]) ?>
                            <div class="invalid-feedback <?= (form_error('isi') !== '' ? 'd-block' : '') ?>">
                                <?= (form_error('isi') !== '' ? form_error('isi') : 'Mohon masukkan aspirasi Anda.') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-sm-12">
                            <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="<?= $_SERVER['CAPTCHA_SITEKEY'] ?? '' ?>"></div>
                            <?= form_error('g-recaptcha-response'); ?>

                            <div id="captc" class="invalid-feedback <?= (form_error('g-recaptcha-response') !== '' ? 'd-block' : '') ?>">
                                <?= (form_error('g-recaptcha-response') !== '' ? form_error('g-recaptcha-response') : 'Kode reCaptcha diperlukan.') ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-success btn-lg fw-bold" id="cek" type="submit"><i class="fad fa-paper-plane"></i> Kirim</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
    <!--  ======================== End Main Content ==============================  -->
</main>

<!--  ======================= End Main Area ================================ -->
<!-- </div> -->
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        var errCaptcha = document.getElementById('captc')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var response = grecaptcha.getResponse()
                    var l = response.length

                    // console.log(l)

                    if (l == 0) {
                        errCaptcha.classList.add('d-block')
                    } else {
                        errCaptcha.classList.remove('d-block')
                    }

                    if (!form.checkValidity() || l == 0) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>