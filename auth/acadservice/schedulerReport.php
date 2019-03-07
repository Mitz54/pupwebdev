<?php
	require ("fpdf/fpdf.php");
	$con = mysqli_connect('localhost','root','649959948','pup');

	session_start();
	// $report = $_POST['report'];




class SchedulerReport extends FPDF
	{
		function header()
		{	$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'C');
			$this->setfont('Arial', '', 14);
			$this->Cell(0,5,"OFFICE OF ACADEMIC SERVICE",0,5,'C');
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
			$this->Cell(40,10,'Room',1,0,'C');
			$this->Cell(40,10,'Section',1,0,'C');
			$this->Cell(40,10,'Subject',1,0,'C');
			$this->Cell(40,10,'Professor',1,0,'C');
			// $this->Cell(30,10,'StartTime',1,0,'C');
			// $this->Cell(35,1	0,'EndTime',1,0,'C');
			$this->Cell(45,10,'Time',1,0,'C');
			$this->Cell(40,10,'Day',1,0,'C');
			$this->Ln();
		}

		function viewTable($con)
		{
			

			$select = "CALL selectRoomScheduleReport()";

            $result=mysqli_query($con,$select);
			//230 max size
					while($row = mysqli_fetch_array($result)) 
    				{			
		    			$this->SetFont('Times','B',12);
						$this->Cell(40,10,$row['roomID_FK'],1,0,'C');
						$this->Cell(40,10,$row['sectionID_FK'],1,0,'C');
						$this->Cell(40,10,$row['subjectID_FK'],1,0,'C');
						$this->Cell(40,10,$row['fullName'],1,0,'C');
						$this->Cell(45,10,$row['startTime']. " - " .$row['endTime'],1,0,'C');
						$this->Cell(40,10,$row['scheduleDay'],1,0,'C');
						$this->Ln();
					}	   
				
			$con->close();
		}	
	}

	$pdf = new SchedulerReport();
	$pdf->SetMargins(25,25,25);
	$pdf -> AliasNbPages();
	$pdf -> AddPage('L','Letter',0);
	$pdf -> headerTable();
	$pdf -> viewTable($con);
	$pdf -> Output();	
?>