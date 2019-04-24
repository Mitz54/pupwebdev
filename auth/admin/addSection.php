
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Section_Functions.php";

$sectionID = trim($_POST['sectionID']);
$courseID = trim($_POST['courseID']);
$yearLevel = trim($_POST['yearLevel']);

// validate here!
if($yearLevel > 0 && $yearLevel < 6){

	$cleanID = clean($sectionID);
	$replace_query = replace_query("sectionID");
	// make sure Section  does not exist
	$sql = 'SELECT sectionID FROM section WHERE '.$replace_query.' = ?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param("s", $cleanID);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
	    echo "exist";
	}else{

		// make sure courseID is valid
		$sql2 = 'SELECT courseID FROM course WHERE courseID = ?';
		$stmt2 = $con->prepare($sql2);
		$stmt2->bind_param("s", $courseID);
		$stmt2->execute();
		$stmt2->store_result();

		if($stmt2->num_rows > 0)
		{
			echo "success";
			insertSection($con, $sectionID , $courseID, $yearLevel);
		}else{
			echo "invalid";
		}	
	}	
}else{
	echo "year invalid";
}

?>