<?php

//mysqli
// insert Course to database
function insertCourse(mysqli $conn, $courseID, $courseTitle){
	
	// call insertCourse stored proc
	$sql = 'CALL insertCourse(?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $courseID, $courseTitle);
	$stmt->execute();

}
// update Course from database 
function updateCourse(mysqli $conn, $oldcourseID, $newcourseID, $courseTitle){

	// call updateCourse stored proc
	$sql = 'CALL updateCourse(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $oldcourseID, $newcourseID, $courseTitle);
	$stmt->execute();

}
// delete Course from database 
function deleteCourse(mysqli $conn, $courseID){

	// call deleteCourse stored proc
	$sql = 'CALL deleteCourse(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $courseID);
	$stmt->execute();

	// No cascade on reservation
	// know if execute was successful
	if(!$stmt->execute()) echo $stmt->error;

}

?>