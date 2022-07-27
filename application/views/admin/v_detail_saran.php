<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/beranda') ?>">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($aspirasi as $detAng) { ?>
                            <form>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" value="<?= $detAng->nama ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?= $detAng->email ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi</label>
                                    <textarea class="form-control" rows="7" id="isi" aria-describedby="emailHelp" disabled><?= $detAng->isi ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="tipe" class="form-label">Jenis</label>
                                    <input type="text" class="form-control" id="tipe" aria-describedby="emailHelp" value="<?= $detAng->tipe ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" id="tangal" aria-describedby="emailHelp" value="<?= $detAng->tanggal ?>" disabled>
                                </div>
                                <div class="form-group text-center">
                                    <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>aspirasi">Kembali</a>
                                </div>
                            </form>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
