<?php
//Carl Haerrold Cabanias
//Edit and Add
  include 'db.php';
  session_start();

  $office =  $_SESSION['officeid'];
  $name = $_GET['name'];
  $text = $_GET['text'];
  
  $name = trim($name);
  $text = trim($text);
  if($name == "undefined")
  {
	  // mysqli_query($mysqli,"call pup.insertTransaction('$text', $office);"); 
	  mysqli_query($mysqli,"call pup.insertTransaction('$text', '$office');"); 
  }
  else
  {
	// mysqli_query($mysqli,"call pup.updateTransaction($office,'$name','$text');");
     mysqli_query($mysqli,"call pup.updateTransaction('$office','$name','$text');");
  }
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
?>