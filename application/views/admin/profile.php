<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
            <div class="px-2">
                <?= flashdata('pesan') ?>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile" id="img">
                            <div class="text-center">
                                <?php 
                                if ($user['foto_user'] === null) {
                                    $img = base_url('assets/dist/img/user/' . $user['foto_user']);
                                }
                                else {
                                    $img = base_url('uploads/images/' . $user['foto_user']);
                                }
                                
                                ?>
                                <img class="img-fluid img-thumbnail" src="<?= $img ?>" width="200px" alt="User profile picture" />
                            </div>

                            <h3 class="profile-username text-center text-bold"><?= $user['nama_user'] ?></h3>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b class="pb-2">Hak akses</b>
                                    <span class="badge badge-danger text-bold float-right pt-1">Admin</span>
                                </li>
                                <li class="list-group-item">
                                    <b class="pb-2">Terdaftar</b>
                                    <span class="badge bg-primary text-bold float-right pt-1"><?= ($user['tanggal'] === 0 ? '---' : indonesian_date(date('d F Y', $user['tanggal']))) ?></span>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body box-profil" id="imgedit" hidden>
                            <div class="form-group">
                                <div class="form-group text-center" style="position: relative;">
                                    <span class="img-div">
                                        <div class="text-center img-placeholder" onClick="triggerClick()">
                                            <h3 class="profile-username text-center text-bold">Edit Foto Profil</h3>
                                            <label class="sm-0 text-primary"><small>(Klik gambar di bawah untuk mengganti)</small></label>
                                        </div>
                                        <div>
                                            <img src="<?= $img ?>" onClick="triggerClick()" id="profileDisplay" width="200px" />
                                        </div>
                                    </span>
                                    <label class="text-bold text-gray">Foto Profil</label>
                                    <div>
                                        <small class="text-danger text-bold">(Ukuran file gambar max 2 mb.)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">

                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?= $tab === 'profile' ? 'active' : '' ?> tittle" id="update-profil-tab" data-toggle="pill" href="#update-profil" role="tab" aria-controls="update-profil" aria-selected="true">Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $tab === 'pass' ? 'active' : '' ?>" id="update-password-tab" data-toggle="pill" href="#update-password" role="tab" aria-controls="update-password" aria-selected="false">Ubah Password</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade <?= $tab === 'profile' ? 'show active' : '' ?>" id="update-profil" role="tabpanel" aria-labelledby="update-profil-tab">

                                    <?= form_open_multipart('profile/submit') ?>

                                    <label for="profileImage" class="d-none"></label>

                                    <input type="file" name="image" value="<?= $user['foto_user'] ?>" onChange="displayImage(this)" id="profileImage" class="form-control d-none" accept="image/x-png,image/gif,image/jpeg" />
                                    <?= form_error('image', '<small class="text-danger pl-3">', '</small>') ?>

                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="nm" name="nama" placeholder="Nama Lengkap" value="<?= $user['nama_user']; ?>" required disabled>
                                        </div>
                                        <div class="offset-sm-2">
                                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" id="em" name="email" placeholder="Email" value="<?= $user['email']; ?>" required disabled>
                                        </div>
                                        <div class="offset-sm-2">
                                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="desc" name="deskripsi" placeholder="Deskripsi" value="<?= $user['deskripsi']; ?>" required disabled>
                                        </div>
                                        <div class="offset-sm-2">
                                            <?= form_error('deskripsi', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-3 col-form-label">Terakhir update</label>
                                        <div class="mb-1 col-sm-9">
                                            <?php if ($user['ubah'] === 0) : ?>
                                                <span class="badge bg-secondary text-bold">--</span>
                                            <?php else : ?>
                                                <span class="badge badge-dark text-bold"><?= indonesian_date(date('d F Y', $user['ubah'])) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="offset-sm-2">
                                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="button" class="btn btn-default" id="btn-cancel" hidden><i class="fas fa-arrow-alt-circle-left"></i> Batal</button>
                                            <button type="submit" class="btn btn-primary" id="btn-save" hidden><i class="fas fa-save"></i> Simpan</button>
                                            <button type="button" class="btn btn-primary" id="btn-edit"><i class="fas fa-edit"></i> Edit</button>
                                        </div>
                                    </div>

                                    <?= form_close() ?>

                                </div>

                                <div class="tab-pane fade <?= $tab === 'pass' ? 'show active' : '' ?>" id="update-password" role="tabpanel" aria-labelledby="update-password-tab">

                                    <?= form_open('profile/update_password?tab=pass', ['class' => 'form-horizontal']) ?>


                                    <div class="form-group row">
                                        <?= form_label('Password Sekarang', 'pass_lama', ['class' => 'col-sm-3 col-form-label']) ?>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <?= form_password('pass_lama', '', ['id' => 'pass_lama', 'class' => 'form-control', 'placeholder' => 'password sekarang', 'required' => '']) ?>
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text" id="show-hide" tabindex="-1">
                                                    <i class="fas fa-eye" id="icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="offset-sm-3">
                                            <?= form_error('pass_lama', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <?= form_label('Password Baru', 'pass_baru', ['class' => 'col-sm-3 col-form-label']) ?>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <?= form_password('pass_baru', '', ['id' => 'pass_baru', 'class' => 'form-control', 'placeholder' => 'password baru', 'required' => '']) ?>
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text" id="show-hide2" tabindex="-1">
                                                    <i class="fas fa-eye" id="icon2"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="offset-sm-3">
                                            <?= form_error('pass_baru', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <?= form_label('Ulangi Password Baru', 'ulangi_pass_baru', ['class' => 'col-sm-3 col-form-label']) ?>
                                        <div class="input-group mb-1 col-sm-9">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <?= form_password('ulangi_pass_baru', '', ['id' => 'ulangi_pass_baru', 'class' => 'form-control', 'placeholder' => 'ulangi password baru', 'required' => '']) ?>
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text" id="show-hide3" tabindex="-1">
                                                    <i class="fas fa-eye" id="icon3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="offset-sm-3">
                                            <?= form_error('ulangi_pass_baru', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-3 col-form-label">Terakhir update</label>
                                        <div class="mb-1 col-sm-9">
                                            <?php if ($user['ubah_password'] === 0) : ?>
                                                <span class="badge bg-secondary text-bold">--</span>
                                            <?php else : ?>
                                                <span class="badge bg-dark text-bold"><?= indonesian_date(date('d F Y', $user['ubah_password'])) ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="offset-sm-2">
                                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
