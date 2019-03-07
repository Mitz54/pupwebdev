<?php
session_start();
 include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); 
  $staffID = $_SESSION['accntID'];
  $dateToday = date("Y-m-d");
  $thisID = $_GET['qtID'];

  $sql = "DELETE FROM queueingtransaction WHERE queueingTransactionID=".$thisID;

  $query = mysqli_query($con,"Call updateQueueTable('$thisID','$staffID')");

  if($query){
	
	
    header('location: queuePerOffice.php');
  }
  else{
	  
	  echo "Error";
  }
