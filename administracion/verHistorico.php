<?php
    //include "../../../includes/mmbox/conexion.inc";

    include "../includes/conexion.inc";
    
    include "../includes/CtrlSession.inc";

 ?>

<!DOCTYPE html>
<html lang="es">

  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MMBox | Panel de control</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
     
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript" src="../js/Funciones.js"></script>

    <link href="../images/penarol.png" rel="icon" type="image/x-icon" />

    <!-- tabla-->
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navbar -->
    <?php
        include "../includes/usrnav.inc";
    ?>

    <div id="wrapper">

      <?php
          include "../includes/usrmenu.inc";
      ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Administrar eventos -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <b>Historico de eventos</b>
            </div>
            <div class="card-body">

              <!-- Filtros -->
              <div class="row">

                  <div class="col-12 " id="filtros">
                      <form action="verHistorico.php" method="GET">

                            <div class="form-row">

                              <div class="form-group col-12 col-md-5 col-lg-4">
                                  <select id="dataEST" class="form-control" name="EST" title="Estado">
                                    <option value="">Estado</option>
                                    <option value="PUBLICADO">Publicado</option>
                                    <option value="PENDIENTE">Pendiente</option>
                                    <option value="AGOTADO">Agotado</option>
                                    <option value="SUSPENDIDO">Suspendido</option>
                                    <option value="PROXIMAMENTE">Proximamente</option>
                                    <option value="DE BAJA">De baja</option>
                                    <option value="EVENTO PASADO">Evento pasado</option>
                                  </select>
                              </div>

                              <div class="form-group col-12 col-md-5 col-lg-4">
                                  <select id="dataCAT" name="CAT" title="Categoria" class="form-control">
                                    <option value="">Categoria</option>
                                    <?php
                                          include "../includes/LoadCategoriasEVENT.inc";
                                     ?>
                                  </select>
                              </div>

                              <div class="form-group col-12 col-md-2">
                                  <input type="submit" value="Filtrar" class="btn btn-primary">
                              </div>

                           </div>
                      </form>
                  </div>

              </div>

              <!-- Tabla -->
              <div class="table-responsive">
                        <table class="table table-hover" id="tblLST" width="100%" cellspacing="0">
                          <thead>
                         <?php
                                //dar DE BAJA a los eventos viejos
                                include "eventofecha.inc";

                               // capturar filtro - estado
                              if (isset($_GET["EST"])) {
                                  $est = $_GET["EST"];
                                 // echo "$est";
                              }else {
                                  $est="";
                                //  echo "$est";
                              }//endif

                             //capturar filtro - categoria
                             if (isset($_GET["CAT"])) {
                                 $cat = $_GET["CAT"];
                                // echo "$cat";
                              }else{
                                  $cat="";
                                 // echo "$cat";
                             }//endif

                              $orden = "startdateEVENT";


                              $filtro=""; //el filtro predeterminado, trae todos los eventos excepto los dados DE BAJA

                              if ($est=="" && $cat=="") {
                                $filtro = "WHERE estEVENT!='DE BAJA'";
                               // echo "Estan los 2 putos vacios";
                              }
                              if ($est!="" && $cat=="") {
                                $filtro = "WHERE estEVENT='$est' AND estEVENT!='DE BAJA' ";
                               // echo "Estado tiene algo y categoria no";
                              }
                              if ($est!="" && $cat!="") {
                                $filtro = "WHERE estEVENT='$est' AND estEVENT!='DE BAJA' AND catEVENT='$cat' ";
                               // echo "Estado tiene algo y categoria tambien";
                              }
                              if ($est=="" && $cat!="") {
                                $filtro = "WHERE catEVENT='$cat' AND estEVENT!='DE BAJA' ";
                               // echo "Estado esta vacio, pero categoria no";
                              }

                              //mostrar los eventos dados DE BAJA
                               if ($est=="DE BAJA" && $cat=="") {
                                $filtro = "WHERE estEVENT='$est'";
                               // echo "Estan los 2 putos vacios";
                              }
                               if ($est=="DE BAJA" && $cat!="") {
                                $filtro = "WHERE estEVENT='$est' AND catEVENT='$cat' ";
                               // echo "Estado tiene algo y categoria tambien";
                              }

                              //armar sql con los filtros para contar el total de registros y poder hacer la paginacion
                              $sql  = "SELECT c.nomCAT,e.idEVENT,e.estEVENT,e.titEVENT,e.startdateEVENT,e.starttimeEVENT,e.autorEVENT ";
                              $sql .= "FROM eventos AS e JOIN categorias AS c ON e.catEVENT=c.idCAT ";
                              $sql .= "$filtro ORDER BY $orden DESC";
                              // ejecutar sentencia SQL
                              //die($sql);
                              $result = mysqli_query($conex,$sql);

                    echo "
                          <tr id='header-tabla'>
                              <th><a class='text-decoration-none' >ESTADO</a></th>
                              <th><a class='text-decoration-none' >EVENTO</a></th>
                              <th><a class='text-decoration-none' >FECHA</a></th>
                              <th><a class='text-decoration-none' >HORA</th>
                              <th><a class='text-decoration-none' >CATEGORÍA</a></th>
                              <th><a class='text-decoration-none' >ULT. MOD.</a></th>
                              <th><a class='text-decoration-none' >OPS</a></th>
                          </tr>
                          </thead>
                          <tbody>
                          ";

                              // recorrer matríz y mostrar noticias
                              while ($regEVENT=mysqli_fetch_array($result)) {
                                  // cargar registro
                                  $id             = $regEVENT["idEVENT"];
                                  $titulo         = $regEVENT["titEVENT"];
                                  $iniciodate     = $regEVENT["startdateEVENT"];
                                  $iniciotime     = $regEVENT["starttimeEVENT"];
                                  $estado         = $regEVENT["estEVENT"];
                                  $categoria      = $regEVENT["nomCAT"];
                                  $autor          = $regEVENT["autorEVENT"];

                                  $iniciohora     = date("H:i",strtotime($iniciotime));
                                  $iniciodate     = date("d/m/Y",strtotime($iniciodate));


                                  //controlar para mostrar

                                      //concatena fecha y hora
                                      $inicio = $iniciodate." ".$iniciohora;
                                          echo "<tr class='filaPAR'>";
                                         //cambiar clase segun al estado
                                      if ($estado=="PUBLICADO") {
                                        $clase="badge badge-primary";
                                      }elseif ($estado=="DE BAJA") {
                                        $clase="badge badge-secondary";
                                      }elseif ($estado=="SUSPENDIDO") {
                                        $clase="badge badge-danger";
                                      }elseif ($estado=="PENDIENTE") {
                                        $clase="badge badge-warning";
                                      }elseif ($estado=="AGOTADO") {
                                        $clase="badge badge-dark";
                                      }elseif ($estado=="PROXIMAMENTE") {
                                        $clase="badge badge-dark";
                                      }else{
                                        $clase="badge badge-primary";
                                      }
                                      echo " <td><span class='$clase'>$estado</span></td>
                                             <td><b>$titulo</b></td>
                                             <td>$iniciodate</td>
                                             <td>$iniciohora</td>
                                             <td class='text-capitalize'>$categoria</td>
                                             <td class='text-capitalize'>$autor</td>
                                             <td class='iconitos'>
                                                 <a href=\"javascript:window.parent.location.href='ProcesoEventosUPD.php?ID=$id' \" data-toggle='tooltip' title='Editar'>
                                                   <i class='fas fa-wrench'></i>
                                                  </a>
                                                  <a href=\"javascript:DeleteREG($id,2)\" data-toggle='tooltip' title='Eliminar'>
                                                   <i class='fas fa-times'></i>
                                                  </a>
                                             </td>
                                            </tr>
                                          ";
                              } // end while
                             // cerrar conexión
                              mysqli_close($conex);
                            ?>
                          </tbody>  
                          </table>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
            include "../includes/usrfooter.inc";
        ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
      $(document).ready( function () { 
        $('#tblLST').DataTable({
          language: {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ productos",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "No se encontraron resultados para el filtro seleccionado",
              "sInfo":           "Mostrando productos del _START_ al _END_ de un total de _TOTAL_ productos",
              "sInfoEmpty":      "Mostrando productos del 0 al 0 de un total de 0 productos",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ productos)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
        });
      } );
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
   


    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <!-- <script src="../vendor/chart.js/Chart.min.js"></script>-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <!-- <script src="../js/demo/chart-area-demo.js"></script>-->

    <script type="text/javascript">
    jQuery(document).ready(function () {
      jQuery('[data-toggle="tooltip"]').tooltip({
        placement:'top'
      });
    });
    </script>

  </body>

</html>
