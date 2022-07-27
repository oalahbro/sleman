<!-- Content Wrapper. Contains page content -->
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
            <div class="px-2">
                <?= flashdata('message');
                unset($_SESSION['message']);
                ?>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <div class="float-left">
                <a class="btn btn-primary" href="<?= base_url('admin/panduan') ?>">
                    <i class="fas fa-info-circle"></i> Panduan</a>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="<?= base_url('tambah') ?>">
                    <i class="fas fa-plus-circle"></i> <?= $judul ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?= $tab === 'publish' ? 'active' : '' ?>" href="<?= site_url('post?page=publish') ?>">Dipublikasikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $tab === 'draft' ? 'active' : '' ?>" href="<?= site_url('post?page=draft') ?>">Draft</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="post" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($post as $ktg) {                                ?>
                                    <tr>
                                        <td class="text-center" width="100px"><?= $no++ ?></td>
                                        <td>
                                            <?= $ktg->judul_post ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <i class="fas fa-eye"></i> <a href="javascript:void(0)"></a> <?= $ktg->post_views ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $ktg->nama_kategori; ?></td>
                                        <td><?= $ktg->tanggal_post; ?></td>
                                        <td>
                                            <?php
                                            $img = base_url('assets/dist/img/default-150x150.png');
                                            if ($ktg->foto_post !== null) {
                                                $img = base_url('uploads/images/' . $ktg->foto_post);
                                            }
                                            ?>
                                            <img src="<?= $img ?>" width="100px" alt="<?= $ktg->judul_post ?>">
                                        </td>
                                        <td class="text-center" width="250px">
                                            <a href="<?= base_url("post/detail/{$ktg->permalink}") ?>" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-external-link-alt"></i> <b>Lihat</b></a>
                                            <a href="<?= base_url("admin/post/get_edit/{$ktg->id_post}"); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> <b>Edit</b></a>
                                            <button class="btn btn-sm btn-danger" data-id="<?= $ktg->id_post ?>" data-toggle="modal" data-target="#modal_hapus_post"><i class="fas fa-trash"></i> <b>Hapus</b></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal hapus data post -->
<div class="modal fade" id="modal_hapus_post" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title" id="myModalLabel">Hapus Data</h3>
            </div>
            <?= form_open('admin/post/delete', ['class' => 'form-horizontal'], ['ID_PS' => '']) ?>
            <div class="modal-body">
                <div class="text-center">
                    <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                    <h4 class="mb-4">Apakah anda yakin untuk menghapus data ini?</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>