<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/dist/img/favicon/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/dist/img/favicon/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/dist/img/favicon/favicon-16x16.png" />
	<!-- <link rel="manifest" href="/site.webmanifest"> -->

	<!-- Google Recaptcha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

	<!-- CSS only -->
	<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/drop.css"> -->
	<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />

	<title><?= $judul ?? 'Dewandik Sleman' ?> | Dewan Pendidikan Kabupaten Sleman</title>

	<style>

		.img-hover-zoom {
			overflow: hidden;
		}

		.img-hover-zoom img {
			transition: transform .5s ease;
		}

		.img-hover-zoom:hover img {
			transform: scale(1.1);
		}

		._nav a {
			color: #292b2c;
			text-decoration: none;
			letter-spacing: 0.02rem;
			font-weight: 500;
			display: inline-block;
			padding: 15px 20px;
			position: relative;
			font-family: Arial, Helvetica, sans-serif;
		}

		._nav a:hover {
			color: #0275d8;
		}

		._nav a:after {
			background: none repeat scroll 0 0 transparent;
			bottom: 0;
			content: "";
			display: block;
			height: 2px;
			left: 50%;
			position: absolute;
			background: #0275d8;
			transition: width 0.3s ease 0s, left 0.3s ease 0s;
			width: 0;
		}


		._nav a:hover:after {
			color: #0275d8;
			width: 100%;
			left: 0;
		}

		.borderDewandik {
			border-radius: 42px;
		}

		.borderDewandik2 {
			border-radius: 30px;
			min-width: 20%;
		}

		.borderTOP {
			border-top-right-radius: 42px;
			border-top-left-radius: 42px;
		}

		.borderBTM {
			border-bottom-left-radius: 42px;
			border-bottom-right-radius: 42px;
		}

		.navbar_dewandik {
			min-width: 133px;
		}

		.navbar_dewandik a>h1 {
			font-size: 1em;
		}

		.navbar_dewandik .dropdown-divider {
			width: 60%;
			margin: 0 auto
		}

		.Sidebar.sticky-top {
			top: 20px
		}

		#dewandikMenu ul.navbar-nav>li {
			padding-left: 15px;
			/* font-weight: bold */
			font-size: 1.2em;
		}

		.bg-main-blue {
			background: #088BFE;
		}

		#carouselPermen .carousel-item>.sld,
		#carouselPeople .carousel-item>.sld {
			max-width: 80%;
			margin-right: auto;
			margin-left: auto;
			padding: 5%;
		}

		#carouselPermen2 .carousel-item>.sld2,
		#carouselPeople2 .carousel-item>.sld2 {
			max-width: 80%;
			margin-right: auto;
			margin-left: auto;
			padding: 5%;
		}

		.carousel-control-next-icon,
		.carousel-control-prev-icon {
			width: 5rem;
			height: 5rem;
		}

		.card-img-overlay {
			background-color: rgba(0, 0, 0, .5);
			top: unset;
		}

		/* #footer .grad {
			background: hsla(271, 100%, 66%, 1);
			background: linear-gradient(90deg, hsla(271, 100%, 66%, 1) 0%, hsla(271, 100%, 66%, 1) 0%, hsla(188, 100%, 50%, 1) 100%);
			background: -moz-linear-gradient(90deg, hsla(271, 100%, 66%, 1) 0%, hsla(271, 100%, 66%, 1) 0%, hsla(188, 100%, 50%, 1) 100%);
			background: -webkit-linear-gradient(90deg, hsla(271, 100%, 66%, 1) 0%, hsla(271, 100%, 66%, 1) 0%, hsla(188, 100%, 50%, 1) 100%);
			filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#AA52FF", endColorstr="#AA52FF", GradientType=1);
		} */

		.about {
			text-align: justify;
			text-justify: inter-word;
		}

		.previous {
			background-color: #009fe3;
			color: white;
		}

		.next {
			background-color: #009fe3;
			color: white;
		}

		.round {
			border-radius: 40%;
		}


		#back-to {
			position: fixed;
			display: none;
			right: 30px !important;
			bottom: 25px;
			z-index: 99999;
		}

		#back-to>i {
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 24px;
			width: 40px;
			height: 40px;
			border-radius: 4px;
			background: #5846f9;
			color: #fff;
			transition: all 0.4s;
		}

		#back-to>i:hover {
			background: #7b27d8;
			color: #fff;
		}

		.page-link a {
			text-decoration: none;
		}
		/* #sekolah:hover {
			-webkit-transform: scale(1.08);
  			transform: scale(1.08);
		} */

	</style>

	<!--  AOS file  -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/aos.css">

	<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=6156e9646a41fc001a0acfdb&product=inline-share-buttons" async="async"></script>
</head>

<body>
	<?= $this->load->view('landingpage/template/_navbar', [], true) ?>