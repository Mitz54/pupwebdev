
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Course_Functions.php";


$oldCourseID = trim($_POST['oldCourseID']);
$newCourseID = trim($_POST['newCourseID']);
$courseTitle = trim($_POST['courseTitle']);
// validate here!

//update courseTitle
if($oldCourseID == $newCourseID ){
	echo "updated";

	updateCourse($con, $oldCourseID, $newCourseID , $courseTitle);
}else{
	$newCleanID = clean($newCourseID);
	$oldCleanID = clean($oldCourseID);
	$replace_query = replace_query("courseID");
	// make sure newCourseID  does not exist
	$sql = 'SELECT courseID FROM course WHERE '.$replace_query.' = ? AND '.$replace_query.' NOT LIKE "'.$oldCleanID.'"';
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $newCleanID);
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