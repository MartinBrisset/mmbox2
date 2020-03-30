<?php
    // PROCESO ACTUALIZAR EVENTO

    //controlar sesion
    include "../includes/CtrlSession.inc";

    // conectar al Servidor de Base de Datos
    //include "../../includes/mmbox/conexion.inc";

  include "../includes/conexion.inc";


    //captura dato por GET
    $imagen = $_GET["ID"];
    $evento = $_GET["EVENT"];
    //echo "el id es $evento";

    //captura dato de url
    $sql="SELECT * FROM album WHERE idAlbum='$imagen'";

    $resultURL=mysqli_query($conex,$sql);
    //die($sql);
    //borrar imagen
    $regALBUM = mysqli_fetch_array($resultURL);
    $url = $regALBUM["urlALBUM"];

     //unlink("../".$url);
   
    //carga la variable y elimina la imagen
    $sql="DELETE FROM album WHERE idAlbum='$imagen'";
    //ejecutar sentencia
    //die($sql);
    mysqli_query($conex,$sql);
      
    // cerrar conexion
    mysqli_close($conex);

    //vuelva al evento a modificar
    header("Location: ProcesoEventosUPD.php?ID=$evento");


?>
