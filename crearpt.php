<?php
require('./fpdf/fpdf.php');
include_once("./bd/conndb.php");


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image("./img/BANNER_DELEG_ADMIN.png",10,5,180,30,"PNG");
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->Cell(80);
    
    // Título
    $this->SetXY(55 ,38);
    $this->MultiCell(85, 5, utf8_decode('CONTROL DE ENVIO DE DOCUMENTOS FO-DOyVC-17    Rev: 0'), 0, 'C');
    //$this->Cell(180,10,'CONTROL DE ENVIO DE DOCUMENTOS',0,1,'C');
    //$this->Cell(180,10,'FO-DOyVC-17    Rev: 0',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
   // $this->Cell(0,10, utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
}
}

// Consulta a base de datos 
$idfolio=$_REQUEST['idfolio'];
//$turnado=$_REQUEST['turnado'];
$sql="SELECT  d.idfolio as Folio, d.fechaact as FecAct, d.remitente as Remitente, d.fecha_doc as FecDoc,
d.docreferencia as DocRef, d.descripcion as Descrip,d.observacion as obser

from tbl_docs d
   
   where d.idfolio =  $idfolio"; //id_doc='$id_doc'";
	$resultado= $conexion->query($sql);
	$row=$resultado->fetch(PDO::FETCH_ASSOC);


// Creación del objeto de la clase heredada
$pdf = new PDF();
//$pdf->AliasNbPages();
$pdf->AddPage();


//Fecha
$pdf->SetXY(163,50);
$pdf->SetFont('Arial','', 8);
$pdf->Cell(15, 8, 'FECHA:', 0, 'L');//label Fecha
$pdf->Line(175, 55.5, 191, 55.5);
//campo de base de datos
$pdf->SetXY(175,50);
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(15, 8, utf8_decode($row['FecAct']), 0, 'L');// fecha de bd   -> $row['FecAct']

//Folio
$pdf->SetXY(147,50);
$pdf->SetFont('Arial','', 8);
$pdf->Cell(15, 8, 'FOLIO:', 0, 'L');//label Fecha
$pdf->Line(157, 55.5, 161, 55.5);
//campo de base de datos
$pdf->SetXY(157,50);
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(15, 8,utf8_decode($row['Folio']), 0, 'L');// fecha de bd   -> $row['Folio']

//remitente
$pdf->SetXY(10,51);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20, 11, 'RECIBIDO DE:', 0, 'L');//label Fecha
//$pdf->Line(155, 55.5, 161, 55.5);
//campo de base de datos
$pdf->SetXY(35,51);
$pdf->SetFont('Arial','B', 10);
$pdf->MultiCell(105, 5, utf8_decode($row['Remitente']) , 0, 'L');// fecha de bd   -> $row['Folio']


// label de datos del documento 
$pdf->SetXY(10,60);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20, 11, 'DEL DOCUMENTO:', 0, 'L');//label Fecha

//cuadro para agregar fecha y numero de documento 
$pdf->SetXY(10,69);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(180, 12, '',1, 0, 'L');//label Fecha

//fecha de documento
$pdf->SetXY(19,70.5);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(15, 11, 'FECHA:', 0, 'L');//label Fecha

//campo de base de datos
$pdf->SetXY(34,70.5);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(15, 11,utf8_decode($row['FecDoc']), 0, 'L');// campo de bd fecha del documento

//Número  de documento 
//fecha de documento
$pdf->SetXY(116,70.5);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(15, 11, utf8_decode('NÚMERO:'), 0, 'L');//label Fecha

//campo de base de datos
$pdf->SetXY(134,70.5);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(15, 11, utf8_decode($row['DocRef']) , 0, 'L');// campo de bd fecha del documento

// label de descripción del documento 
$pdf->SetXY(10,85);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20, 11, utf8_decode('DESCRIPCIÓN DEL DOCUMENTO Y/O ASUNTO:'), 0, 'L');//label Fecha

//cuadro para agregar descripción
$pdf->SetXY(10,94);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(180, 50, '',1, 0, 'L');//label Fecha

//campo de base de datos
$pdf->SetXY(19,100);
$pdf->SetFont('Arial','B', 9);// Descrip
$pdf->MultiCell(168, 3,utf8_decode($row['Descrip']) , 0);// 

//LABEL ASIGNADO A:
$pdf->SetXY(10,145);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20, 11, utf8_decode('ASIGNADO A:'), 0, 'L');//label Fecha
// CUADRO DE ASIGNADO A:
	
$pdf->ln();
$sql1="SELECT  u.nombre, c.tarea, r.area
        from tbl_asignados a, tbl_usuarios u, cat_conceptos c, cat_areas r
        where a.idfolio = $idfolio
        and u.cvesp=a.cvesp
        and r.Id=u.idarea
        and a.idconcepto=c.Id";
        
        $resul= $conexion->query($sql1);
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(43,10,'NOMBRE',1,0,'C',1);
        $pdf->Cell(45,10,'AREA',1,0,'C',1);
        $pdf->Cell(60,10,'CONCEPTO',1,0,'C',1);
        $pdf->Cell(32,10,'FIRMA',1,1,'C',1);
       
        $pdf->SetFont('Arial','', 8);
    
    while($row1=$resul->fetch(PDO::FETCH_ASSOC)){
    
      $pdf->Cell(43,10,utf8_decode($row1['nombre']),1,0,'C');
		$pdf->Cell(45,10, utf8_decode($row1['area']),1,0,'C');
      $pdf->Cell(60,10,utf8_decode($row1['tarea']),1,0,'L');
      $pdf->Cell(32,10,' ',1,1,'C');
   }

   
   $pdf->ln(5);
  
//LABEL OBSERVACIONES
$pdf->SetXY(10,195);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20, 11, utf8_decode('OBSERVACIONES:'), 0, 'L');
//CUADRO OBSERVACIONES
$pdf->SetXY(10,205);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(180, 20, '',1, 0, 'L');//

//campo de base de datos
$pdf->SetXY(19,207);
$pdf->SetFont('Arial','B', 9);
$pdf->MultiCell(168, 5, utf8_decode($row['obser']) , 0, 'L');// 

$pdf->SetXY(10,230);
$pdf->SetFont('Arial','B', 9);
$pdf->Cell(180, 11,'ATENTAMENTE',0, 0, 'C');//
$pdf->Line(75, 248, 125, 248);
$pdf->SetXY(73,253);
$pdf->MultiCell(55, 5, utf8_decode('L.C. FERNANDO MATA RIVERA DELEGADO ADMINISTRATIVO'), 0, 'C');
$conexion = null;
ob_clean();
$pdf->Output();



?>