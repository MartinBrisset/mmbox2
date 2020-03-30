<?php
    // MODULO CARGAR TODOS LOS PERFILES

    // conectar al servidor
    //include "../../../includes/mmbox/conexion.inc";

    include "conexion.inc";
    // crear sentencia SQL para traer TODOS los Estados
    $sql = "SELECT * FROM categorias";
    // jecutar sentencia
    $result = mysqli_query($conex,$sql);
    // cargar resultado
    while ($regCAT=mysqli_fetch_array($result)) {
        // crear datos
        $categoriaID="$regCAT[idCAT]";
        $categoriaNOM="$regCAT[nomCAT]";

        // crear opcion
        echo "<tr>
                  <td><option value='$categoriaID'>$categoriaNOM </option></td>
              </tr>\n";
    } // end while
    // cerrar conexión
    mysqli_close($conex);
?>
