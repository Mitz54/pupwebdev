<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function deleteitem($borrowingdetailsid)
{
  $pdo = pdo();
  $sql = "UPDATE borrowingdetails SET verified = 2 WHERE borrowingDetailsID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowingdetailsid]);
  setItemAvailable($borrowingdetailsid);
}

function setItemAvailable($borrowingdetailsid)
{
	$pdo = pdo();
	$sql = "UPDATE borroweditems SET verified_items = 2 where borrowingDetailsID_FK = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$borrowingdetailsid]);
}

deleteitem($_POST['borrowingdetailsid'])



?>