<?php



include 'database.php';
// $usuario = $_POST['usuario'];

$query = "SELECT id,codigo,lote,descripcion,stock,costo_und,ubicacion,ubicacion2,pasillo,estante,alterno,cant_ingresada, (cant_ingresada-stock) as inconsistencia,bodega
FROM productos
 HAVING inconsistencia <>0 
 ORDER BY ubicacion asc
 ";
$result = mysqli_query($connection, $query);
$filas = mysqli_num_rows($result);

if ($filas) {

    while ($data = mysqli_fetch_assoc($result)) {

        $arreglo["data"][] = $data;
    }


    echo  json_encode($arreglo);
} else {
    echo "0";
}


mysqli_free_result($result);
mysqli_close($connection);
