<?php

  include 'db.php';

  
  $key = $_GET['key'];
  mysqli_query($mysqli,"DELETE FROM announcement WHERE announcementID = $key");
  function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}
 
goback();
  
  ?>