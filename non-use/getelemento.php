<?php
/*Servicio que devuelve la lista de subcategorias
recibe como parametros: el nombre de la tabla de la sub categoría.

*/	


	header('Content-Type: text/json');
	$idsubcat=$_REQUEST['idsubcat'];
	$servidor="infoutil20db.fernandomarroquin.com";
	$usuario="infoutil20db";
	$password="payaso21";
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");
	$baseDatos="infoutil20";
	mysql_select_db($baseDatos,$conexion)
	or
	 die("Problemas en la seleccion de la base de datos");
	//$registros=mysql_query("SELECT name FROM '$tabla' LIMIT 0, 30",$conexion) or
$tabla = array(
    2  => "medicines",
    3  => "health_establishments",
    4  => "doctors",
    15 => "food_establishments",
    6  => "schools",
    7  => "universities",
    9  => "product_categories",
    12  => "finances",
    14  => "",
    19  => "medicines",
    21  => "medicines",
    26  => "medicines",
    27  => "medicines",
    35  => "medicines",
    36  => "medicines",
    39  => "medicines",
    11  => "medicines",
    13  => "medicines",
    16  => "medicines",
    17  => "medicines",
    18  => "medicines",
    20  => "medicines",
    25  => "medicines",
    28  => "medicines",
    29  => "medicines",
    30  => "medicines",
    32  => "medicines",
    33  => "medicines",
    34  => "medicines",
    37  => "medicines",
    41  => "medicines",
    23  => "medicines",
    24  => "medicines",
    31  => "medicines",
    38  => "medicines",
    42  => "medicines",
    43  => "medicines",
    44  => "medicines",
    45  => "medicines",
    46  => "medicines"
);
	$registros=mysql_query("SELECT id, name FROM $tabla[$idsubcat]", $conexion) or
	die(json_encode($respuesta));
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
