<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>orquideas</title>
 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous"> -->
    <link href="{{ asset('css/fa/css/all.css') }}" rel="stylesheet">

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
  <div id="header">
  <img align="left" src="{{ asset('storage/icon/orquideas.png') }}" height="60px">
  <img align="right" src="{{ asset('storage/icon/orquideas.png') }}" height="60px"><br></br>
  </div>
  <hr>
</body>

<body>
	<title>Orquidea1</title>

	<div class="container" class="row fullscreen d-flex align-items-center justify-content-center" class="banner-content col-lg-4">
					
					
		<h1>
			<!-- Titulo -->	
			<center> {{$entry->title}} <br> </center>
		</h1>
    <br>
		<br>
         <h4> <center> SINÓNIMO: </center> </h4>
				<h3><center> {{$entry->synonym}} </center></h3>
        <br>
				<br>
					<p class="pt-20 pb-20">

					<!-- Informacion de la distribucion -->
          <h4> <center>  DISTRIBUCIÓN: </center> </h4>

						<div><center> {{$entry->distribution}} </center></div><br>

						<!-- Fin de la informacion de la distribucion  -->

					</p>

						<div class="container">

								<div>
									<center>
								<!-- imagen -->

								<img src="{{ asset('storage/media/'.$entry->image.$entry->imageType) }}" width="509px" height="382">
									
								<!-- fin de la imagen -->
									</center>
								</div>

							<div class="container">
								<br>
								<br>
								<br>
							<h4> <center>  DESCRIPCIÓN: </center> </h4>
									
								<p ALIGN="justify">	
								<!-- Texto descriptivo -->

								<center> {{$entry->description}} </center> 	

								<!-- Fin de texto descriptivo -->
								</p>
                
								<br>
								<br>

								<div style="text-align: center">
										<p><strong>Realizado por: Ing. FernandoPoblano</strong></p>
										<p><strong>Flores finas de Teya S.P.R de R.L</strong></p>
										<p><strong>Hacienda Teya, Kanasin, Yucatan, Mexico</strong></p>
										<p><strong>SEMARNAT-UMA-VIV-0163-YUC-09</strong></p>
								</div>	

						</div>
</body>	

</html>