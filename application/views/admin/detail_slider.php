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
        <div class="flash-data" data-flashdata="<?= flashdata('message'); ?>"></div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content text-center">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($slider as $detSlider) { ?>
                            <table class="table table-borderless mt-1">
                                <tbody>
                                    <tr>
                                        <td class="text-right" width="200px">Nama Slider :</td>
                                        <td><?= $detSlider->foto ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Deskripsi Slider :</td>
                                        <td><?= $detSlider->deskripsi ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Foto Slider :</td>
                                        <td><img src="<?= base_url() ?>assets/dist/img/slide/<?= $detSlider->file ?>" alt="Foto Slider" class="img-fluid"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group text-center">
                                <a class="btn btn-secondary px-3 mr-1" href="<?= base_url() ?>admin/slider">Kembali</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
