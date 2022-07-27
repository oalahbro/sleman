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
                        <?php foreach ($saran as $detAng) { ?>
                                <table class="table table-borderless mt-1">
                                    <tbody>
                                        <tr>
                                            <td class="text-right" width="200px">Email :</td>
                                            <td ><?= $detAng->email_saran?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Saran :</td>
                                            <td ><?= $detAng->saran?></td>
                                        </tr>
                                    </tbody>
                                </table>
                        <?php }?>
                        <button onclick="window.history.go(-1); return false;" class="btn btn-danger text-white px-3 mr-1"><i class="fas fa-arrow-left mr-2"></i>Kembali</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>
