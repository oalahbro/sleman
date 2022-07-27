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
                          <li class="breadcrumb-item"><a href="home">Beranda</a></li>
                          <li class="breadcrumb-item active"><?= $title; ?></li>
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
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="card-tools float-left">
                              <a href="<?= base_url('regulasi') ?>" class="btn btn-primary" target="_blank">
                                  <i class="fas fa-external-link-alt"></i> Cek Regulasi</a>
                          </div>
                          <div class="card-tools float-right">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                                  <i class="fas fa-plus-circle"></i> Regulasi</button>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table id="regulasi" class="table table-bordered table-striped">
                              <thead>
                                  <tr class="text-center">
                                      <th>No</th>
                                      <th>Judul</th>
                                      <th>Isi</th>
                                      <th>Status</th>
                                      <th>Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $no = 1; ?>
                                  <?php foreach ($regulasi as $p) :
                                        $id     = $p['id_regulasi'];
                                        $judul  = $p['judul'];
                                        $isi    = $p['isi'];
                                        $status = $p['status'];
                                    ?>
                                      <tr>
                                          <td class="text-center" width="100px"><?= $no; ?></td>
                                          <td><?= $judul ?></td>
                                          <td><?php
                                                $aa     = 100;
                                                $konten = htmlspecialchars_decode($isi);
                                                $em     = str_replace('<em>', '', $konten);
                                                $strong = str_replace('<strong>', '', $em);
                                                $count  = strlen($strong);
                                                if ($count > $aa) {
                                                    $char = $strong[$aa - 1];

                                                    while ($char !== ' ') {
                                                        $char = $strong[--$aa];
                                                    }
                                                    echo substr($strong, 0, $aa) . ' ...';
                                                } else {
                                                    echo $strong;
                                                }
                                                ?></td>
                                          <td class="text-center" width="140px">
                                              <?php if ($status == 0) : ?>
                                                  <button class="btn btn-sm btn-success m-1" data-toggle="modal" data-target="#modalUbah<?= $id; ?>"><i class="fas fa-eye"> </i>
                                                      <b>Tampil</b></button>
                                              <?php else : ?>
                                                  <button class="btn btn-sm btn-secondary m-1" data-toggle="modal" data-target="#modalUbah1<?= $id; ?>"> <i class="fas fa-eye-slash"></i>
                                                      <b>Tidak Tampil</b></button>
                                              <?php endif; ?>
                                          </td>
                                          <td class="text-center" width="160px">
                                              <button class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modalEdit<?= $id; ?>"><i class="fas fa-edit"></i>
                                                  <b>Edit</b></button>
                                              <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modalDelete<?= $id; ?>"><i class="fas fa-trash"></i>
                                                  <b>Hapus</b></button>
                                          </td>
                                      </tr>
                                      <?php $no++; ?>
                                  <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="modalAdd" tabindex="-1">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <h5 class="modal-title">Tambah Regulasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="<?= base_url() . 'admin/regulation/tambah' ?>" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="judul">Judul</label>
                          <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Regulasi">
                          <small class="form-text text-muted">Contoh: Peraturan UU nomer 1</small>
                          <?= form_error('judul'); ?>
                      </div>
                      <div class="form-group">
                          <label for="isi">Isi</label>
                          <textarea class="textarea" id="reg_konten" name="isi" placeholder="Isi Konten" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                          <small class="form-text text-muted">Merupakan isi konten</small>
                          <?= form_error('isi'); ?>
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


  <?php foreach ($regulasi as $r) :
        $id    = $r['id_regulasi'];
        $judul = $r['judul'];
        $isi   = $r['isi'];
    ?>
      <div class="modal fade" id="modalUbah<?= $id; ?>" tabindex="-1">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h5 class="modal-title">Menampilkan Regulasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="<?= base_url() . 'admin/regulation/tampil' ?>" method="post">
                      <div class="modal-body">
                          <div class="text-center">
                              <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/switch.svg" width=250px alt="ubah-img">
                              <h4 class="mb-4">Apakah anda yakin untuk menampilkan-nya ke slide-show ?</h4>
                          </div>
                          <input type="hidden" name="id_tampil" value="<?= $id; ?>">
                      </div>
                      <div class="modal-footer justify-content-between">
                          <input type="hidden" name="id_ubah" value="<?= $id; ?>">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Iya</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalUbah1<?= $id; ?>" tabindex="-1">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h5 class="modal-title">Tidak Menampilkan Regulasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="<?= base_url() . 'admin/regulation/tak_tampil' ?>" method="post">
                      <div class="modal-body">
                          <div class="text-center">
                              <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/switch.svg" width=250px alt="ubah-img">
                              <h4 class="mb-4">Apakah anda yakin untuk tidak menampilkan-nya ke slide-show ?</h4>
                          </div>
                          <input type="hidden" name="id_tak_tampil" value="<?= $id; ?>">
                      </div>
                      <div class="modal-footer justify-content-between">
                          <input type="hidden" name="id_ubah" value="<?= $id; ?>">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                          <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Iya</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div class="modal fade" id="modalEdit<?= $id; ?>" tabindex="-1">
          <div class="modal-dialog modal-xl">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h5 class="modal-title">Ubah Regulasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="<?= base_url() . 'admin/regulation/edit' ?>" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                          <div class="modal-body">
                              <div class="form-group">
                                  <label for="judul">Judul</label>
                                  <input type="text" id="judul1" value="<?= $judul ?>" name="judul1" class="form-control" placeholder="Nama Menu">
                                  <small class="form-text text-muted">Contoh: Peraturan UU nomer 1</small>
                                  <?= form_error('judul1'); ?>
                              </div>
                              <div class="form-group">
                                  <label for="isi">Isi</label>
                                  <textarea class="textarea" name="isi1" placeholder="Isi Konten" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $isi ?></textarea>
                                  <small class="form-text text-muted">Merupakan isi konten</small>
                                  <?= form_error('isi1'); ?>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <input type="hidden" name="ID_REG" value="<?= $id ?>">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <!-- Modal Hapus Data -->
      <div class="modal fade" id="modalDelete<?= $id; ?>">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header bg-primary">
                      <h4 class="modal-title">Hapus Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="<?= base_url('admin/regulation/delete'); ?>" method="POST">
                      <div class="modal-body">
                          <div class="text-center">
                              <img class="mt-2 mb-2" src="<?= base_url(); ?>assets/dist/icon/hapus.svg" width=80% alt="delete-img">
                              <h4 class="mb-4">Apakah anda yakin untuk menghapus data <b><?= $judul ?></b> ini?</h4>
                          </div>
                          <input type="hidden" name="id_delete" value="<?= $id; ?>">
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