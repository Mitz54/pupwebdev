<?php

  include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

  $thisID = $_GET['submit'];

  $sql = "DELETE FROM account WHERE professorID_FK = ".$thisID.";";

  $query = mysqli_query($con,$sql);


  header('location: ../account.php');
?>