<?php

	include "../../includes/mmbox2/conexion.inc";

    //include "includes/conexion.inc";

    //capturar dato por GET

       $evento = $_GET["ID"];
       // echo "el id es $evento";

	//hacer consulta a la bbdd y guardar en variables

    //crear sentencia sql
    $sql = "SELECT c.nomCAT,e.idEVENT,e.titEVENT,e.descEVENT,e.startdateEVENT,e.starttimeEVENT,e.enddateEVENT,e.endtimeEVENT,e.estEVENT,e.bannerEVENT,e.salaEVENT,e.nameLinkEVENT1,e.linkEVENT1,e.nameLinkEVENT2,e.linkEVENT2,e.nameLinkEVENT3,e.linkEVENT3,e.namePrecioEVENT1,e.precioEVENT1,e.namePrecioEVENT2,e.precioEVENT2,e.namePrecioEVENT3,e.precioEVENT3,e.namePrecioEVENT4,e.precioEVENT4,e.namePrecioEVENT5,e.precioEVENT5,e.idVideoEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE idEVENT=$evento";
    //die($sql);
    //ejecutar sentencia sql
    $result = mysqli_query($conex,$sql);
    //controlar existencia
    if (mysqli_num_rows($result)==0) {
        // mensaje de error
        header("Location: errorPage.php?MSG=No se pudo cargar el evento seleccionado");
        }else{      // recorrer matríz y mostrar eventos
                $regEVENT=mysqli_fetch_array($result);
                // cargar registro
                $id         		= $regEVENT['idEVENT'];
                $tit        		= $regEVENT['titEVENT'];
                $desc       		= $regEVENT['descEVENT'];
                $iniciodate 		= $regEVENT['startdateEVENT'];
                $iniciotime 		= $regEVENT['starttimeEVENT'];
                $findate    		= $regEVENT['enddateEVENT'];
                $fintime    		= $regEVENT['endtimeEVENT'];
                $estad      		= $regEVENT['estEVENT'];
                $categ      		= $regEVENT['nomCAT'];
                $check              = $regEVENT['bannerEVENT'];
                $salaCheck			= $regEVENT['salaEVENT'];
			    $nameLink1          = $regEVENT['nameLinkEVENT1'];
			    $linkEvento1        = $regEVENT['linkEVENT1'];
			    $nameLink2          = $regEVENT['nameLinkEVENT2'];
			    $linkEvento2        = $regEVENT['linkEVENT2'];
			    $nameLink3          = $regEVENT['nameLinkEVENT3'];
			    $linkEvento3        = $regEVENT['linkEVENT3'];
			    $namePrecioEvento1  = $regEVENT['namePrecioEVENT1'];
			    $precioEvento1      = $regEVENT['precioEVENT1'];
			    $namePrecioEvento2  = $regEVENT['namePrecioEVENT2'];
			    $precioEvento2      = $regEVENT['precioEVENT2'];
			    $namePrecioEvento3  = $regEVENT['namePrecioEVENT3'];
			    $precioEvento3      = $regEVENT['precioEVENT3'];
			    $namePrecioEvento4  = $regEVENT['namePrecioEVENT4'];
			    $precioEvento4      = $regEVENT['precioEVENT4'];
			    $namePrecioEvento5  = $regEVENT['namePrecioEVENT5'];
			    $precioEvento5      = $regEVENT['precioEVENT5'];
			    $idVideo			= $regEVENT['idVideoEVENT'];
                //concatenar fecha y hora para mostrar
                $inicio = $iniciodate." ".$iniciotime;
                $fin    = $findate." ".$fintime;

								//echo "$id,$tit,$desc,$inicio,$fin,$estad,$categ,$check,$nameLink1,$linkEvento1,$nameLink2,$linkEvento2,$nameLink3,$linkEvento3,$namePrecioEvento1,$precioEvento1,$namePrecioEvento2,$precioEvento2,$namePrecioEvento3,$precioEvento3,$namePrecioEvento4,$precioEvento4,$namePrecioEvento5,$precioEvento5";

								//peraparar datos para mostrar
								//separa los datos de la base
								$mes = date("m",strtotime($iniciodate)); //mes en numero
								$dia = date("d",strtotime($iniciodate)); // dia
								$iniciotime = date("H:i",strtotime($iniciotime)) . " HS";

								//convierte el numero del mes en palabra
								if ($mes==1) {
										$mes="ENE";
								}elseif ($mes==2) {
										$mes="FEB";
								}elseif ($mes==3) {
										$mes="MAR";
								}elseif ($mes==4) {
										$mes="ABR";
								}elseif ($mes==5) {
										$mes="MAY";
								}elseif ($mes==6) {
										$mes="JUN";
								}elseif ($mes==7) {
										$mes="JUL";
								}elseif ($mes==8) {
										$mes="AGO";
								}elseif ($mes==9) {
										$mes="SET";
								}elseif ($mes==10) {
										$mes="OCT";
								}elseif ($mes==11) {
										$mes="NOV";
								}else{
										$mes="DIC";
								}//end if

                //cargar la imagen principal
                $sql = "SELECT * FROM imagenes WHERE ideventIMG=$evento AND catIMG='Main'";
                $mainImgResult = mysqli_query($conex,$sql);
                //die($sql);

                if (mysqli_num_rows($mainImgResult)==0) {
                    //echo "No existen imagenes para este evento";
                    $mainImagen = "imagenes/sinimagen.jpg";
                }else{
                    $mainImagenREG = mysqli_fetch_array($mainImgResult);
                    $mainImagen = $mainImagenREG['urlIMG'];
                }

                //cargar la imagen secundaria
                $sql = "SELECT * FROM imagenes WHERE ideventIMG=$evento AND catIMG='Other'";
                $otherImgResult = mysqli_query($conex,$sql);
                //die($sql);

                if (mysqli_num_rows($mainImgResult)==0) {
                    //echo "No existen imagenes para este evento";
                    $otherImagen = "imagenes/sinimagen.jpg";
                }else{
                    $otherImagenREG = mysqli_fetch_array($otherImgResult);
                    $otherImagen = $otherImagenREG['urlIMG'];
                }

              //cargar imagen de la sala a mostrar
                if ($salaCheck=="SALA-1") {
                	$imgSala="images/mapa.png";
                }elseif ($salaCheck=="SALA-2") {
                	$imgSala="images/mapa1.png";
                }elseif ($salaCheck=="SALA-3") {
                	$imgSala="images/mapa2.png";
                }else{
                	$imgSala="images/mapa3.png";
                }

                //echo $imgSala;

            }//Enfid

            $botonBorrar="";

            if ($estad=="AGOTADO") {
            	$botonCompra="ENTRADAS AGOTADAS";
				$claseboton="disabled btn-danger";
            }elseif ($estad=="SUSPENDIDO") {
            	$botonCompra="EVENTO SUSPENDIDO";
				$claseboton="disabled";
            }elseif ($estad=="PROXIMAMENTE") {
            	$botonCompra="";
            	$botonBorrar="borrar";
				$iniciotime="";
				$precioEvento1="";
				$precioEvento2="";
				$precioEvento3="";
				$precioEvento4="";
				$precioEvento5="";
			}elseif ($estad=="PENDIENTE") {
				$botonCompra="NO MOSTRAR";
				$claseboton="disabled";
            }elseif ($estad=="PUBLICADO") {
            	$botonCompra="COMPRAR ENTRADAS";
				$claseboton="dropdown-toggle";
					if ($linkEvento1=="" && $linkEvento2=="" && $linkEvento1=="") {
						$botonCompra="COMPRAR ENTRADAS";
						$claseboton="disabled";}
			}elseif ($estad=="EVENTO PASADO") {
            	$botonCompra="";
            	$botonBorrar="borrar";
				$iniciotime="";
				$precioEvento1="";
				$precioEvento2="";
				$precioEvento3="";
				$precioEvento4="";
				$precioEvento5="";
			}else{
            	$botonCompra="NO MOSTRAR";
            }//endif

            if ($botonCompra=="NO MOSTRAR") {
            	 header("Location: errorPage.php?MSG=Error, persona no cargada");
            }


 ?>

 <!DOCTYPE html>
 <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
 <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
 <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
 <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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

																	<img class='img-fluid d-none d-sm-none d-md-block img-portada' src='<?php echo $mainImagen ?>'>
																	<img class='img-fluid d-block d-md-none img-portada' src='<?php echo $otherImagen ?>'>

															</div>

															<!-- Info -->
															<div class='col-12' id='eventos-destacados'>

																			<div class='row'>


																				<!-- Fecha -->
																				<div class='col-12 col-md-9 d-flex align-items-center'>

																							<div class='fecha-portada'>
																									<div class='dia-evento-inicio'><?php echo $dia ?></div>
																									<div class='mes-evento-inicio'><?php echo $mes ?></div>
																							</div>

																							<div class='divisor'>
																							</div>

                                              <div class=' '>
																									<div class='titulo-evento-inicio' id='titulo'><?php echo $tit ?></div>
																									<div class='hora-evento-inicio' id='hora'><?php echo $iniciotime ?> <span class='badge bg-primary categoria-portada align-middle'><?php echo $categ ?></span></div>
																							</div>

																				</div>


																					<!-- Boton -->
																					<div class='col-12 col-xl-3'>
																							<div class='row align-items-center h-100' id='boton-comprar'>

																								<div class='col-12 padding-0'>
																									<button class='btn btn-comprar align-middle <?php echo $claseboton?>' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
																										<i class='fas fa-ticket-alt'></i><?php echo $botonCompra ?>
																									</button>
																									<?php if ($botonCompra=="COMPRAR ENTRADAS") {
																										echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";

																											//muestra links
																											if ($linkEvento1!="") {
																												echo "<a class='dropdown-item' target='_blank' href='$linkEvento1'>$nameLink1</a>
																												";
																											}//endif
																											if ($linkEvento2!="") {
																												echo "<a class='dropdown-item' target='_blank' href='$linkEvento2'>$nameLink2</a>";
																											}//endif
																											if ($linkEvento3!="") {
																												echo "<a class='dropdown-item' target='_blank' href='$linkEvento3'>$nameLink3</a>";
																											}//endif

																										echo "</div>";

																									} ?>
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

									<?php

									if ($desc!="") {
										echo "
												<!-- Descripción -->
												<div class='row'>

														<div class='col-12' id='descripcion-single'>
															<div class='fondo-negro p-50'>
																<p>
																$desc
																<p>
															</div>
														</div>

												</div>

										 ";
									} ?>

									<?php
									if ($estad=="EVENTO PASADO") {
										//no muestra nada
									}else{

									if ($precioEvento1=="" && $precioEvento2=="" && $precioEvento3=="" && $precioEvento4=="" && $precioEvento5=="") {
										//no hace nada
									}else{ echo "

										 <!-- Mapa y precios -->
										<div class='row fondo-negro' id='mapa-precios'>

													<!-- Mapa -->
													<div class='col-12 col-md-4' id='mapa-sala'>
															<img class='img-fluid' src='$imgSala '/>
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
																			<tbody>";


																					if ($namePrecioEvento1!="") {
																						echo " <tr>
																								<td class='text-left'>$namePrecioEvento1</td>
																								<td class='text-right'>$ $precioEvento1 </td>
																								</tr>

																						";
																					}

																					if ($namePrecioEvento2!="") {
																						echo " <tr>
																								<td class='text-left'>$namePrecioEvento2</td>
																								<td class='text-right'>$ $precioEvento2</td>
																								</tr>

																						";
																					}
																					if ($namePrecioEvento3!="") {
																						echo " <tr>
																								<td class='text-left'>$namePrecioEvento3</td>
																								<td class='text-right'>$ $precioEvento3</td>
																								</tr>

																						";
																					}
																					if ($namePrecioEvento4!="") {
																						echo " <tr>
																								<td class='text-left'>$namePrecioEvento4</td>
																								<td class='text-right'>$ $precioEvento4</td>
																								</tr>

																						";
																					}
																					if ($namePrecioEvento5!="") {
																						echo " <tr>
																								<td class='text-left'>$namePrecioEvento5</td>
																								<td class='text-right'>$ $precioEvento5</td>
																								</tr>

																						";
																					}
																					echo "



																			</tbody>
																	</table>
																</div>
														</div>
													</div>
										</div>

										";}
									}


									?>

							</div>
							<?php

								if ($idVideo!="") {
									echo "
										<div class='col-12' id='video-evento'>
											<iframe width='100%' height='720' src='https://www.youtube.com/embed/$idVideo' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
										</div>

									";
								}//endif

							?>


							<!-- Fotos -->
							<div class="col-12" id="fotos-evento">
								<div class="row">
									<div class="tz-gallery">
											<div class="row">

												<?php

													//verifica si existe un album para mostrar
													//busca en la base
													$sql = "SELECT * FROM album WHERE idEventoALBUM='$evento'";
													//die($sql);

													$result = mysqli_query($conex,$sql);

													if (mysqli_num_rows($result)==0) {
														//no existe album en este evento
														//echo "no tiene album";
													}else{
														//recorrer matriz y mostrar las fotos
														$foto=0; //cuenta la cantidad de imagenes

														while ($regALBUM=mysqli_fetch_array($result)) {
														//cargar registro
														$idFoto 		= $regALBUM['idALBUM'];
														$idEventoAlbum  = $regALBUM['idEventoALBUM'];
														$urlAlbum		= $regALBUM['urlALBUM'];
														$foto++	;

														//muestra imagen en pantalla

														echo "

												<!-- Foto invidual -->
												<div class='col-4 col-md-2'>
														<div class='foto-evento'>
																<a class='lightbox' href='$urlAlbum'>
																	<div style='background: url(\"$urlAlbum\") no-repeat center; background-size: auto 100%;'>
																		<img src='images/cuadrado.png' class='img-evento' style='opacity: 0;'>
																	</div>
																</a>
														</div>
												</div>";

												}//endwile

												}//endif

												// cerrar conexion
												mysqli_close($conex);

												?>

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

		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
