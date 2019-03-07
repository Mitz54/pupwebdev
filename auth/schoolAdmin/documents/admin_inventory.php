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
		$this->Cell(55,5,'',0,1);


		
		$this->Cell(0,5,'INVENTORY LIST',0,1,'C');
		

		$this->Cell(55,5,'',0,1);
		$this->Cell(55,5,'',0,1);
		$this->SetFont('Arial','',12);
		//$this->Cell(0,10,'',0,0);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,"Date Printed: ".date("F j, Y"),0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
	}
	function Footer(){
		
		//Go to 2.0 cm from bottom
		$this->SetY(-35);
				
		$this->SetFont('Arial','',8);

		$this->SetFont('Arial','B',12);

		$this->Cell(10,5,'',0,0);
		$this->Cell(50,5,"Prof. Arwin P. Nucum",0,1);
		$this->SetFont('Arial','I',12);
		$this->Cell(10,10,'',0,0);
		$this->Cell(50,5,"Head, Administrative Services",0,1);
		
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
		$this->Cell(15,5,"Item",1,0);
		$this->Cell(26,5,"Start Count",1,0);
		$this->Cell(15,5,"Add",1,0,'C');
		$this->Cell(25,5,"Borrowed",1,0,'C');
		$this->Cell(25,5,"Returned",1,0,'C');
		$this->Cell(25,5,"Defective",1,0,'C');
		$this->Cell(28,5,"Date",1,0,'C');
		$this->Cell(15,5,"Total",1,0,'C');

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




global $item_array;
$item_array = array();

function getquantity($itemid)
{
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo where itemID_FK = '$escapeitemid'";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function gettotalcount($itemid)
{
  $datetotalcount = date('Y-m-d',(strtotime ( '-1 day',strtotime($_POST['date_1']))));
  $pdo = pdo();
  $sql = "select * from iteminfo inner join item on item.itemID = iteminfo.itemID_FK 
          where item.itemID = ? and acquisitionDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$datetotalcount]);
  return $stmt->rowCOUNT();
}

function getborrowed($itemid,$initialdate)
{
  $pdo = pdo();
  $sql = "select * from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
where itemID = ? and initialDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$initialdate]);

  return $stmt->rowCOUNT();
}

function getreturned($itemid,$datereturned)
{
  $pdo = pdo();
  $sql = "select * from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
where itemID = ? and dateReturned = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$datereturned]);
  
  return $stmt->rowCOUNT();
}

function getitemadd($itemid,$acquisitiondate)
{
  $pdo = pdo();
  $sql = "select * from iteminfo inner join item on item.itemID = iteminfo.itemID_FK 
          where item.itemID = ? and acquisitionDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$acquisitiondate]);
  return $stmt->rowCOUNT();
}

function declareitem()
{
  $pdo = pdo();
  $sql = "select * from item";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  while($row = $stmt->fetch())
  {
     global $item_array;
     $item_array[$row['itemID']] = gettotalcount($row['itemID']);
  }
}

$pdf->create();


  declareitem();
  $period = new DatePeriod(
     new DateTime($_POST['date_1']),
     new DateInterval('P1D'),
     new DateTime($_POST['date_2']));

  $date_1 = $_POST['date_1'];
  $date_2 = $_POST['date_2'];
  $datetotalcount = date('Y-m-d',(strtotime ( '-1 day',strtotime($_POST['date_1']))));

  $conn = conn();
  $sql = "SELECT * FROM item";
  $result = $conn->query($sql);

  foreach ($period as $key => $value) 
  {

    $conn = conn();
    $sql = "SELECT * FROM item";
    $result = $conn->query($sql);
    $currentdate = $value->format('Y-m-d'); 

    if(strtotime($currentdate) == strtotime($datetotalcount) || strtotime($currentdate) > strtotime($datetotalcount))
    {
    	$i = 0;
      while($row = $result->fetch_assoc()) 
      {
        global $item_array;

        $item_array[$row['itemID']] = $item_array[$row['itemID']] + getitemadd($row['itemID'],$currentdate);
        $item_array[$row['itemID']] = $item_array[$row['itemID']] - getborrowed($row['itemID'],$currentdate);
        $item_array[$row['itemID']] = $item_array[$row['itemID']] + getreturned($row['itemID'],$currentdate);

        $i = $i + 1;
        $pdf->Cell(10,10,'',0,0);
		$pdf->Cell(15,10, $row['name'],1,0);
		$pdf->Cell(26,10,gettotalcount($row['itemID']),1,0);
		$pdf->Cell(15,10,getitemadd($row['itemID'],$currentdate),1,0);
		$pdf->Cell(25,10,getborrowed($row['itemID'],$currentdate),1,0);
		$pdf->Cell(25,10,getreturned($row['itemID'],$currentdate),1,0);
		$pdf->Cell(25,10,getreturned($row['itemID'],$currentdate),1,0);
		$pdf->Cell(28,10,$currentdate,1,0);
		$pdf->Cell(15,10,$item_array[$row['itemID']],1,1);
		if($i == 24)
		{
			$pdf->AddPage(); //for another page
			$pdf->create();
			$i = 0;
		}	
      }
    }  
  }

  $conn->close();



// $pdf->create();
// $pdo = pdo();
// $sql = "select * from item inner join iteminfo on iteminfo.itemID_FK = item.itemID;";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// $i = 0;
// while($row = $stmt->fetch())
// {
// 	$i = $i + 1;
// 		$pdf->Cell(10,10,'',0,0);
// 		$pdf->Cell(58,5,$row['name'],1,0);
// 		$pdf->Cell(58,5,$row['condition'],1,0);
// 		$pdf->Cell(58,5,$row['serialNumber'],1,1);	
// 	if($i == 26)
// 	{
// 		$pdf->AddPage(); //for another page
// 		$pdf->create();
// 		$i = 0;
// 	}	
// }


// $pdf->AddPage();// for another page
// $pdf->AddPage();// for another page
// $pdf->AddPage();// for another page















$pdf->Output();
?>
