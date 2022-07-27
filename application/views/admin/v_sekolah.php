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
        </div><!-- /.container-fluid -->
        <?= flashdata('pesan');
        unset($_SESSION['pesan']); ?>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <div class="text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fas fa-plus-circle"></i> <?= $judul ?></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_sekolah" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Sekolah</th>
                                    <th>Alamat Sekolah</th>
                                    <th>No. Telp</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($sekolah as $detSekolah) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $detSekolah->nama_sekolah ?></td>
                                        <td><?= $detSekolah->alamat_sekolah ?></td>
                                        <td><?= $detSekolah->no_telepon ?></td>
                                        <td><?= $detSekolah->kategori_sekolah ?></td>
                                        <!-- <td><img width="150" height="150" src="<?= base_url() ?>assets/dist/img/slide/<?= $detSekolah->files ?>" alt="<?= $detSekolah->fotos ?>" srcset="" class="img-fluid"></td> -->
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>data_sekolah/edit/<?= $detSekolah->id_sekolah ?>"><i class="fa fa-edit"></i> <b>Edit</b></a>
                                            <a class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-hapus<?= $detSekolah->id_sekolah ?>"><i class="fas fa-trash"></i> <b>Hapus</b></a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
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




<!-- Modal tambah slider -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title-1" id="myModalLabel">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/sekolah/tambah'); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Sekolah:</label>
                        <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukkan nama...">
                        <small id=" nama" class="form-text text-muted">Masukkan nama sekolah dengan huruf alphabet, angka, dan spasi.</small>
                        <?= form_error('nama'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Sekolah:</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" maxlength="255" placeholder="Masukkan deskripsi..."></textarea>
                        <small id="alamat" class="form-text text-muted">Masukkan deskripsi maksimum 250 karakter</small>
                        <?= form_error('alamat'); ?>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telepon:</label>
                        <input type="number" class="form-control" name="notelp" placeholder="Masukkan No Telp">
                        <small id="notelp" class="form-text text-muted">Masukkan deskripsi maksimum 250 karakter</small>
                        <?= form_error('notelp'); ?>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Pilih Kategori</label>
                        <select class="form-control" name="kategori" id="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="PAUD">PAUD dan TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                            <option value="KULIAH">KULIAH</option>
                            <option value="SLB">SLB</option>
                        </select>
                        <?= form_error('kategori'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="save-btn" class="btn btn-success"><i class="fas fa-save"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php foreach ($sekolah as $sklh) { ?>
    <form action="<?= base_url() ?>admin/sekolah/delete/" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="modal-hapus<?= $sklh->id_sekolah; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Hapus Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus file dari <b><?= $sklh->nama_sekolah ?></b> ini?</h4>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <input type="hidden" name="id_hapus" value="<?= $sklh->id_sekolah; ?>" required>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
