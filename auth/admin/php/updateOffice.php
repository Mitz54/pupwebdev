
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
// include "Section_Functions.php";
$officeid = $_POST['officeID'];
$officename = $_POST['officename'];
$officeroom = $_POST['officeroom'];
$officecode = $_POST['officecode'];
	
	// call insertSection stored proc
$sql = 'CALL updateOffice(?,?,?,?)';
$stmt = $con->prepare($sql);
$stmt->bind_param("isss",$officeid, $officename, $officeroom, $officecode);
$stmt->execute();
// echo "$officeid $officename $officecode $officeroom";

?>