<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';
require('../fpdf/fpdf.php');

class PDF extends FPDF {
	function Header(){
		
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('../images/puplogo.jpg',20,10,25);
		
		$this->SetFont('Arial','',10);
		$this->Cell(0,3,'',0,1);
		$this->Cell(36,10,'',0,0);
		$this->Cell(50,5,'Republic of the Philippines',0,1);
		$this->SetFont('Arial','',12);
		$this->Cell(36,10,'',0,0);
		$this->Cell(50,5,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,1);
		$this->Cell(36,10,'',0,0);
		$this->Cell(50,5,'SANTA ROSA CAMPUS',0,1);
		$this->SetFont('Arial','',10);
		$this->Cell(36,10,'',0,0);
		$this->Cell(50,5,'City of Santa Rosa, Laguna',0,1);

		$this->SetFont('Arial','B',14);
		$this->Cell(55,5,'',0,1);
		$this->Cell(55,5,'',0,1);

		$this->Cell(85,5,'',0,0);
		$this->Cell(55,5,'',0,1);

		$this->SetFont('Arial','B',14);
		$this->Cell(55,5,'',0,1);
		
		$this->SetFont('Arial','',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,date("F j, Y"),0,1);
		$this->SetFont('Arial','B',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,'Professor Arwin Nucum',0,1);
		$this->SetFont('Arial','',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,'Head, Administrative Services',0,1);
		$this->SetFont('Arial','I',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,'PUP Santa Rosa Campus',0,1);

		$this->Cell(55,5,'',0,1);
		$this->Cell(55,5,'',0,1);
		$this->SetFont('Arial','',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,'Dear Sir,',0,1);
		$this->Cell(55,5,'',0,1);
		$this->Cell(20,0,'',0,0);
		$this->Cell(50,5,'Good Day!',0,1);

		
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
	}

	function createLetter($reason,$initialDate,$dueDate,$department,$stime,$etime)
	{
		$this->Cell(55,5,'',0,1);

		$this->SetX(20);    
		$this->MultiCell(165, 10, '        ' . 'We, the '.$department.' Organization will be conducting '.$reason.' on '.$initialDate.' to '.$dueDate.', from '.$stime.' to '.$etime.'. ', 70 );

		$this->Cell(55,5,'',0,1);


		$this->SetX(22); 
		$this->MultiCell(165, 10, '        ' . 'In view of this, we would like to request permission to use the following:', 70 );
	}

	function Footer(){
		
		//Go to 2.0 cm from bottom
		$this->SetY(-55);
				
		$this->SetFont('Arial','',12);
		$this->Cell(10,5,'',0,0);
		$this->Cell(58,5,"Respectfully yours,",0,1);
		$this->Cell(10,15,'',0,1);

		$this->SetFont('Arial','B',12);

		$this->Cell(10,5,'',0,0);
		$this->Cell(58,5,$GLOBALS["borrowerName"],0,1,'C');
		$this->SetFont('Arial','I',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(58,5,$GLOBALS["borrowerType"],0,1,'C');

		// $this->SetFont('Arial','B',12);
		// $this->Cell(10,10,'',0,1);
		// $this->Cell(10,5,'',0,0);
		// $this->Cell(58,5,"Recommending Approval:",0,1,'C');
		// $this->Cell(10,10,'',0,1);

		// $this->Cell(10,5,'',0,0);
		// $this->Cell(58,5,"Prof. Eva D. Villanueva",0,1,'C');
		// $this->SetFont('Arial','I',12);
		// $this->Cell(10,10,'',0,0);
		// $this->Cell(58,5,"Adviser, ELITE",0,1,'C');
		
		$this->SetFont('Arial','',8);
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(10,10,'',0,1);
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C'); // for page number
	}

	function myCell($w,$h,$x,$t)
	{
		$height = $h/3;
		$first = $height+2;
		$second = $height+$height+$height+3;
		$len = strlen($t);
		if($len>85)
		{
			$txt = str_split($t,85);
			$this->SetX($x);
			$this->Cell($w,$first,$txt[0],'','','');
			$this->SetX($x);
			$this->Cell($w,$second,$txt[1],'','','');
			$this->SetX($x);
			$this->Cell($w,$h,'','LTRB',0,'L',0);
		}
		else
		{
			$this->SetX($x);
			$this->Cell($w,$h,$t,'LTRB',0,'L',0);
		}
	}

	function create()
	{

		$this->SetFont('Arial','',12);

		$this->Cell(55,5,'',0,1);
		$this->Cell(55,5,'',0,1);
		$this->Cell(10,10,'',0,0);
		$this->Cell(15,5,"Item ID",1,0);
		$this->Cell(101,5,"Item Name",1,0,'C');
		$this->Cell(58,5,"Quantity",1,0,'C');

		$this->Cell(55,5,'',0,1);
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','Letter'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');


//Image( file name , x position , y position , width [optional] , height [optional] )
// $pdf->Image('watermark.png',10,10,189);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','',12);

//Cell(width , height , text , border , end line , [align] )

//normal row height=5.

$pdf->AddPage(); //for another page

// function getquantity($itemid)
// {
//   $pdo=pdo();
//   $sql = "SELECT * FROM iteminfo where itemID_FK = ?";
//   $stmt = $pdo->prepare($sql);
// 	$stmt->execute([$itemid]);

//   return $stmt->rowCOUNT();
// }

// $pdf->create();

// $pdo = pdo();
// $sql = "select * from item";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// $i = 0;
// while($row = $stmt->fetch())
// {

// 	$i = $i + 1;
// 		$pdf->Cell(10,10,'',0,0);
// 		$pdf->Cell(15,5,$row['itemID'],1,0);
// 		$pdf->Cell(101,5,$row['name'],1,0);
// 		$pdf->Cell(58,5,getquantity($row['itemID']),1,1);	
// 	if($i == 24)
// 	{
// 		$pdf->AddPage(); //for another page
// 		$pdf->create();
// 		$i = 0;
// 	}	
// }


$pdo = pdo();
$sql = "select * from borrowingdetails inner join borrower on borrower.borrowerID = borrowingdetails.borrowerID_FK
where borrowingdetailsID = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['borrowid']]);
$results = $stmt->fetch();

$startTime =  date("g:i a", strtotime($results['startTime']));
$endTime =  date("g:i a", strtotime($results['endTime']));

$pdf->createLetter($results['reason'],date('F j, Y',strtotime($results['initialDate'])),date('F j, Y',strtotime($results['dueDate'])),$results['department'],$startTime,$endTime);

$GLOBALS["borrowerName"] = $results['name'];
$type = $results['borrowerType'];
if($type = "Class Rep")
{
	$GLOBALS["borrowerType"] = 'Class Representative';
}
else if($type = "Org Rep")
{
	$GLOBALS["borrowerType"] = 'Organization Representative';
}
else if($type = "PUP Staff")
{
	$GLOBALS["borrowerType"] = $type;
}


$GLOBALS["borrowertype"] = $results['borrowerType'];
$GLOBALS["department"] = $results['department'];

$pdo = pdo();
$sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
	  inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
	  inner join item on iteminfo.itemID_FK = item.itemID
	  inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
	  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 0 and borrowingDetailsID = ? group by itemID_FK;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_GET['borrowid']]);
$pdf->Cell(50,5,'',0,1);
while($row = $stmt->fetch())
{
	$pdf->Cell(50,5,'',0,0);
	$pdf->Cell(50,5,chr(127).' '.$row['itemname'],0,1);
}


$pdf->Output();
?>
