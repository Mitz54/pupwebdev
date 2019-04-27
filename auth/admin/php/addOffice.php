
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
// include "Section_Functions.php";

$officeName = $_POST['officeName'];
$courseID = $_POST['courseID'];
$officeroom = $_POST['officeroom'];

function insertSection(mysqli $conn, $officeName, $officecode, $yearLevel){
	
	// call insertSection stored proc
	$sql = 'CALL insertOffice(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssi", $officeName, $yearLevel, $officecode);
	$stmt->execute();

}
insertSection($con, $officeName , $officecode, $yearLevel);

?>