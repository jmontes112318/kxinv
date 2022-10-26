<?php

include 'database.php';




$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

$query = "UPDATE productos SET cant_ingresada =$cantidad WHERE id = $id";

$result = mysqli_query($connection, $query);


if (!$result) {
    die('Error updating tareas');
}

echo 'ok';
