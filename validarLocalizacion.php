<?php
include 'database.php';

$localiT = $_POST['localiT'];




// echo $pasillo;
// echo "<br>";
// echo $estante;

$query = "SELECT * FROM inventario_registrado WHERE ubicacion_tomada LIKE '$localiT%'";
$result = mysqli_query($connection, $query);
$filas = mysqli_num_rows($result);



if ($filas) {
    echo $filas;
} else {
    echo "0";
}
