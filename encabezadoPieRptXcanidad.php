<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/logoeticos.png', 10, 8, 40, 10);

        // Arial bold 15
        $this->SetFont("Arial", "B", "15");;

        // Título
        $this->SetX(140);
        $this->Cell("10", "10", "Hoja De Inconsistencias ", 0, 0, "C");
        // fecha
        $this->SetFont("Arial", "", "10");;
        $this->Cell("190", "10", date("d/m/Y"), 0, 1, "C");
        // Salto de línea
        $this->Ln(2);
        $this->SetFont("Arial", "B", "7");
        $this->Cell("18", "5", "Codigo", 1, 0, "C");
        $this->Cell("115", "5", "Descripcion", 1, 0, "C");
        $this->Cell("15", "5", "stock", 1, 0, "C");
        $this->Cell("16", "5", "Ingreso", 1, 0, "C");
        $this->Cell("12", "5", "dif", 1, 0, "C");
        $this->Cell("16", "5", "valor_dif", 1, 0, "C");
        $this->Cell("25", "5", "alterno", 1, 0, "C");
        $this->Cell("15", "5", "ubicacion", 1, 0, "C");
        $this->Cell("20", "5", "ubicacion2", 1, 1, "C");
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Hoja' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
