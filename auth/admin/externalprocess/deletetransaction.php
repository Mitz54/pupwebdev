<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

  $transID = $_GET['transID'];
  $officeID =$_GET['officeID'];

  $sql = "DELETE FROM transaction WHERE transactionID = ".$transID.";";
  $result = mysqli_query($con,$sql);



  header('location: ../transaction.php?office='.$officeID.'&submit=');
