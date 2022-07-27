    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comment-alt"></i>
                <span class="badge badge-danger navbar-badge"><?= countPendingComment() ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <!-- <img src="<?= base_url() ?>assets/dist/img/user_blank.png" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Jumlah komentar tersedia
                                <span class="float-right text-md text-danger">
                                    <h6 class="fw-bold"><?= countPendingComment() ?></h6>
                                </span>
                            </h3>
                            <!-- <p class="text-sm">Call me whenever you can...</p> -->
                            <p class="text-sm text-muted">Untuk melakukan moderasi silahkan klik link dibawah ini</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('comment/pending') ?>" class="dropdown-item dropdown-footer">Lihat Seluruh Pesan</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <?php $count_notif = $this->db->query('SELECT * FROM aspirasi WHERE read_msg = 0'); ?>
                <span class="badge badge-warning navbar-badge">
                    <?= $count_notif->num_rows(); ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php $notif_aspirasi = $this->db->query('SELECT * FROM aspirasi ORDER BY id_aspirasi DESC LIMIT 3')->result(); ?>
                <?php if ($notif_aspirasi == null) : ?>
                    <div class="col-md">
                        <div class="card-body text-center mt-4">
                            <img src="<?= base_url('assets/dist/icon/notify.svg'); ?>" alt="noData" class="img-rounded img-responsive img-fluid" width="200">
                        </div>
                        <div class="card-body pt-0 mt-4">
                            <h5 class="text-center text-bold text-muted">Belum terdapat notif</h6>
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach ($notif_aspirasi as $feedback) :
                        $grav_url = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($feedback->email))) . '?d=mp&s=70';
                    ?>
                        <a href="<?= base_url('aspirasi/detail/' . $feedback->id_aspirasi) ?>" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?= $grav_url ?>" alt="User Avatar" class="img-size-50 mr-1 img-circle">
                                <div class="media-body">
                                    <?php if ($feedback->read_msg === '0') {
                                        $rclass = 'warning';
                                        $gtext  = 'Belum dibaca';
                                    } else {
                                        $rclass = 'success';
                                        $gtext  = 'Sudah dibaca';
                                    } ?>
                                    <span class="badge badge-sm badge-<?= $rclass ?>"><?= $gtext ?></span>
                                    <h3 class="dropdown-item-title">
                                        <?= $feedback->nama ?>
                                    </h3>
                                    <small class="text-muted">
                                        <?= $feedback->email ?>
                                    </small>
                                    <?php if ($feedback->tipe === 'kritik') {
                                        $bclass = 'danger';
                                        $btext  = 'Kritik';
                                    } else {
                                        $bclass = 'info';
                                        $btext  = 'Saran';
                                    }
                                    ?>
                                    <span class="badge badge-<?= $bclass ?>"><?= $btext ?></span>
                                    <p class="text-sm"><?php
                                                        $string = strip_tags($feedback->isi);
                                                        if (strlen($string) > 50) {

                                                            // truncate string
                                                            $stringCut = substr($string, 0, 50);
                                                            $endPoint  = strrpos($stringCut, ' ');

                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string .= '...';
                                                        }
                                                        echo $string;
                                                        ?></p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= $feedback->tanggal ?></p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <a href="<?= base_url('aspirasi') ?>" class="dropdown-item dropdown-footer">Lihat Seluruh Aspirasi</a>
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <?php if ($user['foto_user'] === null) {
                $img = base_url('assets/dist/img/user/' . $user['foto_user']);
            } else {
                $img = base_url('uploads/images/' . $user['foto_user']);
            }
            ?>

            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $img ?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?= $user['nama_user']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?= $img ?>" class="img-circle elevation-2" alt="User Image" />
                    <p>
                        <small><span title="admin" class="badge badge-warning">Admin</span></small>
                        <?= $user['email']; ?>
                    </p>
                    <!-- <small>
                        <?php if ($user['Tanggal_Terbuat'] !== 0) { ?>
                            Terdaftar <?= date('d F Y', $user['tanggal']); ?>
                        <?php } else { ?>
                            Terdaftar <span title='caption' class='badge badge-secondary'></span>
                        <?php } ?>
                    </small> -->
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="<?= base_url('profile'); ?>" class="btn btn-outline-primary">Profil</a>
                    <button type="button" class="btn btn-outline-danger float-right" data-toggle="modal" data-target="#modal-sm">Keluar</button>
                </li>
            </ul>
        </li>
    </ul>
    <!-- <ul class="navbar-nav ml-auto">

    </ul> -->
    </nav>
    <!-- /.navbar -->

    <!-- Modal Logout -->
    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Logout</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin logout?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('logout'); ?>" class="btn btn-danger">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
