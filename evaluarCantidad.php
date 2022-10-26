<?php
include 'database.php';
$idlote = $_POST['idlote'];
$query = "SELECT stock,cant_ingresada FROM productos WHERE id = $idlote";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error");
}

$json = array();

while ($row = mysqli_fetch_array($result)) {

    $json[] = array(
        "stock" => $row["stock"],
        "cant_ingresada" => $row["cant_ingresada"],

    );
}

$jsonString = json_encode($json);
echo $jsonString;
