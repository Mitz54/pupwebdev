<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function edittransac()
{
	$pdo = pdo();
	$sql = "UPDATE transaction set transaction = ? where transactionID = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['text'],$_POST['transac_id']]);
}

edittransac();
?>