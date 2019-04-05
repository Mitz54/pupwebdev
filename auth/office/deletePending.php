<?php
session_start();
 include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); 
  $staffID = $_SESSION['accntID'];
  $date = $_GET['date'];
  $thisID = $_GET['qtID'];

  $sql = "DELETE FROM queueingtransaction WHERE queueingTransactionID=".$thisID;

  $query = mysqli_query($con,"Call updateQueueTable('$thisID','$staffID','$date')");

  if($query){
	
	
    header('location: queuePerOffice.php');
  }
  else{
	  
	  echo "Error";
  }
