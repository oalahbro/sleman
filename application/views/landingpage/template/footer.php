    <?= $this->load->view('landingpage/template/_footer', [], true) ?>

    <a href="#navtop" class="back-to-top p-3" id="back-to"><i class="fas fa-chevron-up"></i></a>

    <!-- JavaScript Bundle with Popper -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= base_url() ?>assets/dist/js/jquery.3.6.0.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/app.js"></script>

    <!--  isotope js library  -->
    <script src="<?= base_url() ?>assets/dist/vendor/isotope/isotope.min.js"></script>

    <!--  Magnific popup script file  -->
    <script src="<?= base_url() ?>assets/dist/vendor/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>

    <script data-search-pseudo-elements defer data-auto-replace-svg="nest" src="https://cdn.jsdelivr.net/gh/totoprayogo1916/Font-Awesome-SVG-PNG@test/fontawesome.js"></script>

    <!--  aos js file  -->
    <script src="<?= base_url('/assets/dist/js/aos.js') ?>"></script>
    <!-- datatable dan plugin -->
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
    	/* begin begin Back to Top button  */
    	(function() {
    		'use strict';
    		//
    		document.querySelectorAll('.reply-comment').forEach(item => {
    			item.addEventListener('click', event => {
    				//handle click
    				var nama = item.getAttribute('data-nama')
    				// set value of `parent_id`
    				document.forms['Komentar']['parent_id'].value = item.id;

    				//get the target div you want to append/prepend to
    				var statusBalas = document.getElementById("info_balas");

    				//prepend text
    				statusBalas.innerHTML = '<div class="alert alert-warning">Membalas komentar dari <b>' + nama + '</b></div>';
    			})
    		})

    		//
    		/* begin begin Back to Top button  */

    		var goTopBtn = document.getElementById('back-to')

    		function trackScroll() {
    			var scrolled = window.pageYOffset;
    			var coords = document.documentElement.clientHeight;

    			if (scrolled > coords) {
    				goTopBtn.classList.add("d-block");
    			}
    			if (scrolled < coords) {
    				goTopBtn.classList.remove("d-block");
    			}
    		}

    		window.addEventListener("scroll", trackScroll);

    		/* end begin Back to Top button  */
    	})();
    </script>
    <script>
    	$(function() {
    		$("#regulasi").DataTable({
    			"responsive": true,
    			"autoWidth": false
    		}).buttons().container().appendTo('#regulasi_wrapper .col-md-6:eq(0)');
    		$("#aspirasi").DataTable({
    			"responsive": true,
    			"autoWidth": false
    		}).buttons().container().appendTo('#aspirasi_wrapper .col-md-6:eq(0)');
    		$("#lihat_sekolah").DataTable({
    			"responsive": true,
    			"autoWidth": false
    		}).buttons().container().appendTo('#lihat_sekolah_wrapper .col-md-6:eq(0)');
    	});
    </script>

    </body>

    </html>