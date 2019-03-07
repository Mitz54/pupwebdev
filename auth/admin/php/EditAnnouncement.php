<?php
//Carl Haerrold Cabanias
//Edit and Add
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

  $name = $_GET['name'];
  $text = $_GET['text'];
  
  $name = trim($name);
  $text = trim($text);
  if($name == "undefined")
  {
	  mysqli_query($con,"INSERT INTO announcement(text) VALUES ('$text')"); 
  }
  else
  {
  mysqli_query($con,"UPDATE announcement SET text = '$text' WHERE text = '$name'");
  }
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
?>