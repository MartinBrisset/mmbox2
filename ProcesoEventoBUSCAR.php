<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Montevideo Music Box</title>
  <meta name="keywords" content="montevideo, music, box, mmbox, lachina, rock, sala, concierto">
  <meta  name="description" content="Montevideo Music Box">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="js/Funciones.js"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">
  <link href="images/favicon.png" rel="icon" type="image/x-icon" />

  <!-- styles for video player -->
  <link rel="stylesheet" href="source/style.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139453533-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-139453533-4');
</script>

</head>


<!-- CONECTAR BASE -->
<?php
    include "../../includes/mmbox2/conexion.inc";

    //include "includes/conexion.inc";

    include "eventoFiltro.inc";
?>
<!--PIDE DATOS A LA BASE-->
<?php
    //crear sentencia sql
    $sql = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE bannerEVENT='destacado' LIMIT 10";
    //ejecutar sql
    $result = mysqli_query($conex,$sql);
    //die($sql);

    //busca el id del video de fondo en la base
      $sql2 = "SELECT * FROM metadatos WHERE idDato='1'";

      //die($sql2);

      $result2=mysqli_query($conex,$sql2);

      while ($regDato=mysqli_fetch_array($result2)) {
        $idVideo = $regDato["dato"];
      }
?>

<body>
    <!-- Loader -->
    <div class="loader-pagEEe"></div>

    <!-- Video -->
    <div id="player" class="background-video d-md-block d-none">
      <img src="images/placeholder.jpg" alt="" class="placeholder-image">
    </div>

    <!-- Filtro -->
    <div class="hola" id="filtro-video">
    </div>

    <!-- Botonera -->
    <div class="botonera-video d-none d-md-block">
      <button class="boton-botonera-video pauseplay degradado-nuevo" type="button"  aria-expanded="true" id="pauseplay">
        <i class="fas fa-pause"></i>
      </button>
      <br>
      <button class="boton-botonera-video degradado-nuevo" type="button" aria-expanded="true" id="botonMute">
        <i class="fas fa-volume-off"></i>
      </button>
      <br>
      <button class="boton-botonera-video degradado-nuevo" type="button" data-toggle="collapse" data-target="#contenedor" aria-expanded="true" aria-controls="contenedor" id="expandircontraer">
        <i class="fas fa-expand"></i>
      </button>
    </div>

    <!-- Contenedor -->
    <div class="container collapse show" id="contenedor">

        <!-- Menu -->
        <?php
            include "includes/menugral.inc";
        ?>

        <!-- Inicio esctructura -->
        <div class="row">

          <!-- Carousel -->
          <div id="carousel-1" class="carousel slide carousel-fade" data-ride="carousel">

                <div class="carousel-inner">

                  <?php //controlar existencia de resultados
                        if (mysqli_num_rows($result)==0) {
                          //echo "no anda o no hay registros";
                          }else{
                            // recorrer matríz y mostrar eventos
                              $e = 0; //cuenta la cantidad de eventos
                              while ($regEVENT=mysqli_fetch_array($result)) {
                                  // cargar registro
                                  $id         = $regEVENT["idEVENT"];
                                  $tit        = $regEVENT["titEVENT"];
                                  $iniciodate = $regEVENT["startdateEVENT"];
                                  $iniciotime = $regEVENT["starttimeEVENT"];
                                  $fintime    = $regEVENT["starttimeEVENT"];
                                  $estad      = $regEVENT["estEVENT"];
                                  $categ      = $regEVENT["nomCAT"];
                                  $e++;

                                  //echo "$e";

                                  //peraparar datos para mostrar
                                  //separa los datos de la base
                                  $mes = date("m",strtotime($iniciodate)); //mes en numero
                                  $dia = date("d",strtotime($iniciodate)); // dia
                                  $iniciotime = date("H:i",strtotime($iniciotime));
                                  $idget = "evento.php?ID=".$id."&".$tit;

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
                                  $sql = "SELECT * FROM imagenes WHERE ideventIMG=$id AND catIMG='Main'";
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
                                  $sql1 = "SELECT * FROM imagenes WHERE ideventIMG=$id AND catIMG='Other'";
                                  $otherImgResult = mysqli_query($conex,$sql1);
                                  //die($sql1);

                                  if (mysqli_num_rows($otherImgResult)==0) {
                                      //echo "No existen imagenes para este evento";
                                      $otherImagen = "imagenes/sinimagen.jpg";
                                  }else{
                                      $otherImagenREG = mysqli_fetch_array($otherImgResult);
                                      $otherImagen = $otherImagenREG['urlIMG'];
                                  }

                                  if ($e==1) {
                                    echo "
                <div  class='carousel slide carousel-fade' data-ride='carousel'>

                <div class='carousel-inner'>

                    <!-- Item 1 -->
                    <div class='carousel-item active'>
                      <div class='row margen-0'>

                          <!-- Imagen -->
                          <div class='col-12' id='portada'>

                              <a class='carousel-control-prev ' href='#carousel-1' role='button' data-slide='prev'>
                                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                  <span class='sr-only'>Previous</span>
                              </a>

                              <a class='carousel-control-next' href='#carousel-1' role='button' data-slide='next'>
                                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                  <span class='sr-only'>Next</span>
                              </a>

                              <div class='degradado-portada'></div>

                              <img class='img-fluid d-none d-sm-none d-md-block img-portada' src='$mainImagen'/>
                              <img class='img-fluid d-block d-md-none img-portada' src='$otherImagen'/>

                          </div>

                          <!-- Info -->
                          <div class='col-12' id='eventos-destacados'>

                                  <div class='row'>

                                      <!-- Fecha -->
                                      <div class='col-12 col-md-9 d-flex align-items-center'>

                                            <div class='fecha-portada'>
                                                <div class='dia-evento-inicio'>$dia</div>
                                                <div class='mes-evento-inicio'>$mes</div>
                                            </div>

                                            <div class='divisor'>
                                            </div>

                                            <div class=''>
                                                <div class='titulo-evento-inicio' id='titulo'>$tit</div>
                                                <div class='hora-evento-inicio' id='hora'>$iniciotime HS <span class='badge bg-primary categoria-portada align-middle'>$categ</span></div>
                                            </div>

                                      </div>

                                      <!-- Boton -->
                                        <a href='$idget'class='col-12 col-xl-3'>
                                          <div class='row align-items-center h-100' id='boton-comprar'>
                                            <button class='col-12 btn btn-comprar align-middle'>
                                            <i class='fas fa-ticket-alt'></i> COMPRAR ENTRADA
                                            </button>
                                          </div>
                                        </a>

                                  </div>
                          </div>
                      </div>
                    </div>
            ";
                  }else {
                    echo "

                    <!-- Item 1 -->
                    <div class='carousel-item'>
                      <div class='row margen-0'>

                          <!-- Imagen -->
                          <div class='col-12' id='portada'>

                              <a class='carousel-control-prev ' href='#carousel-1' role='button' data-slide='prev'>
                                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                  <span class='sr-only'>Previous</span>
                              </a>

                              <a class='carousel-control-next' href='#carousel-1' role='button' data-slide='next'>
                                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                  <span class='sr-only'>Next</span>
                              </a>

                              <div class='degradado-portada'></div>

                              <img class='img-fluid d-none d-sm-none d-md-block img-portada' src='$mainImagen'/>
                              <img class='img-fluid d-block d-md-none img-portada' src='$otherImagen'/>

                          </div>

                          <!-- Info -->
                          <div class='col-12 ' id='eventos-destacados'>

                                  <div class='row'>

                                      <!-- Fecha -->
                                      <div class='col-12 col-md-9 d-flex align-items-center'>

                                            <div class='fecha-portada'>

                                                <div class='dia-evento-inicio'>$dia</div>
                                                <div class='mes-evento-inicio'>$mes</div>
                                            </div>

                                            <div class='divisor'>
                                            </div>

                                            <div class=' '>
                                                <div class='titulo-evento-inicio' id='titulo'>$tit</div>
                                                <div class='hora-evento-inicio' id='hora'>$iniciotime HS <span class='badge bg-primary categoria-portada align-middle'>$categ</span></div>

                                            </div>

                                      </div>

                                      <!-- Boton -->
                                        <a href='$idget'class='col-12 col-xl-3'>
                                          <div class='row align-items-center h-100' id='boton-comprar'>
                                            <button class='col-12 btn btn-comprar align-middle'>
                                            <i class='fas fa-ticket-alt'></i> COMPRAR ENTRADA
                                            </button>
                                          </div>
                                        </a>

                                  </div>
                          </div>
                      </div>
                    </div>

                 ";
                   }
                }

              } ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12" >
              <div class="row" id="contenedor-eventos">

                <!-- Sidebar -->
                <div class="col-12 col-lg-12 col-xl-3" id="sidebar">
                  <div class="row">
                    <div class="col-12 degradado-nuevo" id="calendario">
                      <div class="row">

                          <!-- Calendario -->
                          <div class="col-12 col-md-6 col-xl-12  p-lg-3 p-xl-1">
                              <?php include "calendario.php"; ?>
                          </div>

                          <!-- Buscador -->
                          <div class="col-12 col-md-6 col-xl-12" id="buscador">

                              <div class="row align-items-center h-100">
                                  <div class="col-12 mx-auto">
                                    <form id="dataFRM" action="ProcesoEventoBUSCAR.php" method="POST">
                                    <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Nombre" id="dataBUSCAR" name="BUSCAR">
                                    </div>

                                    <div class="form-group">
                                      <select class="form-control" id="dataCAT" name="CAT">
                                        <option class="font-weight-normal" selected>Categoría</option>
                                        <?php include "includes/LoadCategoriasEVENT.inc" ?>
                                      </select>
                                    </div>

                                    <button type="button" class="btn btn-buscar col-12" onclick="CheckEventBuscar();">Buscar</button>

                                </form>
                                  </div>
                              </div>

                          </div>


                      </div>
                    </div>
                  </div>
                </div>

                <!-- Eventos -->
                <div class="col-12 col-lg-12 col-xl-9" id="columna-eventos">
                  <div class="row">

                    <?php
                    //PROCESO BUSCAR EVENTOS

                    //capturar datos del formulario
                    $categoriaEvento = $_POST["CAT"];
                    $palabraBuscada  = $_POST["BUSCAR"];

                    //echo $categoriaEvento,$palabraBuscada;

                    //captura fecha y ahora actual
                    date_default_timezone_set("America/Argentina/Buenos_Aires");
                    //$fechahora = date('Y-m-d H:i:s');
                      $fecha = date('Y-m-d');
                      //echo "$fecha";

                    //crear filtros

                    if ($categoriaEvento=="Categoría" && $palabraBuscada=="") {
                      $categoriaEvento="";
                      //muesta todos los eventos siguientes
                      //echo "no hay filtros";
                      //crea la sentencia sql
                      $sql = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE (estEVENT='PUBLICADO' OR estEVENT='SUSPENDIDO' OR estEVENT='AGOTADO' OR estEVENT='PROXIMAMENTE' OR estEVENT='EVENTO PASADO') ORDER BY startdateEVENT ASC";
                      //die($sql);
                    }elseif ($categoriaEvento!="Categoría" && $palabraBuscada!="") {
                      //echo "Seleccionaron una categoria y una palabra";
                      //crea la sentencia sql
                      $sql = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE (estEVENT='PUBLICADO' OR estEVENT='SUSPENDIDO' OR estEVENT='AGOTADO' OR estEVENT='PROXIMAMENTE' OR estEVENT='EVENTO PASADO') AND catEVENT='$categoriaEvento' AND titEVENT LIKE '%$palabraBuscada%' OR descEVENT='%$palabraBuscada%' ORDER BY startdateEVENT AND starttimeEVENT ASC";
                      //die($sql);
                    }elseif ($categoriaEvento!="Categoría" && $palabraBuscada=="") {
                      //echo "solo selecciono categoria";
                      //crea la sentencia sql
                      $sql = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE (estEVENT='PUBLICADO' OR estEVENT='SUSPENDIDO' OR estEVENT='AGOTADO' OR estEVENT='PROXIMAMENTE' OR estEVENT='EVENTO PASADO') AND catEVENT='$categoriaEvento'  ORDER BY startdateEVENT ASC";
                        //die($sql);
                    }else{
                      //echo "Solo busco por la palabra";
                      //crea la sentencia sql
                      $sql = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT WHERE (estEVENT='PUBLICADO' OR estEVENT='SUSPENDIDO' OR estEVENT='AGOTADO' OR estEVENT='PROXIMAMENTE' OR estEVENT='EVENTO PASADO') AND titEVENT LIKE '%$palabraBuscada%' OR descEVENT='%$palabraBuscada%' ORDER BY startdateEVENT ASC";
                      //die($sql);
                    }//endif
                    include "includes/conexion.inc";
