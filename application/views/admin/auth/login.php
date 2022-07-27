<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img src="<?= base_url('assets/dist/img/logo/' . $data['gambar_logo']) ?>" width="50%" alt="foto-dewandik" />
            <a href="<?= site_url() ?>" class="h1"><b>Dewandik</b></a>
        </div>
        <div class="card-body">
            <?= flashdata('pesan') ?>

            <p class="login-box-msg">Masuk Aplikasi</p>
            <?= form_open('login/cek') ?>
            <div class="input-group mb-3">
                <?= form_input([
                    'type'        => 'email',
                    'class'       => 'form-control',
                    'placeholder' => 'alamat@email',
                    'name'        => 'email',
                    'required'    => '',
                ]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <?= form_password([
                    'class'       => 'form-control',
                    'placeholder' => 'password',
                    'name'        => 'password',
                    'required'    => '',
                ]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="form-label-group">
                        <div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="<?= $_SERVER['CAPTCHA_SITEKEY'] ?? '' ?>"></div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-primary btn-block">Masuk <i class="fas fa-sign-in-alt"></i></button>
                </div>
                <!-- /.col -->
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->