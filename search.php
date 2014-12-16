
<?php
/*Servicio que devuelve la lista de subcategorias
recibe como parametros: el nombre de la tabla de la sub categoría.

*/  

    include 'conexion.php';

    //header('Content-Type: text/json');

    $idsubcat=$_REQUEST['idsubcat'];
    $token=$_REQUEST['token'];
    $limit=$_REQUEST['limit'];
    
    $respuesta=array('resultado'=>2);
    json_encode($respuesta);
    $conexion=mysql_connect($servidor,$usuario,$password) or
    die ("Problemas en la conexion");

    mysql_select_db($baseDatos,$conexion)
    or die("Problemas en la seleccion de la base de datos");

$tabla = array(
    2  => "medicines",
    3  => "health_establishments",
    4  => "doctors",
    15 => "food_establishments",
    6  => "schools",
    7  => "universities",
    9  => "product_categories",
    12  => "finances",
    14  => "product_categories",
    19  => "companies",
    21  => "product_categories",
    26  => "solvent_companies",
    27  => "electricity_companies",//por el momento solo envia el nombre de las compañias
//    35  => "accountants",
    36  => "accountants",
    39  => "fodes_cities_transfers",
    11  => "civil_organizations",
    13  => "delegations",
    16  => "syndicates",
    17  => "cooperatives",
    18  => "delation_institutions",
    20  => "refuges",
    25  => "risk_prevention_consultants",
    28  => "telephone_companies_concessions",
    29  => "radial_frequencies",
    30  => "radial_concessions",
    32  => "roads",
    33  => "disabled_associations",
    34  => "fovial_companies",
    37  => "woman_cities",
    41  => "municipality_infos",
    23  => "sports_grants",
    24  => "sports_federation_transfers",
    /***********************************************************************/
    31  => "cultural_fees",//ESTA TABLA NO EXISTE EN LA BASE PROPORCIONADA
    /***********************************************************************/
    38  => "cultural_fee_places",
    42  => "natives",
    43  => "libraries",
    /***********************************************************************/
    44  => "festivities",//ESTA TABLA TAMPOCO ESTA EN LA BASE PROPORCIONADA
    /***********************************************************************/
    45  => "choirs",
    46  => "cultures"
);
$mes = array(
    1  => "enero",
    2  => "febrero",
    3  => "marzo",
    4 => "abril",
    5  => "mayo",
    6  => "junio",
    7  => "julio",
    8  => "agosto",
    9  => "septiembre",
    10  => "octubre",
    11  => "noviembre",
    12  => "diciembre",
    
);


