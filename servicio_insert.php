<?php
	include 'conexion.php';

	$idusuario=$_REQUEST['IDUSUARIO'];
	$nombre=$_REQUEST['NOMBRE'];
	$apellido=$_REQUEST['APELLIDO'];
	
	
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");
	
	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	$resultado=mysql_query("Insert into USUARIO
	(IDUSUARIO,NOMBRE,APELLIDO)
	values('$idusuario','$nombre','$apellido')",$conexion) or
	die( json_encode($respuesta));
	//Si la respuesta es correcta enviamos 1 y sino enviamos 0
	if($resultado)
	$respuesta=array('resultado'=>1);
	echo json_encode($respuesta);
	mysql_close($conexion);
?>
