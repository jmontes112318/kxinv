<?php

include 'database.php';




$id = $_POST['id'];
$usuario = $_POST['usuario'];
$ubicacion = $_POST['ubicacion'];
$barra = $_POST['barra'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$lote = $_POST['lote'];
$idlote = $_POST['idlote'];
$cantidad = $_POST['cantidad'];

$query = "UPDATE inventario_registrado SET codigo = '$codigo' , descripcion = '$descripcion',id_lote =$idlote,lote='$lote',cantidad =$cantidad,ubicacion_tomada='$ubicacion',cod_barra ='$barra',usuario ='$usuario' WHERE id = $id";

$result = mysqli_query($connection, $query);


if (!$result) {
    die('Error updating tareas');
}

echo 'ok';
