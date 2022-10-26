<?php

include 'database.php';
ob_end_clean();
require 'encabezadoPieReporte.php';



$pasillo = $_POST['inPasillo'];
$estante1 = $_POST['inEstante1'];
$estante2 = $_POST['inEstante2'];



if (isset($_POST['inPasillo']) && isset($_POST['inEstante1']) && empty($_POST['inEstante2'])) {

    $query = "SELECT codigo,descripcion,lote,stock,cant_ingresada,(cant_ingresada-stock) AS inco,alterno,ubicacion,ubicacion2
    FROM productos
    WHERE pasillo ='$pasillo' AND estante BETWEEN '$estante1' AND '$estante1'
    HAVING inco <>0 
    ORDER BY ubicacion";

    $result = mysqli_query($connection, $query);
} elseif (isset($_POST['inPasillo']) && empty($_POST['inEstante1']) && isset($_POST['inEstante2'])) {

    $query = "SELECT codigo,descripcion,lote,stock,cant_ingresada,(cant_ingresada-stock) AS inco,alterno,ubicacion,ubicacion2
    FROM productos
    WHERE pasillo ='$pasillo' AND estante BETWEEN '01' AND '$estante2'
    HAVING inco <>0 
    ORDER BY ubicacion";

    $result = mysqli_query($connection, $query);
} elseif (!empty($_POST['inPasillo']) && !empty($_POST['inEstante1']) && !empty($_POST['inEstante2'])) {

    $query = "SELECT codigo,descripcion,lote,stock,cant_ingresada,(cant_ingresada-stock) AS inco,alterno,ubicacion,ubicacion2
    FROM productos
    WHERE pasillo ='$pasillo' AND estante BETWEEN '$estante1' AND '$estante2'
    HAVING inco <>0 
    ORDER BY ubicacion";

    $result = mysqli_query($connection, $query);
} elseif (!empty($_POST['inPasillo']) && empty($_POST['inEstante1']) && empty($_POST['inEstante2'])) {

    $query = "SELECT codigo,descripcion,lote,stock,cant_ingresada,(cant_ingresada-stock) AS inco,alterno,ubicacion,ubicacion2
    FROM productos
    WHERE pasillo ='$pasillo' 
    HAVING inco <>0 
    ORDER BY ubicacion";

    $result = mysqli_query($connection, $query);
}






$pdf = new PDF("L", "mm", "letter");
$pdf->AliasNbPages();
$pdf->AddPage();


while ($fila = $result->fetch_assoc()) {

    $pdf->Cell("20", "5", $fila['codigo'], 1, 0, "R");
    $pdf->SetFont("Arial", "B", "6");
    $pdf->Cell("115", "5", $fila['descripcion'], 1, 0, "L");
    $pdf->SetFont("Arial", "B", "7");
    $pdf->Cell("20", "5", $fila['lote'], 1, 0, "R");
    $pdf->Cell("15", "5", $fila['stock'], 1, 0, "C");
    $pdf->Cell("18", "5", $fila['cant_ingresada'], 1, 0, "R");
    $pdf->Cell("12", "5", $fila['inco'], 1, 0, "R");
    $pdf->Cell("25", "5", $fila['alterno'], 1, 0, "R");
    $pdf->Cell("15", "5", $fila['ubicacion'], 1, 0, "R");
    $pdf->Cell("20", "5", $fila['ubicacion2'], 1, 1, "R");
}


$pdf->Output();
// }
