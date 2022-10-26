<?php
include 'database.php';
$idlote = $_POST['idlote'];
$ubicacion = $_POST['ubicacion'];
// $pasillo = substr($ubicacion, 0, 2);
// $estante = substr($ubicacion, 2, 2);

// echo $pasillo;
// echo "<br>";
// echo $estante;

$query = "SELECT * FROM inventario_registrado WHERE id_lote = $idlote AND ubicacion_tomada ='$ubicacion'";
$result = mysqli_query($connection, $query);
$filas = mysqli_num_rows($result);

if ($filas) {
    echo "1";
} else {
    echo "0";
}
