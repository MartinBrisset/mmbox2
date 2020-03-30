<?php

	include "../../includes/mmbox2/conexion.inc";

    //include "includes/conexion.inc";

?>

 <!DOCTYPE html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Montevideo Music Box</title>
   <meta name="keywords" content="montevideo, music, box, mmbox, lachina, rock, sala, concierto">
   <meta  name="description" content="Montevideo Music Box">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/estilo.css">

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

   <!-- styles for video player -->
   <link rel="stylesheet" href="source/style.css">

	 <link href="images/favicon.png" rel="icon" type="image/x-icon" />

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

	 <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139453533-4"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-139453533-4');
	</script>


 </head>


<body>

	<div class="loader-page"></div>

	<!-- Video -->
	<div id="background-video" class="background-video d-md-block d-none">
		<img src="images/placeholder.jpg" alt="" class="placeholder-image">
	</div>

	<!-- Filtro -->
	<div class="hola">
	</div>

    <!-- Contenedor -->
    <div class="container" id="contenedor">

			<!-- menu pc -->
			<nav class="navbar navbar-expand-lg navbar-dark d-lg-flex d-none" id="navbar">
			  <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="100" alt=""></a>

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">

			    <ul class="navbar-nav ml-auto" id="menu">
			        <li class="nav-item">
			          <a class="" href="index.php">Inicio <span class="sr-only">(current)</span></a>
			        </li>
			        <li class="nav-item">
			          <a class="" href="lasala.php">La sala</a>
			        </li>
			        <li class="nav-item">
			          <a class="" href="contacto.php">Contacto</a>
			        </li>
			    </ul>

			    <a href="https://www.facebook.com/Montevideo-Music-Box-1599179113642591/" target="_blank"><i class="fab fa-facebook-f social"></i></a>
			    <a href="https://twitter.com/MMusicBox/" target="_blank"><i class="fab fa-twitter social"></i></a>
			    <a href="https://www.instagram.com/montevideomusicbox/" target="_blank"><i class="fab fa-instagram social"></i></a>

			  </div>
			</nav>


			<!-- menu celular -->
			<nav class="navbar d-flex d-lg-none" id="navbar-celular">

			    <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="100" alt=""></a>

			    <button type="button" class="btn bg-transparent text-white" data-toggle="modal" data-target=".bd-example-modal-sm" id="btn-menu"><i class="fas fa-bars"></i></button>

			    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="menu-modal">
			      <div class="modal-dialog  modal-sm">
			        <div class="modal-content">


			            <div class="modal-header text-center">
			              <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrar-boton">
			                <span aria-hidden="true">&times;</span>
			              </button>
			            </div>

			            <div class="modal-body text-center">

			              <ul class="navbar-nav" id="nav-celular">
			                  <li class="">
			                    <a class="" href="index.php">Inicio <span class="sr-only">(current)</span></a>
			                  </li>
			                  <li class="">
			                    <a class="" href="lasala.php">La sala</a>
			                  </li>
			                  <li class="">
			                    <a class="" href="contacto.php">Contacto</a>
			                  </li>
			              </ul>

			              <a href="https://www.facebook.com/Montevideo-Music-Box-1599179113642591/" target="_blank"><i class="fab fa-facebook-f social"></i></a>
			              <a href="https://twitter.com/MMusicBox/" target="_blank"><i class="fab fa-twitter social"></i></a>
			              <a href="https://www.instagram.com/montevideomusicbox/" target="_blank"><i class="fab fa-instagram social"></i></a>

			            </div>
			        </div>
			      </div>
			    </div>

			</nav>


			<!-- Inicio esctructura -->
			<div class="row">

					<!-- Carousel -->

							 <div id='carousel-1' class='carousel-evento slide carousel-fade' data-ride='carousel'>

										<div class='carousel-inner'>



												<!-- Item 1 -->
												<div class='carousel-item active'>
													<div class='row margen-0'>

														<!-- Imagen -->
															<div class='col-12' id='portada'>

																	<div class='degradado-portada'></div>

																	<img class='img-fluid d-none d-sm-none d-md-block' src='imagenes/ejemplo1.jpg'>
																	<img class='img-fluid d-block d-md-none' src='imagenes/ejemplo2.jpg'>

															</div>

															<!-- Info -->
															<div class='col-12' id='eventos-destacados'>

																			<div class='row'>


																				<!-- Fecha -->
																				<div class='col-12 col-md-9 d-flex align-items-center'>

																							<div class='fecha-portada'>
																									<div class='dia-evento-inicio'>30</div>
																									<div class='mes-evento-inicio'>MAR</div>
																							</div>

																							<div class='divisor'>
																							</div>

                                              												<div class=' '>
																									<div class='titulo-evento-inicio' id='titulo'>Título del evento - Artistas, etc</div>
																									<div class='hora-evento-inicio' id='hora'>23:50 HS<span class='badge bg-primary categoria-portada align-middle'>ROCK</span></div>
																							</div>

																				</div>


																					<!-- Boton -->
																					<div class='col-12 col-xl-3'>
																							<div class='row align-items-center h-100' id='boton-comprar'>

																								<div class='col-12 padding-0'>
																									<button class='btn btn-comprar align-middle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
																										<i class='fas fa-ticket-alt'></i>COMPRAR ENTRADAS
																									</button>
																									<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
																										<a class='dropdown-item' target='_blank' href='www.montevideomusicbox.com.uy'>Abitab</a>
																											<a class='dropdown-item' target='_blank' href='www.montevideomusicbox.com.uy'>Link de Venta 2</a>
																											<a class='dropdown-item' target='_blank' href='www.montevideomusicbox.com.uy'>Link de venta 3</a>
																									</div>

																								
																								</div>


																							</div>
																					</div>

																			</div><!-- fin row-->
															</div>
													</div>
												</div>

										</div>


							</div>



					<!-- Informacion evento -->
					<div class="col-12">
						<div class="row" id="info-single">
							<div class="col-12">

												<!-- Descripción -->
												<div class='row'>

														<div class='col-12' id='descripcion-single'>
															<div class='fondo-negro p-50'>
																<p>
																<p>Podes escribir <strong>LO QUE QUIERAS</strong></p>
																<P>Podes usar #hastags</P>
																<p><a href="google.com">#HastagsConLinks</a></p>
																<p><a href="google.com">Links normales</a></p>
																<p>Este viernes te esperamos para enamorarte del potro en <a href="https://www.instagram.com/explore/tags/lachina/">#LaChina</a>
																</p>
																<p><a href="https://www.instagram.com/explore/tags/openmind/">#VeniAEnamorarte</a></p>
																<p><a href="https://www.instagram.com/explore/tags/openmind/">#OpenMind</a>
																<br />
																<a href="https://www.instagram.com/explore/tags/losviernesnosenegocian/">#LosViernesNoSeNegocian</a></p>
																<p>(+598) 092 668 377</p>
																<p>
															</div>
														</div>

												</div>

										 <!-- Mapa y precios -->
										<div class='row fondo-negro' id='mapa-precios'>

													<!-- Mapa -->
													<div class='col-12 col-md-4' id='mapa-sala'>
															<img class='img-fluid' src='images/mapa1.png '/>
													</div>

													<!-- Precios -->
													<div class='col-12 col-md-8' id='precios'>
														<div class='row align-items-center h-100'>
																<div class='col-12 mx-auto'>
																	<table class='table'>
																			<thead>
																				<tr>
																					<th scope='col'>Sector</th>
																					<th scope='col' class='text-right'>Precio</th>
																				</tr>
																			</thead>
																			<tbody>
																			    <tr>
																				<td class='text-left'>Generales</td>
																				<td class='text-right'>$ 3.000</td>
																				</tr>
																			    <tr>
																				<td class='text-left'>Plateas</td>
																				<td class='text-right'>$ 2.350</td>
																				</tr>
																				<tr>
																				<td class='text-left'>VIP</td>
																				<td class='text-right'>$ 400</td>
																				</tr>
																				<tr>
																				<td class='text-left'>Anticipadas</td>
																				<td class='text-right'>$ 10.250</td>
																				</tr>
																				<tr>
																				<td class='text-left'>M y G</td>
																				<td class='text-right'>$ 400</td>
																				</tr>
																			</tbody>
																	</table>
																</div>
														</div>
													</div>
										</div>
							</div>
										<div class='col-12' id='video-evento'>
											<iframe width='100%' height='720' src='https://www.youtube.com/embed/$idVideo' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
										</div>

							<!-- Fotos -->
							<div class="col-12" id="fotos-evento">
								<div class="row">
									<div class="tz-gallery">
											<div class="row">

											<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_4_imagen5.png'>
																	<div style='background: url("albumes/35_4_imagen5.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>

											<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_1_imagen2.png'>
																	<div style='background: url("albumes/35_1_imagen2.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_2_imagen3.png'>
																	<div style='background: url("albumes/35_2_imagen3.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_3_imagen4.png'>
																	<div style='background: url("albumes/35_3_imagen4.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_4_imagen5.png'>
																	<div style='background: url("albumes/35_4_imagen5.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_4_imagen5.png'>
																	<div style='background: url("albumes/35_4_imagen5.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_1_imagen2.png'>
																	<div style='background: url("albumes/35_1_imagen2.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_2_imagen3.png'>
																	<div style='background: url("albumes/35_2_imagen3.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='albumes/35_3_imagen4.png'>
																	<div style='background: url("albumes/35_3_imagen4.png") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>
												
											</div>

									</div>

								</div>
							</div>

						</div>
					</div>



					<!-- Footer -->
					<?php include "includes/footer.inc"; ?>

			</div> <!-- fin row -->
    </div> <!-- fin contenedor -->


		<!-- Scripts -->

		  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(window).on('load', function () {
				 // setTimeout(function () {
				$(".loader-page").css({visibility:"hidden",opacity:"0"})
			//}, 2000);

		});
		</script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>

<script>
					baguetteBox.run('.tz-gallery');
</script>

			<?php
						if ($botonBorrar=="borrar") {

								echo "
								<script>
									//ocultar boton si es un evento pasado
									$('#boton-comprar').remove();
								</script>
								";
						}
							//echo "$botonBorrar";

				//comprueba que tenga un video
				if ($idVideo!="") {
					echo "
						<!-- ADD Jquery Video Background -->
					  <script src='source/jquery.youtubebackground.js'></script>
					  <script>
					    jQuery(function($) {

					      $('#background-video').YTPlayer({
					        fitToBackground: true,
					        videoId: '$idVideo',
					        pauseOnScroll: false,
					        mute: true,
					        callback: function() {
					          videoCallbackEvents();
					        }
					      });

					      var videoCallbackEvents = function() {
					        var player = $('#background-video').data('ytPlayer').player;

					        player.addEventListener('onStateChange', function(event){
					            console.log('Player State Change', event);

					            // OnStateChange Data
					            if (event.data === 0) {
					                console.log('video ended');
					            }
					            else if (event.data === 2) {
					              console.log('paused');
					            }
					        });
					      }
					    });
					  </script>
					";
				};

			?>

		</body>
		</html>
