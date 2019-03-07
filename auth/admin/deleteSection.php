
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Section_Functions.php";

$sectionID = $_POST['sectionID'];
deleteSection($con, $sectionID);

?>