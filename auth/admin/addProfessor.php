
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Professor_Functions.php";

$firstName = trim($_POST['firstName']);
$middleName = trim($_POST['middleName']);
$lastName = trim($_POST['lastName']);

// validate here!



insertProfessor($con, $firstName , $middleName, $lastName);

getProfessorID($con);
?>