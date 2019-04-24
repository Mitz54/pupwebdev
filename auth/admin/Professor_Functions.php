
<?php
include "QValidate_Functions.php";

//mysqli
// insert Professor to database
function insertProfessor(mysqli $conn, $firstName, $middleName, $lastName){
	
	// call insertProfessor stored proc
	$sql = 'CALL insertProfessor(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $firstName, $middleName, $lastName);
	$stmt->execute();
}

// update Professor from database 
function updateProfessor(mysqli $conn, $professorID, $firstName, $middleName, $lastName){

	// call updateProfessor stored proc
	$sql = 'CALL updateProfessor(?,?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("isss", $professorID, $firstName, $middleName, $lastName);
	$stmt->execute();

}
// delete Professor from database 
function deleteProfessor(mysqli $conn, $professorID){

	// call deleteProfessor stored proc
	$sql = 'CALL deleteProfessor(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $professorID);
	$stmt->execute();
}

// get ProfessorID from database 
function getProfessorID(mysqli $conn){

	// call deleteProfessor stored proc
	$sql = 'SELECT max(professorID) FROM professor';
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($professorID);
 	while ($stmt->fetch()) {

	// echo recently created professor
	echo $professorID;
	}
}

?>