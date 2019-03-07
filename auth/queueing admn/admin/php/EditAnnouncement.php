<?php
//Carl Haerrold Cabanias
//Edit and Add
  include 'db.php';





  $name = $_GET['name'];
  $text = $_GET['text'];
  
  $name = trim($name);
  $text = trim($text);
  if($name == "undefined")
  {
	  mysqli_query($mysqli,"INSERT INTO announcement(text) VALUES ('$text')"); 
  }
  else
  {
  mysqli_query($mysqli,"UPDATE announcement SET text = '$text' WHERE text = '$name'");
  }
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
?>