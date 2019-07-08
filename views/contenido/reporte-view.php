<?php

session_start();

$id_vac = $_POST['id_vac'];

require('public/lib/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header(){
        $this->Image('public/img/logomijp.png',15,8,33);
        $this->Image('public/img/logocpnb.png',170,8,18);
        // Arial bold 15
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(65);
        $this->Cell(50, 4, 'REPÚBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
        $this->Cell(65);
        $this->Cell(50, 4, 'MINISTERIO DEL PODER POPULAR PARA RELACIONES', 0, 1, 'C');
        $this->Cell(65);
        $this->Cell(50, 4, 'INTERIORES, JUSTICIA Y PAZ', 0, 1, 'C');
        $this->Cell(65);
        $this->Cell(50, 4, 'CUERPO DE POLICÍA NACIONAL BOLIVARIANA', 0, 1, 'C');
        $this->Cell(65);
        $this->Cell(50, 4, 'OFICINA DE GESTIÓN HUMANA', 0, 1, 'C');
    }

    // Pie de página
    function Footer(){
        // Posición:a 1,5 cm del final
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 8);
        // Título footer
        $this->MultiCell(190, 5, 'Avenida Fuerzas Armadas, con calle Helicoide, Roca Tarpeya. Parroquía Santa Rosalia. Municipio Libertador. Caracas-Venezuela, código postal 1041. Teléfono: 0212-5643187. RIF: G-20009327-7', 0, 'J');
        // Número de página
        // $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$fecha = date("d-m-Y");

// Creación del objeto de la clase heredada
$pdf = new PDF(); //'L','mm','A4'
$pdf->AliasNbPages();
$pdf->AddPage();

include 'models/clase.php';
$datos = oficioVacaciones($id_vac);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 10, 'PARA:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(50,10,$datos[0],0,1,'L',0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 10, 'ADCRITO:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(80,10,$datos[1],0,1,'L',0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 10, 'ASUNTO:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(80,10,'NOTIFICACIÓN DE VACACIONES',0,1,'L',0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(32, 10,'FECHA:', 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(80,10,$fecha,0,1,'L',0);
$pdf->SetFont('Arial', 'I', 11);

$pdf->Ln();

$pdf->MultiCell(190, 5, 'Me dirijo a usted, en la oportunidad de notificarle que apartir del día '.str_replace('-', '/', date('d-m-Y', strtotime($datos[8]))).', le ha sido concebido su periodo vacacional (descrito en el cuadro siguiente), debiendo reincorporarse a sus labores habituales en fecha '.str_replace('-', '/', date('d-m-Y', strtotime($datos[9]))).'.', 0, 'J');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();

$pdf->SetX(65);
$pdf->Cell(40, 10, 'PERIODO', 1, 0, 'C');
$pdf->Cell(40, 10, 'DÍAS A DISFRUTAR', 1, 1, 'C');

$pdf->SetX(65);
$pdf->SetFont('Arial', 'I', 11);
$pdf->Cell(40, 10,$datos[2], 1, 0, 'C');
$pdf->Cell(40, 10,$datos[3], 1, 1, 'C');

$pdf->SetX(65);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40, 10, 'TOTAL', 1, 0, 'C');
$pdf->Cell(40, 10,$datos[3], 1, 0, 'C');

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'I', 11);
$pdf->MultiCell(190, 5, 'En tal sentido me permito informarle que el disfrute de las vacaciones es de carácter obligatorio de acuerdo con lo previsto en el Articulo 51 de la Ley de Estatutos de la Función Policial.', 0, 'J');

$pdf->Ln();

$pdf->SetFont('Arial', 'B', 10);

$pdf->MultiCell(190, 5, '"Articulo 51: Los funcionarios y funcionarias tendrán derecho a disfrutar de una vacación anual de:', 0, 'J');

$pdf->SetX(15);
$pdf->Cell(190, 5, '1. Veinte días hábiles durante el primer quinquenio de servicios.', 0, 1, 'J');
$pdf->SetX(15);
$pdf->Cell(190, 5, '2. Veintitrés días hábiles durante el segundo quinquenio.', 0, 1, 'J');
$pdf->SetX(15);
$pdf->Cell(190, 5, '3. Veinticinco días hábiles a partir del décimo primer año de servicio.', 0, 1, 'J');

$pdf->Ln();

$pdf->SetX(15);
$pdf->MultiCell(175, 5, 'El disfrute efectivo de las vacaciones no será acumulable. Las mismas  deberán ser disfrutadas dentro del lapso de seis meses siguientes contados a partir del momento de adquirir este derecho. Excepcionalmente, el Director o Directora del Cuerpo de Policía Nacional, Estadal o Municipal, según el caso, podrá postergarse, mediante acto motivado o fundado en razones de servicios, el disfrute efectivo de las vacaciones hasta por un lapso de un año contado a partir del momento en que se adquirió este derecho."', 0, 'J');

$pdf->Ln();

$pdf->SetFont('Arial', 'I', 11);

$pdf->Cell(190, 5, 'Notificación que se le hace a los fines consiguientes.', 0, 1, 'J');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(190, 5,$datos[4], 0, 1, 'C');
$pdf->Cell(190, 5,$datos[5], 0, 1, 'C');

$pdf->Ln();
$pdf->Ln();

$pdf->Cell(190, 5, 'Nombre y Apellido:__________________________________C.I.V:________________Fecha:___________', 0, 1, 'J');
$pdf->Cell(190, 5, $_SESSION['iniciales'].'/'.$datos[6].'/'.$datos[7], 0, 1, 'J');

$pdf->Output();