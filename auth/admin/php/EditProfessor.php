<?php
//Carl Haerrold Cabanias
//Edit and Add
  include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
  session_start();

  $office =  $_SESSION['office'];
  if($name == "undefined")
  {
	  // mysqli_query($mysqli,"call pup.insertTransaction('$text', $office);"); 
	  mysqli_query($con,"call pup.insertTransaction('$text', '$office');"); 
  }
  else
  {
	// mysqli_query($mysqli,"call pup.updateTransaction($office,'$name','$text');");
     mysqli_query($con,"call pup.updateTransaction('$office','$name','$text');");
  }
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
?>