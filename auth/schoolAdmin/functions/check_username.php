<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 

$pdo = pdo();
$username = $_POST['username'];
$sql = "select * from account where userName = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);

if($stmt->rowCOUNT() > 0)
{
	echo '1';
}
else
{
	echo '0';
}

?>