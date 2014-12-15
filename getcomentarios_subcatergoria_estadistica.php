
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

	mysql_select_db($baseDatos,$conexion)
	or die("Problemas en la seleccion de la base de datos");
	//$registros=mysql_query("SELECT name FROM '$tabla' LIMIT 0, 30",$conexion) or

    $registros=mysql_query("SELECT IDSUBCATEGORIA, count(IDSUBCATEGORIA) as totalComentariosSub FROM COMENTARIO WHERE IDSUBCATEGORIA = $idsubcat AND TIPO=0", $conexion) or
    die(json_encode($respuesta));


	$filas=array();
	while ($reg=mysql_fetch_assoc($registros))
	{
	   $filas[]=array_map('utf8_encode', $reg);
	}
     /*$registros2=mysql_query("SELECT count(IDSUBCATEGORIA) as totalCategoria FROM COMENTARIO WHERE IDCATEGORIA = $idcat AND TIPO=0 ", $conexion) or
    die(json_encode($respuesta));


    $filas2=array();
    while ($reg2=mysql_fetch_assoc($registros2))
    {
       $filas2[]=array_map('utf8_encode', $reg2);
    }
    $answ = array('Subtotal' =>$filas ,'Total'=>$filas2 );
    */


	//echo json_encode($answ);
    echo json_encode($filas);

	mysql_close($conexion);
?>
