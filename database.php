<?php

$connection = mysqli_connect(
    '127.0.0.1:33065',
    'root',
    '',
    'kardex'

);


// if ($connection) {
//    echo "ok";
// }



// $conn = new PDO('mysql:host=127.0.0.1:33065;dbname=kardex;charset=UTF8mb4', 'root', '');




// $consqlServer = new PDO("sqlsrv:server=SJLOG01\SQLEXPRESS;database=invSelectivo", "sa", "Jmontes*");
// $consulta = $consqlServer->prepare("EXEC sp_buscarBarra '7709618581880'");
// $consulta->execute();
// $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);




try {

    $consqlServer = new PDO("sqlsrv:server=wbaqdbdms01;database=dms_smd2", "reporting", "reporting@");
   
} catch (PDOException $e) {
   echo "no se pudo conectar a la base de datos dms_smd2, error: $e ";
}

// $bodega = '501';
// $consulta = $consqlServer->prepare("EXEC sp_eticos_get_inventario_esperado_lotes '501','01','01','10'");
// $consulta->execute();
// $datos = $consulta->fetchAll();



// $jsonString = json_encode($datos);
// echo $jsonString;
// // var_dump($datos);

// var_dump($datos);


// $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $jsonString = json_encode($datos);
// echo $jsonString;


// "id_cot_bodega":"517",
// 
// "t_bodega":"501",
// "
// "codigo":"105215",
//
// "lote":"0338C75932",
//
// "fecha_vencimiento":"2022-11-30 00:00:00.000",
// "
// "descripcion":"GILLETTE ANTIBACTERIAL CLEAR GEL ANTITRANSP 2 X 113 GR (P\/ESPECIAL)",
//
// "stock":".00000000",
//
// "costo_compra":"23422.0000",
// 
// "costo_promedio":null,
//
// "ubicacion_1":"010505",
//
// "ubicacion_2":"CO3RF0501",
// 
// "pasillo":"01",
// 
// "estante":"05",
// 
// "originales":"CO",
// 
// "alterno":"7500435128315",
//
// },
