
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Professor_Functions.php";


$professorID = trim($_POST['professorID']);
$firstName = trim($_POST['firstName']);
$middleName = trim($_POST['middleName']);
$lastName = trim($_POST['lastName']);
// validate here!

updateProfessor($con, $professorID, $firstName , $middleName, $lastName);
echo "updated";
?>