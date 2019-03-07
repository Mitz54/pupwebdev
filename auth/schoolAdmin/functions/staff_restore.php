<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php'; 

function deletestaff($professorid)
{
	$pdo = pdo();
	$sql ="update professor set status = 1 where professorID = ?;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$professorid]);
}

deletestaff($_POST['profid']);
?>