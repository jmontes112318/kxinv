<?php

include('database.php');

$search = $_POST['search'];

if (!empty($search)) {
    $query = "SELECT * FROM inventario_registrado WHERE codigo LIKE '%$search%' OR usuario LIKE '%$search%' OR descripcion LIKE '%$search%' OR cod_barra LIKE '%$search%' OR lote LIKE '%$search%'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Error" . mysqli_error($connection));
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
    $jsonString = json_encode($json);
    echo $jsonString;
}
