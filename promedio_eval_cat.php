<?php
/*Servicio que devuelve el promedio en JSON de la  calificacion de una categoria
recibe como parametros: el id de la catgoría
	1: Salud
 	5: Educación
        8: Economía y Finanzas
        10: Directorios
        22: Cultura y deportes
*/

	include 'conexion.php';

	header('Content-Type: text/json');

	$categoria=$_REQUEST['categoria'];
	
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	//$registros=mysql_query("SELECT name FROM '$tabla' LIMIT 0, 30",$conexion) or
	//$registros=mysql_query("SELECT name FROM $tabla", $conexion) or
	$registros=mysql_query("SELECT AVG(CALIFICACION)as promedio FROM CALIFICACION WHERE CATEGORIA_ID=$categoria", $conexion) or
	die(json_encode($respuesta));
	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	//$promedio=$reg;
	$filas[]=array_map('utf8_encode', $reg);
	}
	//echo json_encode($filas);
	//$promedio=$filas[];
	echo json_encode($filas);
	//echo $promedio;

	mysql_close($conexion);
?>