switch ($idsubcat) {
    case '2':
       //        mysql_query("UPDATE ELEMENTO SET VISITAS=VISITAS+1 WHERE IDSUBCATEGORIA=$idsubcat AND IDELEMENTO=$idelemento", $conexion) or die(json_encode($respuesta));


        $registros=mysql_query("SELECT id, name, quantity, unit, price  FROM $tabla[$idsubcat] where name like '%$token%' limit $limit,10 ", $conexion) or
        die(json_encode($respuesta));
         $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
             {
                $filas[]=array_map('utf8_encode', $reg);
             }

        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Medicamento: </strong>'.$value['name'].'<br/><strong>Cantidad: </strong> '.$value['quantity'].'<br/><strong>Unidad: </strong> '.$value['unit'].'<br/><strong>Precio:  </strong> $'.$value['price'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }
        //$descripcion=array('id'=>'id','name'=>'nombre','cantidad'=>'cantidad','unidad'=>'unidad','precio'=>'Precio máximo de venta');      

        //$answ=array('Elemento'=>$filas,'Comentarios'=>$filas2,'Descripcion'=>$descripcion);
            echo json_encode($filas3);
    

        break;
         case '3':
       //        mysql_query("UPDATE ELEMENTO SET VISITAS=VISITAS+1 WHERE IDSUBCATEGORIA=$idsubcat AND IDELEMENTO=$idelemento", $conexion) or die(json_encode($respuesta));


         $registros=mysql_query("SELECT id, name, phone, address FROM $tabla[$idsubcat] where name like '%$token%' limit $limit,10", $conexion) or
        die(json_encode($respuesta));
        
        $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
             {
                $filas[]=array_map('utf8_encode', $reg);
             }

        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                if ($value['phone']==NULL) {
                $cadena='<strong>Nombre: </strong> '.$value['name'].'<br/><strong>Teléfono: </strong>  '.'N/A'.'<br/><strong>Dirección: </strong>  '.$value['address'];
                }else{
                $cadena='<strong>Nombre: </strong> '.$value['name'].'<br/><strong>Teléfono: </strong>  '.$value['phone'].'<br/><strong>Dirección: </strong>  '.$value['address'];
                }
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }
        //$descripcion=array('id'=>'id','name'=>'nombre','cantidad'=>'cantidad','unidad'=>'unidad','precio'=>'Precio máximo de venta');      

        //$answ=array('Elemento'=>$filas,'Comentarios'=>$filas2,'Descripcion'=>$descripcion);
            echo json_encode($filas3);
    

        break;
         case '4':
       //        mysql_query("UPDATE ELEMENTO SET VISITAS=VISITAS+1 WHERE IDSUBCATEGORIA=$idsubcat AND IDELEMENTO=$idelemento", $conexion) or die(json_encode($respuesta));


        $registros=mysql_query("SELECT $tabla[$idsubcat].id, $tabla[$idsubcat].name, $tabla[$idsubcat].register_number, doctor_especialities.name as carrera FROM $tabla[$idsubcat], doctor_especialities WHERE $tabla[$idsubcat].doctor_especiality_id=doctor_especialities.id and $tabla[$idsubcat].name like '%$token%' limit $limit,10 ", $conexion) or
        die(json_encode($respuesta));
        
        $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
             {
                $filas[]=array_map('utf8_encode', $reg);
             }


        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].'<br/><strong>Número de Registro: </strong>'.$value['register_number'].'<br/><strong>Carrera: </strong>'.$value['carrera'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }
        //$descripcion=array('id'=>'id','name'=>'nombre','cantidad'=>'cantidad','unidad'=>'unidad','precio'=>'Precio máximo de venta');      

        //$answ=array('Elemento'=>$filas,'Comentarios'=>$filas2,'Descripcion'=>$descripcion);
            echo json_encode($filas3);
    

        break;
         case '15':
        $registros=mysql_query("SELECT id, name, address, authorized_at, authorization_expire_at FROM $tabla[$idsubcat] where $tabla[$idsubcat].name like '%$token%' limit $limit,10", $conexion) or
        die(json_encode($respuesta));
        
        $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
             {
                $filas[]=array_map('utf8_encode', $reg);
             }


        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].'<br/><strong>Dirección: </strong>'.$value['address'].'<br/><strong>Fecha de autorización: </strong>'.$value['authorized_at'].'<br/><strong>Fecha de expiración de la autorización: </strong>'.$value['authorization_expire_at'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }
        //$descripcion=array('id'=>'id','name'=>'nombre','cantidad'=>'cantidad','unidad'=>'unidad','precio'=>'Precio máximo de venta');      

        //$answ=array('Elemento'=>$filas,'Comentarios'=>$filas2,'Descripcion'=>$descripcion);
            echo json_encode($filas3);
    

        break;
          case '6':
         $registros=mysql_query("SELECT CONCAT( schools.id, school_infos.school_id, academic_grades.id, school_infos.year) 
                                AS idtupla, schools.name, school_infos.year, academic_grades.name as gradoAcademico, school_infos.turn, school_infos.quota 
                                from schools 
                                inner join school_infos on schools.id = school_infos.school_id 
                                inner join academic_grades on school_infos.academic_grade_id=academic_grades.id  
                                where schools.name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
         $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                
                $filas[]=array_map('utf8_encode', $reg);

            }
          
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Institución: </strong>'.$value['name'].'<br/><strong> Nivel: </strong>'.$value['gradoAcademico'].'<br/> <strong>Año: </strong>'.$value['year'].'<br/><strong> Turno: </strong>'.$value['turn'].'<br/><strong>Cuota: $</strong>'.$value['quota'];
                $filas2['indice']=$count;                
                $filas2['id']=$value['idtupla'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '7':
         $registros=mysql_query("SELECT  universities.id,  carreers.id as idcarrera, universities.name , carreers.name as carrera, universities.address 
                                from  universities 
                                inner join carreers on  universities.id = carreers.university_id  
                                where carreers.name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
         $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                
                $filas[]=array_map('utf8_encode', $reg);

            }
            
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Universidad: </strong>'.$value['name'].'<br><strong>Carrera:</strong> '.$value['carrera'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'].$value['idcarrera'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
   case '9':/******************************************************************/
         $registros=mysql_query("SELECT product_probes.id, 
                                    products.name, 
                                    product_brands.name AS marca, 
                                    shopping_establishments.name AS establecimiento, 
                                    product_presentations.name AS presentacion, 
                                    product_probes.price
                                    FROM product_probes
                                    INNER JOIN products ON products.id = product_probes.product_id
                                    INNER JOIN shopping_establishments ON product_probes.shopping_establishment_id = shopping_establishments.id
                                    INNER JOIN product_presentations ON product_probes.product_presentation_id = product_presentations.id
                                    INNER JOIN product_categories ON products.product_category_id = product_categories.id
                                    INNER JOIN product_brands ON product_probes.product_brand_id = product_brands.id
                                    WHERE product_categories.category_id =$idsubcat
                                    and products.name like '%$token%'
                                    limit $limit, 10", $conexion) or die(json_encode($respuesta));
             $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                
                $filas[]=array_map('utf8_encode', $reg);

            }
            
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Producto: </strong>'.$value['name'].'<br/><strong>Marca: </strong>'.$value['marca'].'<br/><strong>Establecimiento: </strong>'.$value['establecimiento'].'<br><strong>Presentación: </strong>'.$value['presentacion'].'<br/><strong>Precio: </strong>$:'.$value['price'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '12':
           $registros=mysql_query("SELECT id, name, phone, address, auth FROM $tabla[$idsubcat] where name like '%$token%' limit $limit,10 ", $conexion) or
             die(json_encode($respuesta));

             $filas=array();
                while ($reg=mysql_fetch_assoc($registros))
                {
                    $filas[]=array_map('utf8_encode', $reg);
                }

            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                if ($value['auth']==1) {
               $cadena='<strong>Nombre: </strong>'.$value['name'].'<br/><strong>Teléfono: </strong>'.$value['phone'].'<br/><strong>Dirección: </strong>'.$value['address'].'<br/><strong>autorización: </strong>'.'Autorizado';
                }else{
               $cadena='<strong>Nombre: </strong>'.$value['name'].'<br/><strong>Teléfono: </strong>'.$value['phone'].'<br/><strong>Dirección: </strong>'.$value['address'].'<br/><strong>autorización: </strong>'.'N/A';
                }
                    # code...
             
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }
        //$descripcion=array('id'=>'id','name'=>'nombre','cantidad'=>'cantidad','unidad'=>'unidad','precio'=>'Precio máximo de venta');      

        //$answ=array('Elemento'=>$filas,'Comentarios'=>$filas2,'Descripcion'=>$descripcion);
            echo json_encode($filas3);
    

        break;
         case '14':
         $registros=mysql_query("SELECT product_probes.id, 
                                    products.name, 
                                    product_brands.name AS marca, 
                                    shopping_establishments.name AS establecimiento, 
                                    product_presentations.name AS presentacion, 
                                    product_probes.price
                                    FROM product_probes
                                    INNER JOIN products ON products.id = product_probes.product_id
                                    INNER JOIN shopping_establishments ON product_probes.shopping_establishment_id = shopping_establishments.id
                                    INNER JOIN product_presentations ON product_probes.product_presentation_id = product_presentations.id
                                    INNER JOIN product_categories ON products.product_category_id = product_categories.id
                                    INNER JOIN product_brands ON product_probes.product_brand_id = product_brands.id
                                    WHERE product_categories.category_id =$idsubcat
                                    and products.name like '%$token%'
                                    limit $limit, 10", $conexion) or die(json_encode($respuesta));
             $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                
                $filas[]=array_map('utf8_encode', $reg);

            }
            
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Producto: </strong>'.$value['name'].'<br/><strong>Marca: </strong>'.$value['marca'].'<br/><strong>Establecimiento: </strong>'.$value['establecimiento'].'<br><strong>Presentación: </strong>'.$value['presentacion'].'<br/><strong>Precio: </strong>$:'.$value['price'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '19':
     $registros=mysql_query("SELECT companies.id, companies.name, company_penalties.penalties_amount, 
                            company_penalties.year, company_penalties.month 
                            FROM companies 
                            inner join company_penalties on companies.id=company_penalties.company_id 
                            where companies.name like '%$token%'
                            limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].'<br/><strong>Año: </strong>'.$value['year'].'<br/><strong>Mes: </strong>'.$mes[$value['month']].'<br/><strong>Multa: $</strong>'.$value['penalties_amount'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
     case '21':
        $registros=mysql_query("SELECT product_probes.id, 
                                    products.name, 
                                    product_brands.name AS marca, 
                                    shopping_establishments.name AS establecimiento, 
                                    product_presentations.name AS presentacion, 
                                    product_probes.price
                                    FROM product_probes
                                    INNER JOIN products ON products.id = product_probes.product_id
                                    INNER JOIN shopping_establishments ON product_probes.shopping_establishment_id = shopping_establishments.id
                                    INNER JOIN product_presentations ON product_probes.product_presentation_id = product_presentations.id
                                    INNER JOIN product_categories ON products.product_category_id = product_categories.id
                                    INNER JOIN product_brands ON product_probes.product_brand_id = product_brands.id
                                    WHERE product_categories.category_id =$idsubcat
                                    and products.name like '%$token%'
                                    limit $limit, 10", $conexion) or die(json_encode($respuesta));
             $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                
                $filas[]=array_map('utf8_encode', $reg);

            }
            
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Producto: </strong>'.$value['name'].'<br/><strong>Marca: </strong>'.$value['marca'].'<br/><strong>Establecimiento: </strong>'.$value['establecimiento'].'<br><strong>Presentación: </strong>'.$value['presentacion'].'<br/><strong>Precio: </strong>$ '.$value['price'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '27':

     $registros=mysql_query("SELECT electricity_prices.id, 
                    electricity_companies.name as company, 
                    electricity_charge_types.name as tipocarga, 
                    electricity_rate_types.name as tipotarifa, 
                    electricity_prices.price, 
                    electricity_charge_types.unit 
                    FROM electricity_prices 
                    inner join electricity_companies on electricity_prices.electricity_company_id=electricity_companies.id
                    inner join  electricity_charge_types on electricity_prices.electricity_charge_type_id=electricity_charge_types.id 
                    inner join  electricity_rate_types on electricity_prices.electricity_rate_type_id=electricity_rate_types.id 
                    where electricity_companies.name like '%$token%'
                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Compañia: </strong>'.$value['company'].
                        '<br/><strong>Tipo de Cargo: </strong>'.$value['tipocarga'].
                        '<br/><strong>Tipo de Tarifa: </strong>'.$value['tipotarifa'].
                        '<br/><strong>Precio: $ </strong>'.$value['price'].
                        '<br/><strong>Unidad: </strong>'.$value['unit'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '36':
        $registros=mysql_query("SELECT id, code, name, kind FROM $tabla[$idsubcat] where $tabla[$idsubcat].name like '%$token%' limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Código: </strong>'.$value['code'].
                        '<br/><strong>Tipo: </strong>'.$value['kind'];               ;
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '39':
         setlocale(LC_MONETARY, 'en_US');
         $registros=mysql_query("SELECT fodes_cities_transfer_infos.id, 
                                        cities.name,    
                                        fodes_cities_transfers.period_1,    
                                        fodes_cities_transfers.period_2 
                                        FROM fodes_cities_transfer_infos 
                                        inner join cities on fodes_cities_transfer_infos.fodes_cities_transfer_id=cities.id 
                                        inner join fodes_cities_transfers on fodes_cities_transfer_infos.fodes_cities_transfer_id= fodes_cities_transfers.city_id
                                        where cities.name like '%$token%'
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
            $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;

                $cadena='<strong>Municipio: </strong>'.$value['name'].
                        '<br/><strong>Enero-Noviembre: </strong>'.money_format('%(#10n', $value['period_1']).
                        '<br/><strong>Diciembre: </strong>'.money_format('%(#10n', $value['period_2']);
                $filas2['index']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);            
    break;
    case '11':
        $registros=mysql_query("SELECT civil_organizations.id, 
                                       civil_organizations.name,
                                       civil_organizations.address,  
                                       civil_organizations.phone, 
                                       civil_organization_types.name as tipo 
                                       FROM civil_organizations 
                                       inner join civil_organization_types 
                                       on civil_organizations.civil_organization_type_id=civil_organization_types.id 
                                       where civil_organizations.name like '%$token%'
                                       limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                 if ($value['phone']==NULL) {
                    $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Direccion: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.'S/N'.
                        '<br/><strong>Tipo: </strong>'.$value['tipo'];

                 }else{
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Direccion: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Tipo: </strong>'.$value['tipo'];
                }
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);        
    break;
    case '13':
         $registros=mysql_query("SELECT delegation_infos.delegation_id, 
                                        delegation_infos.name, 
                                        delegation_infos.phone, 
                                        delegation_infos.area 
                                        FROM delegation_infos
                                        inner join delegations 
                                        on delegation_infos.delegation_id= delegations.id 
                                        where delegation_infos.name like '%$token%'
                                        group by delegation_infos.delegation_id 
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                if ($value['area']==NULL) {
                    $cadena='<strong>Delegación: </strong>'.$value['name'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Área: </strong>'.'N/A';
                }else{
                $cadena='<strong>Delegación: </strong>'.$value['name'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Área: </strong>'.$value['area'];
                }
                $filas2['indice']=$count;
                $filas2['id']=$value['delegation_id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);       
    break;
    case '16':
         $registros=mysql_query("SELECT syndicates.id, 
                                        syndicates.name,    
                                        syndicates.acronym,
                                        syndicate_categories.name as tipo, 
                                        syndicates.total_men, 
                                        syndicates.total_women  
                                        FROM syndicates
                                        inner join syndicate_categories 
                                        on syndicates.syndicate_category_id=syndicate_categories.id
                                        where syndicates.name like '%$token%'
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>Tipo: </strong>'.$value['tipo'].
                        '<br/><strong>N° de hombres integrantes: </strong>'.$value['total_men'].
                        '<br/><strong>N° de mujeres integrantes: </strong>'.$value['total_women'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);       
    break;
    case '17':
         $registros=mysql_query("SELECT cooperatives.id, 
                                        cooperatives.name, 
                                        cooperatives.acronym, 
                                        cooperatives.address, 
                                        cooperatives.phone1, 
                                        cooperative_types.name as tipo
                                        FROM cooperatives 
                                        inner join cooperative_types 
                                        on cooperatives.cooperative_type_id=cooperative_types.id 
                                        where cooperatives.name like '%$token%'
                                        limit $limit, 10", $conexion) or

         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                if ($value['phone1']==NULL) {
                    $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>Dirección: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.'N/A'.
                        '<br/><strong>Tipo: </strong>'.$value['tipo'];
                    
                }else{
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>Dirección: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone1'].
                        '<br/><strong>Tipo: </strong>'.$value['tipo'];
                }
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);

    break;
    case '18':
        $registros=mysql_query("SELECT delation_infos.id, 
                                        delation_institutions.name, 
                                        delation_infos.phone, 
                                        delation_infos.kind 
                                        FROM delation_infos 
                                        inner join delation_institutions 
                                        on delation_infos.delation_institution_id=delation_institutions.id 
                                        where delation_institutions.name like '%$token%'
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<strong>Teléfono: </strong>'.$value['phone'].
                        '<strong>Tipo: </strong>'.$value['kind'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);


    break;
    case '20':
        $tiene = array(
            1  => "Si",
            0  => "No"            
        );

         $registros=mysql_query("SELECT refuges.id, 
                                        refuges.name, 
                                        cities.name as municipio,
                                        refuges.phone, 
                                        refuges.has_water, 
                                        refuges.has_bathroom, 
                                        refuges.has_communication, 
                                        refuges.has_electricity,
                                        refuges.has_toilet 
                                        FROM refuges 
                                        inner join cities on refuges.city_id=cities.id 
                                        where refuges.name like '%$token%'
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                if ($value['phone']==NULL) {
                    $cadena='<strong>Dirección: </strong>'.$value['name'].
                        '<br/><strong>Municipio: </strong>'.$value['municipio'].
                        '<br/><strong>Teléfono: </strong>'.'N/A'.
                        '<br/><strong>Agua: </strong>'.$tiene[$value['has_water']].
                        '<br/><strong>Baño: </strong>'.$tiene[$value['has_bathroom']].
                        '<br/><strong>Comunicación: </strong>'.$tiene[$value['has_communication']].
                        '<br/><strong>Electricidad: </strong>'.$tiene[$value['has_electricity']].
                        '<br/><strong>Letrina: </strong>'.$tiene[$value['has_toilet']];
                    
                }else{
                $cadena='<strong>Dirección: </strong>'.$value['name'].
                        '<br/><strong>Municipio: </strong>'.$value['municipio'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Agua: </strong>'.$tiene[$value['has_water']].
                        '<br/><strong>Baño: </strong>'.$tiene[$value['has_bathroom']].
                        '<br/><strong>Comunicación: </strong>'.$tiene[$value['has_communication']].
                        '<br/><strong>Electricidad: </strong>'.$tiene[$value['has_electricity']].
                        '<br/><strong>Letrina: </strong>'.$tiene[$value['has_toilet']];
                }
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);

    break;
    case '25':
         $registros=mysql_query("SELECT id, code, name, kind, email, phone
                                FROM risk_prevention_consultants 
                                where name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Código: </strong>'.$value['code'].
                        '<br/><strong>Tipo: </strong>'.$value['kind'].
                        '<br/><strong>Email: </strong>'.$value['email'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '28':
        $registros=mysql_query("SELECT id, name, code1, code2, code3, registered_at
                                FROM telephone_companies_concessions 
                                where name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Código: </strong>'.$value['code1'].'-'.$value['code2'].'-'.$value['code3'].
                        '<br/><strong>Fecha de registro: </strong>'.$value['registered_at'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '29':
            $registros=mysql_query("SELECT id, name, acronym, resolution_number, 
                                    freq_tx, freq_rx, ab, power, coverage 
                                    FROM radial_frequencies 
                                    where name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>N° de resolución: </strong>'.$value['resolution_number'].
                        '<br/><strong>Frec. RX: </strong>'.$value['freq_rx'].
                        '<br/><strong>Frec. TX: </strong>'.$value['freq_tx'].
                        '<br/><strong>AB: </strong>'.$value['ab'].
                        '<br/><strong>Potencia (W)</strong>'.$value['power'].
                        '<br/><strong>Cobertura: </strong>'.$value['coverage'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);    
    break;

    case '30':
            $registros=mysql_query("SELECT id, name, acronym, kind, coverage
                                    FROM radial_concessions 
                                    where name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>Tipo: </strong>'.$value['kind'].
                        '<br/><strong>Cobertura: </strong>'.$value['coverage'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '32':
             $registros=mysql_query("SELECT id, name,
                                        start as inicio ,
                                        end as final , longitude,
                                        responsible
                                        FROM roads 
                                        where name like '%$token%'
                                        limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Asignado a: </strong>'.$value['responsible'].
                        '<br/><strong>Desde: </strong>'.$value['inicio'].
                        '<br/><strong>Hasta: </strong>'.$value['final'].
                        '<br/><strong>longitud: </strong>'.$value['longitude'].' Kms';
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);    
    break;

    case '33':
        $registros=mysql_query("SELECT id, name, acronym, kind, contact, charge, phone, email, address
                                FROM disabled_associations  
                                where name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Acrónimo: </strong>'.$value['acronym'].
                        '<br/><strong>Tipo: </strong>'.$value['kind'].
                        '<br/><strong>Contacto: </strong>'.$value['contact'].
                        '<br/><strong>Cargo: </strong>'.$value['charge'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Email: </strong>'.$value['email'].
                        '<br/><strong>Dirección: </strong>'.$value['address'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);

    break;
    case '34':
         $registros=mysql_query("SELECT id, name, phone, email
                                FROM fovial_companies 
                                where name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Email: </strong>'.$value['email'].
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '37':

        $info = array(
            1  => "<a class=\" \" href=\"#\"  onclick=\"
                    window.open('http://ciudadmujer.gob.sv/index.php?option=com_content&view=article&id=70&Itemid=113', '_system')\">
                    Más info...
                </a>",
            2  => "Mas info..." ,
            3  => "Mas info..." ,
            4  => "Mas info..." ,
            5  => "Mas info..."            
        );
         $registros=mysql_query("SELECT id, name, address, contact_person, contact_phone, contact_email, schedule
                                FROM woman_cities   
                                where name like '%$token%'
                                limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Dirección: </strong>'.$value['address'].
                        '<br/><strong>Contacto: </strong>'.$value['contact_person'].
                        '<br/><strong>Email: </strong>'.$value['contact_email'].
                        '<br/><strong>Horario: </strong>'.$value['schedule'].
                        '<br/>'.$info[$value['id']];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '41':
            $registros=mysql_query("SELECT 
                                    municipality_infos.id, 
                                    municipality_infos.name, 
                                    cities.name as ciudad, 
                                    municipal_jobs.name as puesto, 
                                    political_parties.name as partido, 
                                    email, 
                                    phone, 
                                    fax, 
                                    address
                                    FROM municipality_infos
                                    INNER JOIN cities ON cities.id = city_id
                                    INNER JOIN municipal_jobs ON municipal_jobs.id = municipality_infos.municipal_job_id
                                    INNER JOIN political_parties ON political_parties.id = political_party_id 
                                    where cities.name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Municipio: </strong>'.$value['ciudad'].
                        '<br/><strong>Puesto: </strong>'.$value['puesto'].
                        '<br/><strong>Partido: </strong>'.$value['partido'].
                        '<br/><strong>Email: </strong>'.$value['email'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Fax: </strong>'.$value['fax'].
                        '<br/><strong>Dirección: </strong>'.$value['address'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);

    break;

    case '23':
    setlocale(LC_MONETARY, 'en_US');
             $registros=mysql_query("SELECT id, name, amount, total_men, total_women
                                    FROM sports_grants 
                                    where name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Federación: </strong>'.$value['name'].
                        '<br/><strong>Monto: </strong>'.money_format('%(#10n', $value['amount']).
                        '<br/><strong>Total de hombres: </strong>'.$value['total_men'].
                        '<br/><strong>Total de mujeres: </strong>'.$value['total_women'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);

    break;

    case '24':
    setlocale(LC_MONETARY, 'en_US');
             $registros=mysql_query("SELECT id, name, approved_amount, executed_amount, extra_amount
                                    FROM sports_federation_transfers 
                                    where name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Monto aprobado: </strong>'.money_format('%(#10n',$value['approved_amount']).
                        '<br/><strong>Monto ejecutado: </strong>'.money_format('%(#10n', $value['executed_amount']).
                        '<br/><strong>Ayuda adicional pagada más refuerzo : </strong>'.money_format('%(#10n', $value['extra_amount']);
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
       
    break;

    case '31':
             
         $filas= array();
         echo json_encode($filas);
    break;

    case '38':
        setlocale(LC_MONETARY, 'en_US');

            $registros=mysql_query("SELECT 
                            cultural_fees.id, 
                            cultural_fee_places.name, 
                            cultural_fee_types.name as tipo, 
                            cultural_fees.description, 
                            cultural_fees.min_price, 
                            cultural_fees.max_price, 
                            cultural_fee_price_types.name as nombreprecio,
                            cultural_fee_place_contacts.address, 
                            cultural_fee_place_contacts.phone  
                            FROM cultural_fees
                            INNER JOIN cultural_fee_places ON cultural_fee_places.id = cultural_fees.cultural_fee_place_id
                            INNER JOIN cultural_fee_types ON cultural_fee_types.id = cultural_fees.cultural_fee_type_id
                            INNER JOIN cultural_fee_price_types ON cultural_fee_price_types.id = cultural_fees.cultural_fee_price_type_id 
                            inner join  cultural_fee_place_contacts on  cultural_fee_place_contacts.cultural_fee_place_id=cultural_fees.id
                            where cultural_fee_places.name like '%$token%'
                            limit $limit, 10", $conexion) or

         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Lugar: </strong>'.$value['name'].
                        '<br/><strong>Tipo: </strong>'.$value['tipo'].
                        '<br/><strong>Descripción: </strong>'.$value['description'].
                        '<br/><strong>Precio : </strong>'.money_format('%(#10n',$value['min_price']).
                        '<br/><strong>Dirección: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;

    case '42':
             $registros=mysql_query("SELECT natives.id, 
                                    natives.name, 
                                    natives.ethnic_identity, 
                                    natives.description, 
                                    cities.name as municipio 
                                    FROM natives
                                    inner join cities on cities.id=natives.city_id 
                                    where natives.name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Indentidad étnica: </strong>'.$value['ethnic_identity'].
                        '<br/><strong>Descripción: </strong>'.$value['description'].
                        '<br/><strong>Municipio: </strong>'.$value['municipio'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
                /*array_push($filas2,$value['id'] );
                array_push($filas2, $cadena);*/
            }

         echo json_encode($filas3);
    break;
    case '43':
             $registros=mysql_query("SELECT id, name, address, phone, schedule, kind
                                    FROM libraries 
                                    where name like '%$token%'
                                    limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                    # code...
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'].
                        '<br/><strong>Dirección: </strong>'.$value['address'].
                        '<br/><strong>Teléfono: </strong>'.$value['phone'].
                        '<br/><strong>Horario: </strong>'.$value['schedule'].
                        '<br/><strong>Tipo: </strong>'.$value['kind'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
            }

         echo json_encode($filas3);
    break;

     case '44'://Festividades
             
         $filas= array();
         echo json_encode($filas);
    break;

    case '45'://Coros y Orquestas
             
         $filas= array();
         echo json_encode($filas);
    break;


     case '46'://Cultura tradicional
             
         $filas= array();
         echo json_encode($filas);
    break;

    default://EN CASO DE EXISTIR LA TABLA Y TENGA ID Y NOMBRE SE EJECUTA ESTE CASO
         $registros=mysql_query("SELECT id, name FROM $tabla[$idsubcat] where $tabla[$idsubcat].name like '%$token%' limit $limit, 10", $conexion) or
         die(json_encode($respuesta));
          $filas=array();
            while ($reg=mysql_fetch_assoc($registros))
            {
                $filas[]=array_map('utf8_encode', $reg);
            }
        $filas2 = array();
            $filas3= array();
            $count=$limit;
            foreach ($filas as $key => $value) {
                $count++;
                $cadena='<strong>Nombre: </strong>'.$value['name'];
                $filas2['indice']=$count;
                $filas2['id']=$value['id'];
                $filas2['name']=$cadena;
                $filas3[]=$filas2;
            }

         echo json_encode($filas3);
       
    }



    mysql_close($conexion);
?>
