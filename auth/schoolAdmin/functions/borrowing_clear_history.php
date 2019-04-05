<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

$pdo = pdo();
$sql = "update borrowingdetails set history = 1;"
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>