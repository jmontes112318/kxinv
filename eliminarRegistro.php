<?php
include 'database.php';

if (isset($_POST['id'])) {


    $id = $_POST['id'];
    $query = "DELETE from inventario_registrado WHERE id =  $id";
    $result = mysqli_query($connection, $query);

    if (!$result) {

        die('no se pudo eliminar');
    }

    echo "ok";
}
