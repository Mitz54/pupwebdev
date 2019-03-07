<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function insertAnnouncement()
{
	$pdo = pdo();
	$sql = "INSERT into announcement(text) values(?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['text']]);
}

insertAnnouncement();
?>