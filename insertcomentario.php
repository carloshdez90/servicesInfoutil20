<?php
//      include 'conexion.php';
        include 'conexion.php';

        //header('Content-Type: text/json');

        $comentario=$_REQUEST['comentario'];
        $evaluacion=$_REQUEST['evaluacion'];
        $nombreusuario=$_REQUEST['nombreusuario'];
        $idelemento=$_REQUEST['idelemento'];
        $idsubcategoria=$_REQUEST['idsubcategoria'];
        $idcategoria=$_REQUEST['idcategoria'];
        $tipo=$_REQUEST['tipo'];

        
        $respuesta=array('resultado'=>2);
        json_encode($respuesta);

        $conexion=mysql_connect($servidor,$usuario,$password) or
        die ("Problemas en la conexion");

        mysql_set_charset('utf8');

        mysql_select_db($baseDatos,$conexion)
        or die("Problemas en la seleccion de la base de datos");

        $resultado=mysql_query("insert into COMENTARIO (IDELEMENTO, IDSUBCATEGORIA, IDCATEGORIA, NOMBREUSUARIO, COMENTARIO, EVALUACION, TIPO)
        values('$idelemento','$idsubcategoria','$idcategoria','$nombreusuario', '$comentario', '$evaluacion', '$tipo')",$conexion) or
        die( json_encode($respuesta));
        //Si la respuesta es correcta enviamos 1 y sino enviamos 0
        if($resultado)
        $respuesta=array('resultado'=>1);

        echo json_encode($respuesta);
        mysql_close($conexion);
?>

