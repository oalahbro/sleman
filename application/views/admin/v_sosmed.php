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
                        <li class="breadcrumb-item"><a href="home">Beranda</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="px-2">
            <?= flashdata('pesan');
            unset($_SESSION['pesan']); ?>
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="card-header">
            <div class="card-tools float-right">
                <?php if (count($sosmed) === 4) { ?>
                    <button type="button" class="btn btn-primary disabled">
                        <i class="fas fa-plus-circle"></i> Sosial Media</button>
                <?php } else { ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                        <i class="fas fa-plus-circle"></i> Sosial Media</button>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="sosmed" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jenis Sosial Media</th>
                                    <th>Link</th>
                                    <th>Cek</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;

                                foreach ($sosmed as $dns) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td><?= $dns->nama_sos; ?></td>
                                        <td><?= $dns->link; ?></td>
                                        <td>
                                            <a href="<?= $dns->link ?>" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="fas fa-external-link-alt"></i> Cek Sosmed</a>
                                        </td>
                                        <td class="text-center" width="180px">
                                            <button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modalEdit<?= $dns->id_sosmed; ?>"><i class="fas fa-edit"></i>
                                                <b>Edit</b></button>
                                            <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modalDelete<?= $dns->id_sosmed; ?>"><i class="fas fa-trash"></i>
                                                <b>Hapus</b></button>
                                        </td>
                                    <?php $i++;
                                endforeach; ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Tambah Sosial Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() . 'admin/sosmed/tambah' ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_sos">Jenis Sosial Media</label>
                        <select class="form-control" id="nama_sos" name="nama_sos" aria-label="Pilih sosial media">
                            <option selected value="">-- Pilih Sosial Media --</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">Twitter</option>
                            <option value="youtube">Youtube</option>
                        </select>
                        <!-- <input type="text" id="nama_sos" name="nama_sos" class="form-control" placeholder="nama sosmed"> -->
                        <small class="form-text text-muted">Jenis Sosial Media Seperti: Instragram, Twitter, Youtube</small>
                        <?= form_error('nama_sos'); ?>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" id="link" name="link" class="form-control" placeholder="Link Sosial Media">
                        <small class="form-text text-muted">Link Sosial Media Yang Dituju</small>
                        <?= form_error('link'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($sosmed as $r) :
    $id   = $r->id_sosmed;
    $nama = $r->nama_sos;
    $link = $r->link;
?>
    <div class="modal fade" id="modalEdit<?= $id; ?>" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Ubah Sosial Media</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() . 'admin/sosmed/edit' ?>" method="post">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_sos">Jenis Sosial Media</label>
                                <select class="form-control" id="nama_sos" name="nama_sos1" aria-label="Pilih sosial media">
                                    <option selected value="">-- Pilih Sosial Media --</option>
                                    <option value="facebook" <?= $nama === 'facebook' ? 'selected' : '' ?>>Facebook</option>
                                    <option value="instagram" <?= $nama === 'instagram' ? 'selected' : '' ?>>Instagram</option>
                                    <option value="twitter" <?= $nama === 'twitter' ? 'selected' : '' ?>>Twitter</option>
                                    <option value="youtube" <?= $nama === 'youtube' ? 'selected' : '' ?>>Youtube</option>
                                </select>
                                <!-- <input type="text" id="nama_sos" value="<?= $nama ?>" name="nama_sos" class="form-control" placeholder="Nama Sosial Media"> -->
                                <small class="form-text text-muted">Jenis Sosial Media seperti: Instragram, Twitter, Youtube</small>
                                <?= form_error('nama_sos1'); ?>

                            </div>
                            <div class="form-group">
                                <label for="link">link</label>
                                <input type="text" name="link1" id="link1" class="form-control" value="<?= $link ?>">
                                <small class="form-text text-muted">Link Sosial Media Yang Dituju</small>
                                <?= form_error('link1'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_sosmed" value="<?= $id ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete<?= $id; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/sosmed/delete'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="text-center">
                            <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                            <h4 class="mb-4">Apakah anda yakin untuk menghapus data <b><?= $nama; ?></b> ini?</h4>
                        </div>
                        <input type="hidden" name="id_sosmed" value="<?= $id; ?>">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
