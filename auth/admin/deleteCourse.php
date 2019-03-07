
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Course_Functions.php";

$courseID = $_POST['courseID'];
deleteCourse($con, $courseID);

?>