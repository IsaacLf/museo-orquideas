<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>orquideas</title>
 
    <!-- Fonts -->
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="Colorlib">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Base</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500" rel="stylesheet">

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/linearicons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/nice-select.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/show/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="oz-body-wrap">
		<!-- Start Header Area -->
		<header class="default-header">
			<div class="container-fluid">
				<div class="header-wrap">
					<div class="header-top d-flex justify-content-between align-items-center">

					</div>
				</div>
			</div>
		</header>
		<!-- End Header Area -->
		<!-- Start Banner Area -->
		<section class="banner-area relative">
			<div class="container">
				<div class="row fullscreen align-items-center justify-content-center">
					<div class="banner-left col-lg-6">
						<img class="d-flex mx-auto img-fluid" src="{{ asset('storage/icon/logo.jpg') }}" alt="">
					</div>
					<div class="col-lg-6">
						<div class="story-content">
							<h6 class="text-uppercase">Mérida</h6>
							<h1>Bienvenidos</h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Banner Area -->
		<!-- Start Video Area -->
		

		<!-- End Video Area -->
		<!-- Start Feature Area -->
<section class="feature-area pt-100 pb-100  relative">
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-6 d-flex align-items-stretch">
						<div class="single-feature">
							<div class="desc">
							<center><h2 class="text-uppercase">{{$entry->title}}</center>  <br></h2>
							<center><h2 class="text-uppercase">{{$entry->synonym}}</center>  <br></h2>
								<p>
									Distribucion: {{$entry->distribution}}
								</p> <br>
								<h4>DESCRIPCION: </h4>
							<h6> <p ALIGN="justify"> 
								{{$entry->description}}
							</p></h6>
							</div>
						</div>
					</div>
					
				<div class="col-lg-6">
						<img class="img-fluid d-flex mx-auto" src="{{ asset('storage/media/'.$entry->image.$entry->imageType) }}" alt="">
					</div>
							
				</div>
			</div>
		</section>
		<!-- Start Feature Area -->
		<!-- Start about Area -->
		
		<!-- End Team Force Area -->
		
		<!-- Start faq Area -->
		
		<!-- Start faq Area -->
		<!-- Start Conatct- Area -->
		
		<!-- End Conatct- Area -->
		<!-- Strat Footer Area -->
		<footer class="section-gap">
			<div class="container">
				<div class="row pt-60">
									
					<div class="col-lg-3 col-sm-6">
						<div class="single-footer-widget">
							<div style="text-align: center">
									<p><strong>Realizado por: Ing. FernandoPoblano</strong></p>
									<p><strong>Flores finas de Teya S.P.R de R.L</strong></p>
									<p><strong>Hacienda Teya, Kanasin, Yucatan, Mexico</strong></p>
									<p><strong>SEMARNAT-UMA-VIV-0163-YUC-09</strong></p>

						</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer Area -->
	</div>
	</body>

</html>