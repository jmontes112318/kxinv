<?php
include 'database.php';

$localiza = $_POST['localiza'];
$area = $_POST['area'];

if ($_POST['area'] == "originales") {

    $query = "SELECT * FROM productos WHERE ubicacion2 = '$localiza'";
    $result = mysqli_query($connection, $query);
    $filas = mysqli_num_rows($result);
}

if ($_POST['area'] == "picking") {

    $query = "SELECT * FROM productos WHERE ubicacion = '$localiza'";
    $result = mysqli_query($connection, $query);
    $filas = mysqli_num_rows($result);
}




if ($filas) {
    echo "ok";
} else {
    echo "no";
}
