<?php 

	include "../includes/CtrlSession.inc";

	//include "../../includes/mmbox/conexion.inc";

  include "../includes/conexion.inc";

	
	$idvideo = $_POST["ID"];

	$sql = "UPDATE metadatos SET dato = '$idvideo' WHERE idDato = '1'";

	mysqli_query($conex,$sql);

	header("Location:index.php");



?>