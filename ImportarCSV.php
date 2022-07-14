<?php
require('conexion.php');
$tipo       = $_FILES['dataAlumno']['type'];
$tamanio    = $_FILES['dataAlumno']['size'];
$archivotmp = $_FILES['dataAlumno']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros-1);

    if ($i != 0) {

        $datos = explode(";", $linea);
       
        $Codigo                = !empty($datos[0])  ? ($datos[0]) : '';
		$Nombres               = !empty($datos[1])  ? ($datos[1]) : '';
       
    $insertar = "INSERT INTO alumnos_2021ii( 
            Codigo,
			Nombres
        ) VALUES(
            '$Codigo',
			'$Nombres'
             
        )";
        mysqli_query($con, $insertar);
    }

    $i++;
}
?>

<p style="font-size: 30px">EL ARCHIVO SE IMPORTÓ CORRECTAMENTE</p>
<a href="index.php" style="font-size: 30px">CLICK PARA VOLVER ATRAS</a>
