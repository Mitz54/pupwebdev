<?php
session_start();
  include_once 'includes/databse.php';
  $staffID = $_SESSION['accntID'];
  $dateToday = date("Y-m-d");
  $thisID = $_GET['qtID'];

  $sql = "DELETE FROM queueingtransaction WHERE queueingTransactionID=".$thisID;

  $query = mysqli_query($conn,"Call updateQueueTable('$thisID','$staffID')");

  if($query){
	
	
    header('location: per_queue_offices.php');
  }
  else{
	  
	  echo "Error";
  }
