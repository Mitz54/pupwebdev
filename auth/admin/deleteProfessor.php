
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Professor_Functions.php";


$professorID = $_POST['professorID'];
deleteProfessor($con, $professorID);

?>