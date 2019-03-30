<?php
	session_start();
	$controlID = $_GET['controlID'];
	$controlID = str_pad($controlID, 6, '0', STR_PAD_LEFT);
	$name = $_GET['name'];
	$room = $_GET['room'];
	$date = $_GET['date'];
	$starttime = $_GET['starttime'];
	$endtime = $_GET['endtime'];
	$sched = $_GET['sched'];
	$purpose = $_GET['purpose'];
	$currentdate = date('m/d/Y');

	require ("fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->SetMargins(25,25,25);
	$pdf->AddPage('P','Letter',0);
	#HEADER
	$pdf->setfont('Arial', 'B', 16);
	$pdf->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES". $controlID,0,1,'C');
	$pdf->setfont('Arial', '', 14);
	$pdf->Cell(0,5,"OFFICE OF ADMINISTRATION",0,5,'C');
	#LETTER TITLE
	$pdf->ln(30);
	$pdf->setfont('Arial', 'B', 14);
	$pdf->Cell(0,5,"LETTER OF REQUEST",0,5,'C');
	#BODY
	$pdf->setfont('Arial', '', 12);
	$pdf->ln(30);
	$pdf->Cell(0,5,$currentdate,0,1,'L');
	$pdf->Cell(0,5,"Charito A. Montemayor, Director",0,1,'L');
	$pdf->Cell(0,5,"Office of the Director",0,1,'L');
	#OPENING
	$pdf->ln(20);
	$pdf->Cell(10,0,"Dear" ,0,0,'L');
	$pdf->Cell(45,0,"Charito A. Montemayor",0,0,'L');
    $pdf->Cell(0,0,":",0,0,'L');
	#PARAGRAPH	
	$pdf->ln(20);
	$pdf->MultiCell(172,10,"I, " . $name . " would like to reserve room  " . $room . " on " . $date ."  ". $sched ." at ".  $starttime. " - " . $endtime . " for our " . $purpose . ".",0,'L');
	$pdf->MultiCell(172,10,"Thank you for your considerations.",0,'L');


	#$pdf -> MultiCell(200,40,"hello",0,'L');
	$pdf->ln(40);
	$pdf->Cell(0,0,"___________________________" ,0,0,'L');

	$pdf->Cell(0,0,"___________________________" ,0,1,'R');
	$pdf->ln(5);
	$pdf->Cell(125,0,"                 (Reservation User)",0,0,'L');
	$pdf->Cell(0,0,"(Director)",0,0,'L');

	$pdf->output();


/*	class reqLetter extends FPDF
	{
		function header()
		{	$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'C');
			$this->setfont('Arial', '', 14);
			$this->Cell(0,5,"OFFICE OF ADMINISTRATION",0,5,'C');
		}
	}


    $pdf = new reqLetter();
	$pdf->SetMargins(25,25,25);
	$pdf->AddPage('P','Letter',0);
	$pdf->Output();
*/


?>