<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

//savepoint approved delete insert date returned
//savepoint insert into borrowing
//savepoint getborrowerid
//insert into borrowed items


function insertborrower()
{
	$pdo = pdo();
	$sql = "insert into borrower(borrowerID,name,contact,borrowerType,department) values(?,?,?,?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['borrowerid'],$_POST['fullname'],$_POST['contactnumber'],$_POST['borrowertype'],$_POST['organization']]);
}

function insertborrowing($borrowingdetailsid,$borrowerid,$issuedate,$duedate,$reason,$stime,$etime,$controlnumber)
{
	$pdo = pdo();
	$sql = "INSERT INTO  borrowingdetails(borrowingDetailsID,borrowerID_FK,initialDate,issueDate,dueDate,verified,reason,startTime,endTime,controlNumber)
			values(?,?,CURDATE(),?,?,0,?,?,?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$borrowingdetailsid,$borrowerid,$issuedate,$duedate,$reason,$stime,$etime,$controlnumber]);
	
}

function borrowitems()
{
	$pdo = pdo();
	$sql = "insert borroweditems(borrowingDetailsID_FK,itemInfoID_FK) values(?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}

function getborrowable($itemid)
{
	$quantity = $_POST['quantityvalue'];
	$pdo = pdo();
	$sql = "select * from iteminfo where itemID_FK = ? and borrowable = 1;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$itemid]);
	//echo print_r($stmt->errorInfo());

	while($row = $stmt->fetch())
	{
		$iteminfoid = $row['itemInfoID'];
		if(checkborrowable($iteminfoid) == 0)
		{
			if($quantity != 0)
			{	
				insertborroweditems($_POST['borrowingdetailsid'],$iteminfoid);
				$quantity = $quantity - 1;
			}
		}
	}
}

function checkborrowable($iteminfoid)
{
	$pdo = pdo();
	$sql = "select * from borroweditems 
			inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
			inner join item on iteminfo.itemID_FK = item.itemID
			inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
			inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID 
			where itemInfoID_FK = ? and verified = 1;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$iteminfoid]);
	$row = $stmt->rowCOUNT();

	return $row;
}

function getallitems()
{
  
  $pdo = pdo();
  $sql = "SELECT * FROM item inner join iteminfo on iteminfo.itemID_FK = item.itemID where itemID = ? group by itemID_FK";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_POST['item']]);

      // output data of each row
      while($row = $stmt->fetch()) 
      {
      	getborrowable($row['itemID']);
        //getborrowable($row['itemID']);
      }
}

function insertborroweditems($borrowingdetailsid,$iteminfoid)
{
	$pdo = pdo();
	$sql = "insert borroweditems(borrowingDetailsID_FK,itemInfoID_FK) values(?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['borrowingdetailsid'],$iteminfoid]);
}

function controlnumber()
{
	$pdo = pdo();
	//$issuedate = date("Y", strtotime($_POST['issuedate']));
	$controlnum = "BO-".date("Y");
	$sql = "select * from borrowingdetails where controlNumber like concat('%', ? ,'%');";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$controlnum]);
	$number = $stmt->rowCOUNT();
	$number =$number + 255;
	$controlnumber = "BO-".date("Y")."-".str_pad($number, 6, '0', STR_PAD_LEFT);;
	return $controlnumber;
}

// controlnumber();

$issuedate = date("Y-m-d", strtotime($_POST['issuedate']));
$duedate = date("Y-m-d", strtotime($_POST['duedates']));
$stime = date("H:i:s", strtotime($_POST['stime']));
$etime =date("H:i:s", strtotime($_POST['etime']));
insertborrower();
insertborrowing($_POST['borrowingdetailsid'],$_POST['borrowerid'],$issuedate,$duedate,$_POST['reason'],$stime,$etime,controlnumber());
// insertborroweditems();
getallitems();

?>