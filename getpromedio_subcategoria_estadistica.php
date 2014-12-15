
<?php
/*Servicio que devuelve la lista de subcategorias
recibe como parametros: el nombre de la tabla de la sub categoría.

*/	

	include 'conexion.php';

   

    $idsubcat=$_REQUEST['idsubcat'];
	
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

    mysql_set_charset('utf8');

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	//$registros=mysql_query("SELECT name FROM '$tabla' LIMIT 0, 30",$conexion) or


    $registros=mysql_query("SELECT IDSUBCATEGORIA, AVG( PROMEVALUACION ) as PromSubCategoria FROM ELEMENTO WHERE IDSUBCATEGORIA = $idsubcat", $conexion) or
    die(json_encode($respuesta));


	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	   $filas[]=array_map('utf8_encode', $reg);
	}

     
	echo json_encode($filas);
	mysql_close($conexion);
?>
