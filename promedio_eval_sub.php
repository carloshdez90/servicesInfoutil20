<?php

/*Servicio que devuelve el promedio en JSON de la calificación de una categoría
recibe como parámetros: el id de la categoría 

2: Precios de medicamentos.
3: Establecimientos de salud.
4: Profesionales de la salud.
15: Proveedores de alimentos con permisos sanitarios
6: Colegiaturas y matrículas
7: Carreras universitarias
9: Precios de alimentos
12: Instituciones financieras
14: Útiles escolares
19: Empresas multadas
21: Precios de fertilizantes
26: Empresas solventes en el ISSS
27: Precios de electricidad
35: Ruta del ahorro
36: Contadores y auditores
39: Transferencias FODES a municipalidades
11: ONG registradas
13: Delegaciones PNC
16: Sindicatos
17: Cooperativas
18: Directorio de denuncias
20: Albergues
25: Asesores en prevención de riesgos ocupacionales
28: Concesiones a empresas de telefonía
29: Distribución de frecuencias
30: Radiodifusión
32: Mantenimiento vías de circulación AMSS- Sta.Tecla
33: Asociaciones para personas con discapacidad
34: Empresas FOVIAL
37: Sedes de Ciudad Mujer
41: Directorio Municipal
23: Becas para federaciones deportivas
24: Transferencias a federaciones deportivas
31: Eventos culturales
38: Tarifario cultura
42: Comunidades indígenas
43: Bibliotecas
44: Festividades
45: Coros y orquestas
46: Cultura tradicional

*/
	include 'conexion.php';

	header('Content-Type: text/json');

	$subcategoria=$_REQUEST['subcategoria'];
	
	$respuesta=array('resultado'=>2);
	json_encode($respuesta);
	$conexion=mysql_connect($servidor,$usuario,$password) or
	die ("Problemas en la conexion");

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	//$registros=mysql_query("SELECT name FROM '$tabla' LIMIT 0, 30",$conexion) or
	//$registros=mysql_query("SELECT name FROM $tabla", $conexion) or
	$registros=mysql_query("SELECT AVG(CALIFICACION)as promediosub FROM CALIFICACION WHERE SUBCATEGORIA_ID=$subcategoria", $conexion) or
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
