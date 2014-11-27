<?php
/*Servicio que devuelve la lista de categorias en JSON
recibe como parametros un entero:
	1: Salud.
	5: Educación
	8: Economía y Finanzas
	10: Directorios
	22: Cultura y deportes*/
	include 'conexion.php';

	header('Content-Type: text/json');
	$CATEGORY_ID=$_REQUEST['CATEGORY_ID'];
	
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	$registros=mysql_query("SELECT id, name, description FROM categories WHERE
	category_id='$CATEGORY_ID';",$conexion) or
	die( json_encode($respuesta));
	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	//$filas[]=$reg;
	$filas[]=array_map('utf8_encode', $reg);
	}
	//echo json_encode($filas);
	echo json_encode($filas);

	mysql_close($conexion);
?>
