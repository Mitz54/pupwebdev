<?php
function pdo()
{
	$host = "localhost";
	$user= "root";
	$password= "";
	$dbname = "pup";

	//SET DSN data source name
	$dsn = 'mysql::host='.$host.';dbname='.$dbname;

	//Create a PDO instance
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);//set default fetch object 
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//to use limits

	return $pdo;
}
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


		
		$this->Cell(0,5,'GENERAL ITEM LIST',0,1,'C');
		

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


function getquantity($itemid)
{
  $pdo=pdo();
  $sql = "SELECT * FROM iteminfo where itemID_FK = ?";
  $stmt = $pdo->prepare($sql);
	$stmt->execute([$itemid]);

  return $stmt->rowCOUNT();
}

function getsection($secid)
{
	$pdo=pdo();
	$sql = "call getsectionstud(?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$secid]);
	$secinfo = $stmt->fetch();

	$secname = $secinfo['sectionName'] . " - " . $secinfo['yearName'];

	return $secname;
}

$pdf->create();

$pdo = pdo();
$sql = "select * from item";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$i = 0;
while($row = $stmt->fetch())
{

	$i = $i + 1;
		$pdf->Cell(10,10,'',0,0);
		$pdf->Cell(15,5,$row['itemID'],1,0);
		$pdf->Cell(101,5,$row['name'],1,0);
		$pdf->Cell(58,5,getquantity($row['itemID']),1,1);	
	if($i == 24)
	{
		$pdf->AddPage(); //for another page
		$pdf->create();
		$i = 0;
	}	
}


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
