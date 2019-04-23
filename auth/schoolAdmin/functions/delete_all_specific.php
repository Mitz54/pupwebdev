<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

$pdo = pdo();
$sql = "update iteminfo set status = 0;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

?>