<?php

include 'database.php';
set_time_limit(2000000);
if (isset($_POST['bodega'])) {

    $bodega = $_POST['bodega'];
    $pasillo = $_POST['pasillo'];
    $estanteI = $_POST['estanteInicial'];
    $estanteF = $_POST['estanteFinal'];

    $consulta = $consqlServer->prepare("EXEC sp_eticos_get_inventario_esperado_lotes '$bodega','$pasillo','$estanteI','$estanteF'");
    $consulta->execute();
    $data = $consulta->fetchAll(PDO::FETCH_ASSOC);


    $insertValues = [];

    foreach ($data as $row) {


        $bodega = $row['t_bodega'];
        $codigo = $row['codigo'];
        $lote = $row['lote'];
        $fechavto = $row['fecha_vencimiento'];
        $descripcion = $row['descripcion'];
        $stock = $row['stock'];
        $costo_und = $row['costo_compra'];
        $ubicacion = $row['ubicacion_1'];
        $ubicacion2 = $row['ubicacion_2'];
        $pasillo = $row['pasillo'];
        $estante = $row['estante'];
        $alterno = $row['alterno'];

        $insertValues[] = "( '$bodega', '$codigo','$lote','$fechavto', '$descripcion', $stock, $costo_und,  '$ubicacion', '$ubicacion2', '$pasillo', '$estante', '$alterno')";
    }



    $sql = "INSERT INTO productos(bodega,codigo,lote,fechavto,descripcion,stock,costo_und,ubicacion,ubicacion2,pasillo,estante,alterno)
    VALUES " . implode(',', $insertValues) . ";";

    if (count($insertValues) > 0 && mysqli_query($connection, $sql)) {
        echo "ok";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }





    // $result = mysqli_query($connection, $query);



    // if (!$result) {
    //     die("Error inserting");
    // }
    // echo 'ok';



    // mysql_query("INSERT INTO TABLE (sno, type, category) VALUES ('".implode(",",json_decode($value))."')");

    // print_r($data);



    // foreach ($data as $row) {


    //     $bodega = $row['t_bodega'];
    //     $codigo = $row['codigo'];
    //     $lote = $row['lote'];
    //     $fechavto = $row['fecha_vencimiento'];
    //     $descripcion = $row['descripcion'];
    //     $stock = $row['stock'];
    //     $costo_und = $row['costo_compra'];
    //     $ubicacion = $row['ubicacion_1'];
    //     $ubicacion2 = $row['ubicacion_2'];
    //     $pasillo = $row['pasillo'];
    //     $estante = $row['estante'];
    //     $alterno = $row['alterno'];

    //     $stmt = $conn->prepare('INSERT INTO productos(bodega,codigo,lote,fechavto,descripcion,stock,costo_und,ubicacion,ubicacion2,pasillo,estante,alterno)
    //                       VALUES(:bodega,:codigo,:lote,:fechavto,:descripcion,:stock,:costo_und,:ubicacion,:ubicacion2,:pasillo,:estante,:alterno);                          
    //                      ');

    //     $stmt->execute([
    //         ':bodega' => $bodega,
    //         ':codigo' => $codigo,
    //         ':lote' => $lote,
    //         ':fechavto' => $fechavto,
    //         ':descripcion' => $descripcion,
    //         ':stock' => $stock,
    //         ':costo_und' => $costo_und,
    //         ':ubicacion' => $ubicacion,
    //         ':ubicacion2' => $ubicacion2,
    //         ':pasillo' => $pasillo,
    //         ':estante' => $estante,
    //         ':alterno' => $alterno,
    //     ]);
    // }










}
