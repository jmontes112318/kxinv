<?php
include 'database.php';

if (isset($_POST['barra'])) {




    $barra = $_POST['barra'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $lote = $_POST['lote'];
    $vencimiento = $_POST['vencimiento'];
    $pasillo = $_POST['pasillo'];
    $estante = $_POST['estante'];
    $stock = $_POST['stock'];
    $cantidad = $_POST['cantidad'];
    $ubicacion = $_POST['ubicacion'];
    $costo = $_POST['costo'];


    $query = "INSERT INTO productos(codigo,lote,fechavto,descripcion,stock,costo_und,ubicacion,pasillo,estante,alterno,cant_ingresada)
              VALUES('$codigo','$lote','$vencimiento','$descripcion',$stock,$costo,'$ubicacion','$pasillo','$estante','$barra',$cantidad)";


    $result = mysqli_query($connection, $query);



    if (!$result) {
        die("Error inserting");
    }

    echo 'ok';
}
