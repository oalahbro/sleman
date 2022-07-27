<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('admin/beranda') ?>" class="brand-link">
        <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-bold">Dewandik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if ($user['foto_user'] === null) {
                    $img = base_url('assets/dist/img/user/' . $user['foto_user']);
                } else {
                    $img = base_url('uploads/images/' . $user['foto_user']);
                }
                ?>
                <img src="<?= $img ?>" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a class="d-block"><?= $user['nama_user'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <?php $link = ($this->uri->segment(2) ?? $this->uri->segment(1)); ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Beranda</li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/beranda') ?>" class="nav-link<?= ($link === 'beranda' ? ' active' : '') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/panduan') ?>" class="nav-link<?= ($link === 'panduan' ? ' active' : '') ?>">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Panduan
                        </p>
                    </a>
                </li>
                <li class="nav-header">Manajemen Postingan</li>
                <li class="nav-item">
                    <a href="<?= base_url('tambah') ?>" class="nav-link <?php if ('tambah' === $link) {
                                                                            echo 'active';
                                                                        } ?>">
                        <i class="nav-icon fas fa-pencil-ruler"></i>
                        <p>
                            Tambah Postingan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('post') ?>" class="nav-link <?php if ('post' === $link) {
                                                                            echo 'active';
                                                                        } ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Daftar Postingan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('comment') ?>" class="nav-link <?php if ('comment' === $link) {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Daftar Komentar
                        </p>
                        <span class="badge badge-danger right"><?= countPendingComment() ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('category') ?>" class="nav-link <?php if ('category' === $link) {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Daftar Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-header">Pengaturan Website</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link <?php if (
                                                    $this->uri->segment(1) === 'foto_gk'
                                                    || $this->uri->segment(1) === 'video_gk'
                                                    || $this->uri->segment(1) === 'regulation'
                                                    || $this->uri->segment(1) === 'data_sekolah'
                                                    || $this->uri->segment(1) === 'sosmed'
                                                    || $this->uri->segment(1) === 'dinas'
                                                    || $this->uri->segment(1) === 'pengaturan'
                                                ) {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pengaturan Website
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('regulation'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'regulation') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regulasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('foto_gk'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'foto_gk') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Foto</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('video_gk'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'video_gk') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('data_sekolah'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'data_sekolah') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('sosmed'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'sosmed') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sosial Media</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('dinas'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'dinas') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dinas Terkait</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('banner'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'banner') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('pengaturan'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'pengaturan') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link
                        <?php if (
                            $this->uri->segment(1) === 'structure'
                            || $this->uri->segment(1) === 'struktur-jabatan'
                            || $this->uri->segment(1) === 'redaction'
                            || $this->uri->segment(1) === 'struktur-redaksi'
                        ) {
                            echo 'active';
                        } ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Struktur Organisasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('structure'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'structure') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Struktur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('struktur-jabatan'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'struktur-jabatan') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Struktur Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('redaction'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'redaction') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tim Redaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('struktur-redaksi'); ?>" class="nav-link
                                <?php if ($this->uri->segment(1) === 'struktur-redaksi') {
                                    echo 'active';
                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Struktur Redaksi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('riset') ?>" class="nav-link <?php if ('riset' === $link) {
                                                                            echo 'active';
                                                                        } ?>">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            Publikasi Riset
                        </p>
                    </a>
                </li>
                <li class="nav-header">Info</li>
                <li class="nav-item ">
                    <a href="<?= base_url('visitor') ?>" class="nav-link <?php if ('visitor' === $link) {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                            Pengunjung Website
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url('aspirasi') ?>" class="nav-link <?php if ('aspirasi' === $link) {
                                                                                echo 'active';
                                                                            } ?>">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Aspirasi Publik
                        </p>
                        <?php $count_notif = $this->db->get_where('aspirasi', ['read_msg' => '0']); ?>
                        <span class="badge badge-warning right"><?= $count_notif->num_rows(); ?></span>
                    </a>
                </li>
                <!-- <li class="nav-header">Keluar akun</li> -->
                <li class="nav-item bg-danger mb-2">
                    <a href="#" data-toggle="modal" data-target="#modal-sm" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            <b>Keluar</b>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
