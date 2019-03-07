<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

$pdo = pdo();
$sql = "SELECT AUTO_INCREMENT as increment from information_schema.tables where table_name = 'borrowingdetails'
AND table_schema = DATABASE();";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$info = $stmt->fetch();
echo $info['increment'];

?>