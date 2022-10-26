<?php
include 'database.php';

if (isset($_POST['id'])) {


    $id = $_POST['id'];
    $query = "SELECT * FROM inventario_registrado WHERE id =  $id";
    $result = mysqli_query($connection, $query);

    if (!$result) {

        die('ERROR');
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'ubicacion' => $row['ubicacion_tomada'],
            'usuario' => $row['usuario'],
            'barra' => $row['cod_barra'],
            'codigo' => $row['codigo'],
            'descripcion' => $row['descripcion'],
            'lote' => $row['lote'],
            'idlote' => $row['id_lote'],
            'cantidad' => $row['cantidad'],
            'id' => $row['id'],
        );
    }

    $jsonString = json_encode($json[0]);
    echo $jsonString;
}
