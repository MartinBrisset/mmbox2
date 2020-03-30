<?php
     // conectar al Servidor de Base de Datos
    include "../../includes/mmbox2/conexion.inc";

    //include "includes/conexion.inc";

     //captura fecha y ahora actual
     date_default_timezone_set("America/Argentina/Buenos_Aires");
     //$fechahora = date('Y-m-d H:i:s');
       $fecha = date('Y-m-d');
       //echo "$fecha";

    //mostrar todos los eventos siguientes
     $sql  = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT ";
     $sql .= "FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT ";
     $sql .= "WHERE estEVENT='EVENTO PASADO' AND startdateEVENT>=$fecha ORDER BY startdateEVENT DESC LIMIT 6"; //Ordena los eventos para mostrar, del mas reciente al menos reciente. solo los primeros 5
     // ejecutar sentencia SQL
     //die($sql);
     $result = mysqli_query($conex,$sql);
     // controlar existencia de datos
     if (mysqli_num_rows($result)==0) {
         die("todavía no existen eventos o no hay evento para el filtro seleccionado");
     } // endif
     // recorrer matríz y mostrar eventos
     $fila = 1;
     while ($regEVENT=mysqli_fetch_array($result)) {
         // cargar registro
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
         $idget = "evento.php?ID=".$id."&".$titulo;

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

         echo "

                <div class='col-12 col-md-4 col-lg-4 col-xl-2 cosopum'>
                        <a href='$idget'>
                          <div class='degradado-ultimoseventos'>

                            <div class='texto'>



                                <div class='cabeza'>
                                  <div class='row'>

                                      <div class='col-4 fecha'>
                                        <div class='dia'>$dia</div>
                                        <div class='mes'>$mes</div>
                                      </div>

                                      <div class='col-8 categoria'>
                                        <div class='badge bg-primary categoria-ultimos-eventos'>$categ</div>
                                      </div>

                                  </div>
                                </div>


                                <div class='titulo'>
                                  $titulo
                                </div>

                              </div>

                            <img src='$otherImagen' class='img-fluid img-cosopum'/>

                          </div>
                        </a>
                </div>
                  ";
                $fila++;
            } // end while
            // cerrar conexión
            mysqli_close($conex);
       ?>
