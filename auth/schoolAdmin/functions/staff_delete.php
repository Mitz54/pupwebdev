<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 

function deletestaff($professorid)
{
	$pdo = pdo();
	$sql ="update account set status = 0 where professorID_FK = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$professorid]);
}

deletestaff($_POST['profid']);
?>