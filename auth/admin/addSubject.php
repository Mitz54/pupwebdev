
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Subject_Functions.php";

$subjectID = trim($_POST['subjectID']);
$subjectTitle = trim($_POST['subjectTitle']);
// validate here!

$cleanID = clean($subjectID);
$replace_query = replace_query("subjectID");
// make sure newCourseID  does not exist
$sql = 'SELECT subjectID FROM subject WHERE '.$replace_query.' = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $cleanID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertSubject($con, $subjectID , $subjectTitle);
}
?>