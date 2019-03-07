<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function insertTransac()
{
	$pdo = pdo();
	$sql = "INSERT into transaction(transaction,officeID_FK) values(?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['text'],$_POST['officeid']]);
}

insertTransac();
?>