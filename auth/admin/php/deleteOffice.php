<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
$officeID = $_POST['officeID'];
function deleteOffice(mysqli $conn, $officeID){

	// call deleteSection stored proc
	$sql = 'CALL deleteOffice(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $officeID);
	$stmt->execute();
}
deleteOffice($con, $officeID);
?>