<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

$newid = $_POST['newid'];
$lastname = $_POST['staffLastName'];
$firstname = $_POST['staffFirstName'];
$middlname = $_POST['staffMiddleName'];
$username = $_POST['staffUsername'];
$password = $_POST['staffPassword'];
$atype = $_POST['accountType'];

function createstaff()
{
	$pdo = pdo();
	$sql = "INSERT INTO professor(professorID,firstName,middleName,lastName) VALUES(?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['newid'],$_POST['staffLastName'],$_POST['staffFirstName'],$_POST['staffMiddleName']]);
}

function createaccount()
{
	$pdo = pdo();
	$sql = "INSERT INTO account(professorID_FK,userName,password,accountType) VALUES(?,?,?,?);";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$_POST['newid'],$_POST['staffUsername'],$_POST['staffPassword'],$_POST['accountType']]);
}

createstaff();
createaccount();

?>