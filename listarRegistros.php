<?php
session_start();
include 'database.php';





$usuario = $_SESSION['usuario'];
$perfil = $_SESSION['perfil'];

if ($perfil == 'Administrador' || $perfil == 'Auditor') {

    $query = "SELECT id,codigo,descripcion,lote,cantidad,ubicacion_tomada,cod_barra,usuario,conteo
                  FROM inventario_registrado
                  
                 ";
    $result = mysqli_query($connection, $query);
} else {
    $query = "SELECT id,codigo,descripcion,lote,cantidad,ubicacion_tomada,cod_barra,usuario,conteo
                  FROM inventario_registrado
                  WHERE usuario = '$usuario' 
                  ";

    $result = mysqli_query($connection, $query);
}


if (!$result) {
    die("Error");
}

$json = array();
while ($row = mysqli_fetch_array($result)) {

    $json[] = array(
        'codigo' => $row['codigo'],
        'descripcion' => $row['descripcion'],
        'lote' => $row['lote'],
        'cantidad' => $row['cantidad'],
        'barra' => $row['cod_barra'],
        'usuario' => $row['usuario'],
        'ubicacion' => $row['ubicacion_tomada'],
        'conteo' => $row['conteo'],
        'id' => $row['id'],
    );
}

$jsonString = json_encode($json);
echo $jsonString;
