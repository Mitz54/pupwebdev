<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

$pdo = pdo();
$sql = "update iteminfo set status = 0;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$pdo2 = pdo();
$sql2 = "update item set status = 0;";
$stmt2 = $pdo2->prepare($sql2);
$stmt2->execute();

?>