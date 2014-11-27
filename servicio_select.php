<?php
	$IDUSUARIO=$_REQUEST['IDUSUARIO'];
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
	$registros=mysql_query("SELECT * FROM USUARIO WHERE
	IDUSUARIO='$IDUSUARIO'",$conexion) or
	die( json_encode($respuesta));
	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	$filas[]=$reg;
	}
	echo json_encode($filas);
	mysql_close($conexion);
?>
