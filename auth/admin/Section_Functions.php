<?php
/* comments
	why courseID is varchar(60) here

*/

//mysqli
// insert Section to database
function insertSection(mysqli $conn, $sectionID, $courseID, $yearLevel){
	
	// call insertSection stored proc
	$sql = 'CALL insertSection(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssi", $sectionID, $courseID, $yearLevel);
	$stmt->execute();

}
// update Section from database 
function updateSection(mysqli $conn, $oldSectionID, $newSectionID, $courseID, $yearLevel){

	// call updateSection stored proc
	$sql = 'CALL updateSection(?,?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssi", $oldSectionID, $newSectionID, $courseID, $yearLevel);
	$stmt->execute();

}
// delete Section from database 
function deleteSection(mysqli $conn, $sectionID){

	// call deleteSection stored proc
	$sql = 'CALL deleteSection(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $sectionID);
	$stmt->execute();
}

?>