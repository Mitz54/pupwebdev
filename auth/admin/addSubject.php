
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Subject_Functions.php";

$subjectID = $_POST['subjectID'];
$subjectTitle = $_POST['subjectTitle'];
// validate here!

// make sure newCourseID  does not exist
$sql = 'SELECT subjectID FROM subject WHERE subjectID = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $subjectID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertSubject($con, $subjectID , $subjectTitle);
}
?>