<?php

	include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

  
  $key = $_GET['key'];
  mysqli_query($con,"DELETE FROM announcement WHERE announcementID = $key");
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
  
  ?>