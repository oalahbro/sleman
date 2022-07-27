</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
	<strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url('admin/beranda') ?>"> Dewandik</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> Alpha
	</div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="<?= base_url() ?>assets/dist/js/jquery.3.6.0.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Counter Up -->
<script src="<?= base_url() ?>assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url() ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- Drop Image -->
<script src="<?= base_url(); ?>assets/dist/js/app.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
	$(function() {

		//-------------
		//- LINE CHART -
		//--------------
		var areaChartData = {
			labels: <?= $month; ?>,
			datasets: [{
				label: "Pengunjung",
				backgroundColor: 'rgba(60,141,188,0.4)',
				borderColor: 'rgba(60,141,188,1)',
				pointRadius: 5,
				pointColor: '#3b8bba',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				tension: 0.1,
				data: <?= $value; ?>
			}]
		}

		var areaChartOptions = {
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,
			//String - Colour of the grid lines
			scaleGridLineColor: 'rgba(0,0,0,.05)',
			//Number - Width of the grid lines
			scaleGridLineWidth: 0,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: true,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 2,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			tooltipCornerRadius: 2,
			//Tooltip - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: true,
			//String - A legend template
			legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			//Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		}

		var lineChartCanvas = $('#chart').get(0).getContext('2d')
		var lineChart = new Chart(lineChartCanvas, {
			type: 'line',
			data: areaChartData,
			options: lineChartOptions
		})
		var lineChartOptions = areaChartOptions
		lineChartOptions.datasetFill = false
		// lineChart.Line(areaChartData, lineChartOptions)
	})
</script>

<!-- Enable/Disabled Form Edit profile -->
<script>
	$(document).ready(function() {
		$("#btn-edit").click(function() {
			$(".tittle").html("Edit Profil");
			$("#btn-edit").prop('hidden', true);
			$("#btn-save").prop('hidden', false);
			$("#btn-cancel").prop('hidden', false);
			$("#nm").prop('disabled', false);
			$("#hp").prop('disabled', false);
			$("#desc").prop('disabled', false);
			$("#imgedit").prop('hidden', false);
			$("#img").prop('hidden', true);
		});

		$("#btn-cancel").click(function() {
			$(".tittle").html("Profil");
			$("#btn-edit").prop('hidden', false);
			$("#btn-save").prop('hidden', true);
			$("#btn-cancel").prop('hidden', true);
			$("#nm").prop('disabled', true);
			$("#hp").prop('disabled', true);
			$("#desc").prop('disabled', true);
			$("#imgedit").prop('hidden', true);
			$("#img").prop('hidden', false);
		});
	});
</script>

<script>
	$(document).ready(function() {
		$("#btn-reset").click(function() {
			$('#konten').summernote('reset');
		});
	});
</script>

<script>
	$('#konten').summernote({
		placeholder: 'Berisi keterangan konten atau isi konten',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			// ['font', ['strikethrough', 'superscript', 'subscript']],
			// ['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});

	$('#reg_konten').summernote({
		placeholder: 'Masukkan isi Konten',
		tabsize: 2,
		height: 100
	});

	$('#visi').summernote({
		placeholder: 'Isi visi dan misi...',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});
	$('#sambutan').summernote({
		placeholder: 'Isi sambutan ketua...',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});
	$('#sejarah').summernote({
		placeholder: 'Isi sejarah dewan pendidikan...',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});
	$('#anggaran').summernote({
		placeholder: 'Isi anggaran...',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});
	$('#sejarah').summernote({
		placeholder: 'Isi sejarah dewan pendidikan...',
		height: 200,
		toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['insert', ['picture', 'link', 'video', 'table']],
			['para', ['ul', 'ol', 'paragraph']],
			['view', ['fullscreen', 'codeview']],
		]
	});
</script>

<script>
	function triggerClick(b) {
		document.querySelector('#profileImage').click();
	}

	function displayImage(b) {
		if (b.files[0]) {
			var reader = new FileReader();
			reader.onload = function(b) {
				document.querySelector('#profileDisplay').setAttribute('src', b.target.result);
			}
			reader.readAsDataURL(b.files[0]);
		}
	}
</script>
<script>
	$(function() {
		$("#redaksi").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#redaksi_wrapper .col-md-6:eq(0)');
		$("#struktur_redaksi").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#struktur_redaksi_wrapper .col-md-6:eq(0)');
		$("#struktur").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#struktur_wrapper .col-md-6:eq(0)');
		$("#jabatan").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#jabatan_wrapper .col-md-6:eq(0)');
		$("#post").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#post_wrapper .col-md-6:eq(0)');
		$("#cat").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#cat_wrapper .col-md-6:eq(0)');
		$("#fotogk").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#fotogk_wrapper .col-md-6:eq(0)');
		$("#video").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#video_wrapper .col-md-6:eq(0)');
		$("#regulasi").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#regulasi_wrapper .col-md-6:eq(0)');
		$("#data_sekolah").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#data_sekolah_wrapper .col-md-6:eq(0)');
		$("#publikasi").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#publikasi_wrapper .col-md-6:eq(0)');
		$("#dinas").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#dinas_wrapper .col-md-6:eq(0)');
		$("#sosmed").DataTable({
			"responsive": true,
			"autoWidth": false
		}).buttons().container().appendTo('#sosmed_wrapper .col-md-6:eq(0)');

	});

	// halaman komentar
	function ubahKomentar(data) {
		var d = JSON.parse(data.getAttribute('data-content'));
		// sisipkan ke form
		// id
		document.querySelector('#ubahKomen input[name=id]').value = d.id;
		// nama
		document.querySelector('#ubahKomen input#nama').value = d.nama;
		// email
		document.querySelector('#ubahKomen input#email').value = d.email;
		// isi komen
		document.querySelector('#ubahKomen textarea#isi').value = d.isi;
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#pesan").fadeTo(4000, 500).slideUp(500, function() {
			$("#pesan").slideUp(500);
		});
	})
</script>

<!-- Show dan Hide Password -->
<script type="text/javascript">
	$(document).ready(function() {

		$("#show-hide").click(function() {
			$("#icon").toggleClass('fa-eye-slash');

			var input = $("#password");

			if (input.attr("type") === "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});

		$("#show-hide2").click(function() {
			$("#icon2").toggleClass('fa-eye-slash');

			var input = $("#password2");

			if (input.attr("type") === "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});

		$("#show-hide3").click(function() {
			$("#icon3").toggleClass('fa-eye-slash');

			var input = $("#password3");

			if (input.attr("type") === "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	});

	// modal hapus post
	$('#modal_hapus_post').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget) // Button that triggered the modal

		// set `ID_PS`
		document.querySelector('[name="ID_PS"]').value = button.data('id');
	})
</script>

<script>
	$('.del').on('click', function(e) {
		e.preventDefault();
		var form = $(this).parents('form');

		Swal.fire({
			title: 'Anda yakin mau menghapus?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location = this.href;
			}
		})
	});
</script>
</body>

</html>