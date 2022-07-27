<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Beranda</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="px-2">
            <?= flashdata('pesan') ?>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="alert alert-primary shadow alert-sm" role="alert">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-4 text-center">
                                <img src="<?= base_url('assets/dist/icon/firmware.svg') ?>" width="150" alt="halo" />
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-8 p-4">
                                <h6 class="alert-heading">Selamat Datang di
                                    <b>Sistem Informasi Manajemen Konten, atau <i>Content Manangement System (CMS)</i> untuk mengatur kelola informasi website Dewan Pendidikan Kabupaten Sleman!</b>
                                </h6>
                                <p>Halo, anda login sebagai <?php if ($this->session->userdata('role') === '1') {
                echo 'Administrator';
            } ?>. Untuk melihat mekanisme penggunaan aplikasi bisa ke <a style="text-decoration:none;" class="btn-sm btn-success" href="<?= base_url('admin/panduan') ?>">Panduan</a> .</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light shadow">
                        <div class="inner">
                            <h3><?= $post ?></h3>
                            <p class="text-uppercase">
                                <center>Data Posting</center>
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="<?= base_url('post'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light shadow">
                        <div class="inner">
                            <h3><?= $category ?></h3>
                            <p>
                                <center>Kategori Posting</center>
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <a href="<?= base_url('category'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light shadow">
                        <div class="inner">
                            <h3><?= $comment ?></h3>
                            <p>
                                <center>Komentar</center>
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                        <a href="<?= base_url('comment'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light shadow">
                        <div class="inner">
                            <h3><?= format_ribuan($views) ?></h3>
                            <p>
                                <center>Pengunjung Website</center>
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-leanpub"></i>
                        </div>
                        <a href="<?= base_url('visitor'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
