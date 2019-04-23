
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
	$newCleanID = clean($newSubjectID);
	$oldCleanID = clean($oldSubjectID);
	$replace_query = replace_query("subjectID");
	// make sure newSubjectID  does not exist
	$sql = 'SELECT subjectID FROM subject WHERE '.$replace_query.' = ? AND '.$replace_query.' NOT LIKE "'.$oldCleanID.'"';
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $newCleanID);
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