//die($sql);
//var_dump($sql);
//echo $conex;
//var_dump($conex);
                    //ejecutar sentencia sql
                    $result=mysqli_query($conex,$sql);
                    //controlar existencia de datos
                    if (mysqli_num_rows($result)==0) {
                      //Si no existen eventos para ese filtro muestra TODOS los eventos con el filtro previo
                      echo "<div class='col-12 alert alert-dismissible fade show cartel-busqueda' role='alert'>
                        No encontramos eventos para el filtro seleccionado.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                            <div></div>";
                      include "muestraeventos.inc";
                    }else{
                      //recorrer matriz y mostrar eventos
                      $e=1;
                      echo "<div class='col-12 alert alert-dismissible fade show cartel-busqueda' role='alert'>
                        Resultados de su búsqueda.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                            <div></div>";
                      while ($regEVENT=mysqli_fetch_array($result)) {
                        //cargar registro
                              $id             = $regEVENT["idEVENT"];
                              $titulo         = $regEVENT["titEVENT"];
                              $iniciodate     = $regEVENT["startdateEVENT"];
                              $iniciotime     = $regEVENT["starttimeEVENT"];
                              $categ          = $regEVENT["nomCAT"];

                              //peraparar datos para mostrar
                              //separa los datos de la base
                              $mes = date("m",strtotime($iniciodate)); //mes en numero
                              $dia = date("d",strtotime($iniciodate)); // dia
                              $iniciotime = date("H:i",strtotime($iniciotime));
                              $idget = "evento.php?ID=".$id;

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

                              $e++;

                              echo "
                              <div class='col-12 col-sm-6 col-lg-3 cosopum'>
                                      <a href='$idget'>
                                        <div class='degradado-nuevo evento-cuadrado'>

                                          <i class='fas fa-ticket-alt ticket'></i>

                                          <div class='texto'>



                                              <div class='cabeza'>
                                                <div class='row'>

                                                    <div class='col-6 fecha'>
                                                      <div class='dia'>$dia</div>
                                                      <div class='mes'>$mes</div>
                                                    </div>

                                                    <div class='col-6 categoria'>
                                                      <div class='badge bg-primary categoria-badge'>$categ</div>
                                                    </div>

                                                </div>
                                              </div>

                                              <div class='hora'>
                                                $iniciotime HS
                                              </div>

                                              <div class='titulo'>
                                                $titulo
                                              </div>

                                            </div>

                                          <img src='$otherImagen' class='img-fluid img-cosopum'/>

                                          <div class='degradado-img-cosopum'></div>

                                        </div>
                                      </a>
                              </div>


                              ";
                          } // end while
                      }


                    ?>

                  </div>
                </div>

              </div>
          </div>

          <!-- Últimos Eventos -->
          <div class="col-12" id="ultimos-eventos">
            <div class="row" id="contenedor-ultimos-eventos">

              <div class="col-12">
                <h4>Últimos eventos</h4>
              </div>

              <?php include "ultimoseventos.inc"; ?>

            </div>
          </div>

          <!-- Footer -->
          <?php include "includes/footer.inc"; ?>


        </div> <!-- fin row -->
    </div> <!-- fin container -->

 <!-- Scripts -->
    <script type="text/javascript">
      $(window).on('load', function () {
         // setTimeout(function () {
        $(".loader-page").css({visibility:"hidden",opacity:"0"})
      //}, 2000);

    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <!-- ADD Jquery Video Background -->
         <!-- ADD Jquery Video Background -->
      <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
      <script>

       // $(document).ready(function(){

                        var tag = document.createElement('script');

                        tag.src = "https://www.youtube.com/iframe_api";
                        var firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                        // 3. This function creates an <iframe> (and YouTube player)
                        /*var videoId = [
                                            {'videoId': 'RBumgq5yVrA', 'startSeconds': 515, 'endSeconds': 690, 'suggestedQuality': 'hd720'},
                                            {'videoId': 'RBumgq5yVrA', 'startSeconds': 465, 'endSeconds': 657, 'suggestedQuality': 'hd720'},
                                            {'videoId': 'RBumgq5yVrA', 'startSeconds': 0, 'endSeconds': 240, 'suggestedQuality': 'hd720'},
                                            {'videoId': 'RBumgq5yVrA', 'startSeconds': 19, 'endSeconds': 241, 'suggestedQuality': 'hd720'}
                                        ]
                        */
                        //    after the API code downloads.
                        var player;
                        function onYouTubeIframeAPIReady() {
                          player = new YT.Player('player', {
                            height: '100%',
                            width: '100%',
                            videoId: '<?php echo $idVideo ?>',
                            playerVars: {
                              'autoplay': 1,
                              'controls': 0,
                              'playlist': '<?php echo $idVideo ?>',
                              'loop': 1
                            },
                            events: {
                              'onReady': onPlayerReady,
                              'onStateChange': onPlayerStateChange
                            }
                          });
                        }

                        // 4. The API will call this function when the video player is ready.
                        function onPlayerReady(event) {
                          event.target.playVideo();
                          player.mute();
                        }

                        // 5. The API calls this function when the player's state changes.
                        //    The function indicates that when playing a video (state=1),
                        var done = false;
                        function onPlayerStateChange(event) {
                          if (event.data == YT.PlayerState.PLAYING && !done) {
                            done = true;
                          }
                        }

                        function vidRescale(){

                          var w = $(window).width()+200,
                            h = $(window).height()+200;

                          if (w/h > 16/9){
                            player.setSize(w, w/16*9);
                            $('.player .screen').css({'left': '0px'});
                          } else {
                            player.setSize(h/9*16, h);
                            $('.player .screen').css({'left': -($('.player .screen').outerWidth()-w)/2});
                          }
                        }

                        $(window).on('load resize', function(){
                          vidRescale();
                        });

                  function playVid(){
                      player.playVideo();
                  }

                  function pauseVid(){
                      player.pauseVideo();
                  }

                  function muteVid(){
                      player.mute();
                  }

                  function muteOffVid(){
                      player.unMute();
                  }


              $('#expandircontraer').on('click', function() {
                var $el = $(this),
                  textNode = this.lastChild;
                $el.find('i').toggleClass(' fa-expand fa-compress');
                document.getElementById('filtro-video').classList.toggle('hola');
              });

                var pauseplay = 0;

                $('#pauseplay').on('click', function() {
                  var $el = $(this),
                    textNode = this.lastChild;

                    if (pauseplay % 2 == 0){
                    pauseVid();
                    console.log("pausa");
                    }

                    if (pauseplay % 2 != 0){
                      console.log("play");
                    playVid();
                    }

                    pauseplay++;

                  $el.find('i').toggleClass(' fa-pause fa-play');
                });


                    var mute = 0;

                    console.log("boton mute");

                $('#botonMute').on('click', function() {
                  var $el = $(this),
                    textNode = this.lastChild;


                    if (mute % 2 == 0){
                    muteOffVid();
                    console.log("mute on");
                    }

                    if (mute % 2 != 0){
                      console.log("mute off");
                    muteVid();
                    }

                    mute++;


                    //console.log("anda");
                  $el.find('i').toggleClass(' fa-volume-down fa-volume-off');
                });

      //  }); //end jquery


</script>
</body>
</html>
