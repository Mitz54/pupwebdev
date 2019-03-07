<?php

include_once 'db.php';

  $transID = $_GET['transID'];
  $officeID =$_GET['officeID'];

  $sql = "DELETE FROM transaction WHERE transactionID = ".$transID.";";
  $result = mysqli_query($mysqli,$sql);



  header('location: ../transaction.php?office='.$officeID.'&submit=');
