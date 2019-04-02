<?php
	require ("fpdf/fpdf.php");
	$con = mysqli_connect('localhost','root','','pup');

	session_start();
	$year = $_GET['year'];
	
	



class ReservationReport extends FPDF
	{
		function header()
		{	$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'C');
			$this->setfont('Arial', '', 14);
			$this->Cell(0,5,"OFFICE OF ADMINISTRATION",0,5,'C');
            $this->Ln();
            $this->ln(15);
            $this->setfont('Arial', 'B', 14);
            $this->Cell(0,5,"Yearly Reservation Report",0,5,'C');
			$this->Ln(10);
		}

		function footer()
		{
			$this -> SetY(-15);
			$this ->SetFont('Arial','',8);
			$this -> Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		}

		function headerTable()
		{
			$this->SetFont('Times','B',10);
			$this->Cell(60,10,'Name',1,0,'C');
			$this->SetFont('Times','B',9);
			$this->Cell(30,10,'Date of Reservation',1,0,'C');
			$this->SetFont('Times','B',9);
			$this->Cell(30,10,'Date Attended',1,0,'C');
			$this->SetFont('Times','B',10);
			$this->Cell(35,10,'Time',1,0,'C');
			$this->Cell(30,10,'Purpose',1,0,'C');
			$this->Cell(50,10,'Remarks',1,0,'C');
			$this->Cell(15,10,'Room',1,0,'C');
			$this->Cell(25,10,'Section',1,0,'C');
			$this->Cell(30,10,'Status',1,0,'C');
			$this->Ln();
		}

		function viewTable($con,$year)
		{
			

			$select = "select reservationUser, reservationDate, startTime, endTime, description,remarks,sectionID_FK, roomID_FK,approvedDate,reservationletter.reservationControlNumber as ControlNumber, reservation.reservationStatus AS 'Status'
				from reservation
				join reservationletter on reservationletter.reservationID_FK = reservation.reservationID
				join purpose on reservation.purposeID_FK = purpose.purposeID
				join schedule on reservation.scheduleID_FK= schedule.scheduleID
				join section on section.sectionID= reservation.sectionID_FK join
 				room on room.roomID= schedule.roomID_FK

				where year(approvedDate) = '".$year."' 
				&& reservationStatus  = 'approved' || year(approvedDate) = '".$year."' && reservationStatus = 'reject'";

            $result=mysqli_query($con,$select);
			//230 max size
					while($row = mysqli_fetch_array($result)) 
    				{			
		    			$this->SetFont('Times','B',10);
						$this->Cell(60,10,$row['reservationUser'],1,0,'C');
						$this->Cell(30,10,$row['reservationDate'],1,0,'C');
						$this->Cell(30,10,$row['approvedDate'],1,0,'C');
						$this->Cell(35,10,$row['startTime']. " - " .$row['endTime'],1,0,'C');
						$this->Cell(30,10,$row['description'],1,0,'C');
						$this->Cell(50,10,$row['remarks'],1,0,'C');
						$this->Cell(15,10,$row['roomID_FK'],1,0,'C');
						$this->Cell(25,10,$row['sectionID_FK'],1,0,'C');
						$this->Cell(30,10,$row['Status'],1,0,'C');
						$this->Ln();
					}	   
				
			$con->close();
		}	
	}

	$pdf = new ReservationReport();
	$pdf->SetMargins(25,25,25);
	$pdf -> AliasNbPages();
	$pdf -> AddPage('L','Legal',0);
	$pdf -> headerTable();
	$pdf -> viewTable($con,$year);
	$pdf -> Output();	
?>