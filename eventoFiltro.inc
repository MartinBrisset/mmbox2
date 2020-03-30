<?php

	include "../../includes/mmbox2/conexion.inc";

    //include "includes/conexion.inc";

	 //CAMBIA EL ESTADO DE LOS EVENTOS SI EXISTE ALGUNO PENDIENTE

   //pedir datos al servidor

   $sql = "SELECT * FROM eventos WHERE estEVENT='PENDIENTE'";
    // ejecutar sentencia SQL
    //die($sql);
    $result = mysqli_query($conex,$sql);

    //buscar resultados
    if (mysqli_num_rows($result)) {
    	//cargar registro
    	while ($regEVENT=mysqli_fetch_array($result)) {
    		//mientras tenga resultados lo guardo en variables
    		$id             = $regEVENT["idEVENT"];
    		$estado         = $regEVENT["estEVENT"];

    		//echo "$estado,$id";

    		//crear sentencia sql para darle de baja a todos los eventos viejos
        if ($estado!="PENDIENTE") {
            $sql = "UPDATE eventos SET estEVENT='PENDIENTE',bannerEVENT='NO-VISIBLE' WHERE idEVENT='$id'";
        }

    		//ejecturar sentencia
		    //die($sql);
		    mysqli_query($conex,$sql);
    	}//endwile
    }//endif
?>
