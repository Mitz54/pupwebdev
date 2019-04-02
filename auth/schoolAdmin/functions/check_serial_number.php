<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 
if(isset($_POST['itemid']))
{
	$pdo = pdo();
	$serialnumber = $_POST['serialnumber'];
	$itemid = $_POST['itemid'];
	$sql = "select * from iteminfo where iteminfoID = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$itemid]);
	$result = $stmt->fetch();

	if($result['serialNumber'] == $serialnumber)
	{
		echo "0";
	}
	else
	{
		echo "1";
	}
}
else
{
	$pdo = pdo();
	$serialnumber = $_POST['serialnumber'];
	$sql = "select * from iteminfo where serialNumber = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$serialnumber]);

	if($stmt->rowCOUNT() > 0)
	{
		echo '1';
	}
	else
	{
		echo '0';
	}
}

?>