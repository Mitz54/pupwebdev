<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Course_Functions.php";

$courseID = trim($_POST['courseID']);
$courseTitle = trim($_POST['courseTitle']);

$cleanID = clean($courseID);
$replace_query = replace_query("courseID");
// validate here!
// make sure newCourseID  does not exist
// $sql = 'SELECT courseID FROM course WHERE courseID = ?';
$sql = 'SELECT courseID FROM course WHERE  '.$replace_query.' = ?';
// $sql = 'SELECT courseID FROM course WHERE courseID = ? OR ( '.$like_query.' )';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $cleanID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertCourse($con, $courseID , $courseTitle);
}
?>