<?php
	require ("fpdf/fpdf.php");
	$con = mysqli_connect('localhost','root','','pup');

	session_start();
	$month1 = $_GET['mon1'];
	$month2 = $_GET['mon2'];
	$yearselected = $_GET['year'];



class ReservationReport extends FPDF
	{
		function header()
		{	$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'C');
			$this->setfont('Arial', '', 14);
			$this->Cell(0,5,"OFFICE OF ADMINISTRATION",0,5,'C');
			$this->Ln();
			$this->Ln();
		}

		function footer()
		{
			$this -> SetY(-15);
			$this ->SetFont('Arial','',8);
			$this -> Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		}

		function headerTable()
		{
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,'Name',1,0,'C');
			$this->Cell(40,10,'Date of Reservation',1,0,'C');
			$this->Cell(45,10,'Time',1,0,'C');
			$this->Cell(40,10,'Purpose',1,0,'C');
			$this->Cell(30,10,'Room',1,0,'C');
			$this->Cell(35,10,'Section',1,0,'C');
			$this->Ln();
		}

		function viewTable($con,$month1,$month2,$yearselected)
		{
			

			$select = "CALL selectReservationReport('$month1', '$month2', '$yearselected');";

            $result=mysqli_query($con,$select);
			//230 max size
					while($row = mysqli_fetch_array($result)) 
    				{			
		    			$this->SetFont('Times','B',12);
						$this->Cell(40,10,$row['reservationUser'],1,0,'C');
						$this->Cell(40,10,$row['reservationDate'],1,0,'C');
						$this->Cell(45,10,$row['startTime']. " - " .$row['endTime'],1,0,'C');
						$this->Cell(40,10,$row['purpose'],1,0,'C');
						$this->Cell(30,10,$row['roomID_FK'],1,0,'C');
						$this->Cell(35,10,$row['sectionID_FK'],1,0,'C');
						$this->Ln();
					}	   
				
			$con->close();
		}	
	}

	$pdf = new ReservationReport();
	$pdf->SetMargins(25,25,25);
	$pdf -> AliasNbPages();
	$pdf -> AddPage('L','Letter',0);
	$pdf -> headerTable();
	$pdf -> viewTable($con,$month1,$month2,$yearselected);
	$pdf -> Output();	
?>