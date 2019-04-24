<?php
include "QValidate_Functions.php";
//mysqli
// insert Subject to database
function insertSubject(mysqli $conn, $subjectID, $subjectTitle){
	
	// call insertSubject stored proc
	$sql = 'CALL insertSubject(?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $subjectID, $subjectTitle);
	$stmt->execute();

}
// update Subject from database 
function updateSubject(mysqli $conn, $oldsubjectID, $newsubjectID, $subjectTitle){

	// call updateSubject stored proc
	$sql = 'CALL updateSubject(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $oldsubjectID, $newsubjectID, $subjectTitle);
	$stmt->execute();

}
// delete Subject from database 
function deleteSubject(mysqli $conn, $subjectID){

	// call deleteSubject stored proc
	$sql = 'CALL deleteSubject(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $subjectID);
	$stmt->execute();

	// Experimental
	if(!$stmt->execute()) echo $stmt->error;
}

?>