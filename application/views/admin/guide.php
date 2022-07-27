<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-4 text-center">
                <img src="<?= base_url(); ?>assets/dist/icon/qa.svg" width="600" alt="halo">
            </div>
            <div class="col-lg-8" id="accordion">
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseZero">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                1. Tentang cara kerja web ini
                            </h4>
                        </div>
                    </a>
                    <div id="collapseZero" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            Web ini menggunakan cara kerja CMS atau Content Management System. Dengan konsep tersebut, website ini didesain dengan fitur yang ramah bagi siapapun yang masih awam mengenai website dan lain sebagainya.</a>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                2. Halaman
                            </h4>
                        </div>
                    </a>
                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Menu yang sudah terbuat merupakan keinginan dari klien, untuk selanjutnya akan dilanjutkan dengan desain UI/UX dan proses coding untuk membentuk sebuah website.</a>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                3. Bagaimana cara membuat posting setiap halaman?
                            </h4>
                        </div>
                    </a>
                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Pada setiap halaman dapat dilakukan pengisian konten, untuk melakukan hal tersebut terdapat pada menu tambah konten posting dan menu pendukung yang lain seperti menu daftar post serta kategori post untuk opsi menambah kategori.
                            <ul>
                                <li>
                                    Buat Konten <a class="btn btn-info" href="<?= base_url('create') ?>"><i class="fas fa-external-link-alt"></i></a> Daftar Post <a class="btn btn-info" href="<?= base_url('post') ?>"><i class="fas fa-external-link-alt"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                4. Mengubah dan menambah serta susunan regulasi dan organisasi lebih dinamis dengan website ini
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Untuk melakukan hal tersebut, masuk ke menu struktur organisasi. <a class="btn btn-info" href="<?= base_url('dataset') ?>" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                5. Selesai
                            </h4>
                        </div>
                    </a>
                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            Berikut merupakan tutorial singkat, untuk penjalasan lebih lanjut akan ditampilkan dalam bentuk video ataupun guide book <i class="far fa-smile"></i> .
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
