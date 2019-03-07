<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function returnitem()
{
	$pdo = pdo();
	$sql = "update borroweditems set verified_items = 2 where borrowingDetailsID_FK = ? and itemInfoID_FK = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['borrowingid'],$_POST['iteminfoid']]);
}

returnitem();

?>