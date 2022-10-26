<?php
include 'database.php';
$lote = $_POST['lote'];
$codigo = $_POST['codigo'];



$query = "SELECT * FROM productos WHERE lote = '$lote' AND codigo = '$codigo'";
$result = mysqli_query($connection, $query);
$filas = mysqli_num_rows($result);

if ($filas) {
    echo "1";
} else {
    echo "0";
}
