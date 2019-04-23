<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getitem()
{
  $pdo = pdo(); 
  $sql = "select count(*) as count from iteminfo where status = 1;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->rowCOUNT();
}

function getborrower()
{
  $pdo = pdo(); 
  $sql = "select count(*) as count from borroweditems 
		inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
		inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  
		where verified = 1 group by borrowingDetailsID_FK;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->rowCOUNT();
}


function getrequest()
{
  $pdo = pdo(); 
  $sql = "select count(*),borrower.name as borrowname,item.name as itemname from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
inner join item on iteminfo.itemID_FK = item.itemID
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  
where verified = 0 group by borrowingDetailsID_FK;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  return $stmt->rowCOUNT();
}

if($_POST['num'] == 1)
{
	echo getitem();
}
else if($_POST['num'] == 2)
{
	echo getborrower();
}
else
{
	echo getrequest();
}

?>