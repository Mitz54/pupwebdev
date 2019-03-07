<?php

  // include_once("../../connect/connect.php");
  include 'db.php';
  $transID = $_GET['transID'];
  $officeID =$_GET['officeID'];


  $sql1 = "UPDATE queueingtransaction SET transactionID_FK = NULL WHERE transactionID_FK =".$transID;
  $sql2 = "DELETE FROM transaction WHERE transactionID = ".$transID.";";


  if($delresult1 = mysqli_query($mysqli,$sql1)){
    if($delreusult2 = mysqli_query($mysqli,$sql2)){

    }
    else{
      echo "Go Back Please!";
    }
  }
  else{
    echo "Go Back Please!";
  }

  header('location: ../transaction.php?office='.$officeID.'&submit=');
