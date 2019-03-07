
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Professor_Functions.php";


$professorID = $_POST['professorID'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
// validate here!

updateProfessor($con, $professorID, $firstName , $middleName, $lastName);
echo "updated";
?>