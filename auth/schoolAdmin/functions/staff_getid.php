<?php
//savepoint validation creation
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getrow()
{
	$pdo = pdo();
	$sql = "select count(*) as row from professor;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$info = $stmt->fetch();

	return $info['row'];
}

function getnewid()
{
	$pdo = pdo();
	$sql = "select * from professor limit ?,1";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([getrow()-1]);
	$info = $stmt->fetch();
	return $info['professorID'] + 1;
}

echo getnewid();
?>