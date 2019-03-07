<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 

function deletestaff($professorid)
{
	$pdo = pdo();
	$sql ="delete from professor where professorID = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$professorid]);
}

function deleteaccount($professorid)
{
	$pdo = pdo();
	$sql ="delete from account where professorID_FK = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$professorid]);
}

deleteaccount($_POST['profid']);
deletestaff($_POST['profid']);
?>