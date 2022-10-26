<?php
include 'database.php';
// $usuario = $_POST['usuario'];

$query = "SELECT id,nombre,usuario,perfil,estado,password FROM usuarios";
$result = mysqli_query($connection, $query);


if (!$result) {
    die("Error");
} else {

    while ($data = mysqli_fetch_assoc($result)) {

        $arreglo["data"][] = $data;
    }


    echo  json_encode($arreglo);
}


mysqli_free_result($result);
mysqli_close($connection);
