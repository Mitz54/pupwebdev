
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
// include "Section_Functions.php";

$officename = $_POST['officename'];
$officeroom = $_POST['officeroom'];
$officecode = $_POST['officecode'];
	
	// call insertSection stored proc
$sql = 'CALL insertOffice(?,?,?)';
$stmt = $con->prepare($sql);
$stmt->bind_param("sss", $officename, $officeroom, $officecode);
$stmt->execute();
// echo "$officename $officecode $officeroom";

?>