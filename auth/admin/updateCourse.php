
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Course_Functions.php";


$oldCourseID = $_POST['oldCourseID'];
$newCourseID = $_POST['newCourseID'];
$courseTitle = $_POST['courseTitle'];
// validate here!

//update courseTitle
if($oldCourseID == $newCourseID ){
	echo "updated";

	updateCourse($con, $oldCourseID, $newCourseID , $courseTitle);
}else{
	// make sure newCourseID  does not exist
	$sql = 'SELECT courseID FROM course WHERE courseID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $newCourseID);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
        echo "exist";
	}else{
		echo "success";
		updateCourse($con, $oldCourseID, $newCourseID , $courseTitle);
	}
}
?>