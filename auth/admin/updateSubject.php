
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Subject_Functions.php";


$oldSubjectID = $_POST['oldSubjectID'];
$newSubjectID = $_POST['newSubjectID'];
$subjectTitle = $_POST['subjectTitle'];
// validate here!

//update subjectTitle
if($oldSubjectID == $newSubjectID ){
	echo "updated";

	updateSubject($con, $oldSubjectID, $newSubjectID , $subjectTitle);
}else{
	// make sure newSubjectID  does not exist
	$sql = 'SELECT subjectID FROM subject WHERE subjectID = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $newSubjectID);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
        echo "exist";
	}else{
		echo "success";
		updateSubject($con, $oldSubjectID, $newSubjectID , $subjectTitle);
	}
}
?>