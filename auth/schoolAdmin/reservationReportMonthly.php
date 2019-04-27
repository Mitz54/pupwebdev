<?php
	require ("fpdf/fpdf.php");
	$con = mysqli_connect('localhost','root','','pup');

	session_start();
	$month = $_GET['month'];
	$year = $_GET['year'];
	



class ReservationReport extends FPDF
	{
		function headerTitle($month,$year)
		{			
			$this->setfont('Arial', '', 12);
			$this->Cell(0,5,"Republic of the Philippines",0,1,'L');
			$this->ln(1);
			$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'L');
			$this->ln(1);
			$this->setfont('Arial', '', 12);
			$this->Cell(0,5,"Office of the Vice President for Branches and Satellite Campuses",0,1,'L');
			$this->ln(1);
			$this->setfont('Arial', 'B', 16);
			$this->Cell(0,5,"Santa Rosa Campus",0,5,'L');
           	        $this->Ln();
            		$this->ln(15);
            		$this->setfont('Arial', 'B', 14);
            		$this->Cell(0,5,"Monthly Reservation Report of ".date('F',strtotime($month))." ".$year,0,5,'C');
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
			$this->Cell(35,10,'Date Attended',1,0,'C');
			$this->SetFont('Times','B',9);
			$this->Cell(35,10,'Date of Reservation',1,0,'C');
			$this->SetFont('Times','B',10);
			$this->Cell(45,10,'Time',1,0,'C');
			$this->Cell(60,10,'Purpose',1,0,'C');
			// $this->Cell(50,10,'Remarks',1,0,'C');
			$this->Cell(15,10,'Room',1,0,'C');
			$this->Cell(25,10,'Users',1,0,'C');
			$this->Cell(30,10,'Status',1,0,'C');
			$this->Ln();
		}

		function viewTable($con,$month,$year)
		{
			

			$select = "select reservationUser, reservationDate, startTime, endTime, description,remarks,crowd_affected, roomID_FK,approvedDate,reservationletter.reservationControlNumber as 	       ControlNumber, reservation.reservationStatus AS 'Status'
from reservation
join reservationletter on reservationletter.reservationID_FK = reservation.reservationID
join purpose on reservation.purposeID_FK = purpose.purposeID
join schedule on reservation.scheduleID_FK= schedule.scheduleID
join room on room.roomID= schedule.roomID_FK

where year(approvedDate) = '".$year."' && month(approvedDate) = '".$month."';";

            $result=mysqli_query($con,$select);
			//230 max size
					while($row = mysqli_fetch_array($result)) 
    				{			
		    			$name = $row['reservationUser'];
    					$dateattend = date('F d, Y',strtotime($row['approvedDate']));
						$reserve = date('F d, Y',strtotime($row['reservationDate']));
						$time = date('h:i a',strtotime($row['startTime'])). " - " .date('h:i a',strtotime($row['endTime']));
						$desc = $row['description'];
						$remarks = $row['remarks'];
						$room = $row['roomID_FK'];
						$status = $row['Status'];
						$approveDate = $row['approvedDate'];

						if($desc == "Others") {
							$desc = $remarks;
						}

		    			$this->SetFont('Times','B',10);
						$this->Cell(60,10,$row['reservationUser'],1,0,'C');
						$this->Cell(35,10,$dateattend,1,0,'C');
						$this->Cell(35,10,$reserve,1,0,'C');
						$this->Cell(45,10,$time,1,0,'C');
						$this->Cell(60,10,$desc,1,0,'C');
						// $this->Cell(50,10,$row['remarks'],1,0,'C');
						$this->Cell(15,10,$row['roomID_FK'],1,0,'C');
						$this->Cell(25,10,$row['crowd_affected'],1,0,'C');
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
	$pdf-> headerTitle($month,$year);
	$pdf -> headerTable();
	$pdf -> viewTable($con,$month,$year);
	$pdf -> Output();	
?>