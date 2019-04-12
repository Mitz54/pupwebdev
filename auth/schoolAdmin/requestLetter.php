<?php
	session_start();
	$controlID = $_GET['controlID'];
	$controlID = str_pad($controlID, 6, '0', STR_PAD_LEFT);
	$name = $_GET['name'];
	$room = $_GET['room'];
	$date = date_format(date_create($_GET['date']),"F d, Y");
	$starttime = $_GET['starttime'];
	$endtime = $_GET['endtime'];
	$sched = $_GET['sched'];
	$purpose = $_GET['purpose'];
	$currentdate = date('F d, Y');
	$users = $_GET['sect'];
	$remarks = $_GET['remarks'];
	$prof = $_GET['prof'];

	if($purpose == "Others"){
		$purpose =$remarks;
	}

	require ("fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->SetMargins(25,25,25);
	$pdf->AddPage('P','Letter',0);
	#DATE
    $pdf->setfont('Arial', 'B', 14);
    $pdf->Cell(0,5,"RQ-2019-".$controlID,0,1,'R');
	#LETTER TITLE
    $pdf->setfont('Arial', 'B', 16);
    $pdf->ln(10);
    $pdf->Cell(0,5,"Reservation Letter",0,1,'C');
	#BODY
	$pdf->setfont('Arial', '', 12);
	$pdf->ln(20);
    $pdf->Cell(0,5,$currentdate,0,1,'L');
    $pdf->ln(5);
    $pdf->Cell(0,10,"Professor Arwin A. Nucum",0,1,'L');
    $pdf->Cell(0,0,"Head, Adminstrative Services",0,1,'L');
    $pdf->setfont('Arial', 'I', 12);
    $pdf->Cell(0,10,"PUP Santa Rosa Campus",0,1,'L');
    #OPENING
    $pdf->setfont('Arial', '', 12);
	$pdf->ln(15);
	$pdf->Cell(0,5,"Dear Sir:" ,0,1,'L');
	$pdf->Cell(0,10,"Good Day!",0,1,'L');
	#PARAGRAPH	
	$pdf->ln(5);
	$pdf->MultiCell(172,10,"We the , " . $users . ",". " would like to ask approval from your good office to us to use the room " . $room . " on " . $date.' ' . $sched ." at ".  $starttime . " - " . $endtime. " for our " . $purpose.".",0,'L');
    //We the $organization would like to
    $pdf->MultiCell(172,10,"Thank you very much and we are hoping for your very kind consideration rearding this matter.",0,'L');
    #CLOSEs
    $pdf->ln(15);
    $pdf->MultiCell(172,10,"Respectfully yours,");

	// // #$pdf -> MultiCell(200,40,"hello",0,'L');
	// $pdf->ln(35);
	// $pdf->Cell(0,0,"___________________________" ,0,0,'L');
    $pdf->ln(15);
    $pdf->Cell(0,0,$name,0,0,'L');
    $pdf->setfont('Arial', 'I', 12);
    $pdf->ln(5);
    $pdf->Cell(0,0,"Representative",0,0,'L');
    $pdf->ln(20);
    $pdf->setfont('Arial','',12);
    $pdf->Cell(0,0,"Recommending Approval:",0,0,'L');
     $pdf->ln(15);
    $pdf->Cell(0,0,$prof,0,0,'L');
    $pdf->ln(5);
    $pdf->setfont('Arial', 'I', 12);
    $pdf->Cell(0,0,"Adviser",0,0,'L');

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