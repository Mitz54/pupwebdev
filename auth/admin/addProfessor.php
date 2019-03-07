
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Professor_Functions.php";

$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];

// validate here!



insertProfessor($con, $firstName , $middleName, $lastName);

getProfessorID($con);
?>