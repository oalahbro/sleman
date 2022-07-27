<footer class="mt-5" id="footer">
	<div class="container-fluid">
		<div class="borderTOP bg-main-blue text-light">
			<div class="px-5 py-5">
				<div class="container-xxl">
					<div class="row mb-5">
						<div class="col-sm-6 mb-3">
							<div class="row gx-0">
								<?php
								$sosmed = $this->db->get('sosmed')->result();

								foreach ($sosmed as $s) { ?>
									<div class="col-sm-12 col-md-6 mb-1">
										<a href="<?= $s->link ?>" class="text-white d-flex align-items-center text-decoration-none" target="_blank">
											<span class="fa-stack fa-2x">
												<i class="fas fa-circle fa-stack-2x"></i>
												<i class="fab fa-<?= $s->nama_sos ?> fa-stack-1x text-primary"></i>
											</span>
											Dewan Pendidikan<br />Kabupaten Sleman
										</a>
									</div>
								<?php } ?>
							</div>
						</div>

						<div class="col-sm-6 mb-3">
							<p>Alamat Sekretariat Dewan Pendidikan Kabupaten Sleman:<br /><br />

								Jalan Parasamya Beran, Tridadi, Sleman,<br />Daerah Istimewa Yogyakarta Kodepos 55511<br />
								E-mail: dewanpendidikan.sleman@gmail.com<br />
								Telp.: 0274-868512<br />
								WA/HP/SMS: 081910767633</p>

						</div>
					</div>

					<p class="text-center">Situs ini resmi milik Dewan Pendidikan Kabupaten Sleman.
						Segala informasi berhubungan dengan kebijakan dan bidang ketugasan
						yang melekat pada Dewan Pendidikan Kabupaten Sleman dipublikasikan
						melalui laman ini.
						Mari kita tebar informasi bermutu tinggi demi kemajuan dunia pendidikan di Kabupaten Sleman!</p>
				</div>
			</div>
		</div>
	</div>
</footer>