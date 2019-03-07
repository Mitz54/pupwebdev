
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Subject_Functions.php";

$subjectID = $_POST['subjectID'];
deleteSubject($con, $subjectID);

?>