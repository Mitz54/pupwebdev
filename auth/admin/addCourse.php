<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Course_Functions.php";

$courseID = $_POST['courseID'];
$courseTitle = $_POST['courseTitle'];

// validate here!

// make sure newCourseID  does not exist
$sql = 'SELECT courseID FROM course WHERE courseID = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $courseID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertCourse($con, $courseID , $courseTitle);
}
?>