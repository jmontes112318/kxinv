<?php

include 'database.php';
ob_end_clean();
require 'encabezadoPieRptXcanidad.php';





$query = "SELECT codigo,descripcion,sum(stock) AS stk ,SUM(cant_ingresada) as ingresado,
(SUM(cant_ingresada)-sum(stock)) AS inco,alterno,ubicacion,ubicacion2,((SUM(cant_ingresada)-sum(stock))*costo_und) as valor_inco
FROM productos
GROUP BY codigo
HAVING inco <0
ORDER BY ubicacion";

$result = mysqli_query($connection, $query);


$pdf = new PDF("L", "mm", "letter");
$pdf->AliasNbPages();
$pdf->AddPage();
// $pdf->SetX(70);

// $pdf->Cell("150", "10", " Por Lote ", 1, 0, "C");


while ($fila = $result->fetch_assoc()) {

    $pdf->Cell("18", "5", $fila['codigo'], 1, 0, "R");
    $pdf->SetFont("Arial", "B", "6");
    $pdf->Cell("115", "5", $fila['descripcion'], 1, 0, "L");
    $pdf->SetFont("Arial", "B", "7");
    $pdf->Cell("15", "5", $fila['stk'], 1, 0, "C");
    $pdf->Cell("16", "5", $fila['ingresado'], 1, 0, "R");
    $pdf->Cell("12", "5", $fila['inco'], 1, 0, "R");
    $pdf->Cell("16", "5", $fila['valor_inco'], 1, 0, "R");
    $pdf->Cell("25", "5", $fila['alterno'], 1, 0, "R");
    $pdf->Cell("15", "5", $fila['ubicacion'], 1, 0, "R");
    $pdf->Cell("20", "5", $fila['ubicacion2'], 1, 1, "R");
}


$pdf->Output();
// }
