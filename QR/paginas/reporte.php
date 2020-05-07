<?php
$host="localhost";
$user="root";
$pass="";
$db="qr";

$conexion = new mysqli($host, $user, $pass, $db);
if($conexion -> connect_errno){
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion -> mysqli_connect_error());
}


if(isset($_POST['generar_reporte'])){
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte.csv"');

	$salida=fopen('php://output','w');
	fputcsv($salida, array('id', 'Nombre', 'Descripcion', 'Precio', 'Stock', 'Fecha y Hora'), ";");

	$reporteCsv=$conexion->query("SELECT * FROM registro");

	while($filaR = $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['id'],
							   $filaR['nombre'],
							   $filaR['descripcion'],
							   $filaR['precio'],
							   $filaR['stock'],
							   $filaR['fechahora']), ";");
	}
?>