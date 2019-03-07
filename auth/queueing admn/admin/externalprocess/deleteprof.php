<?php

  include_once("../../../db.php");

  $thisID = $_GET['submit'];

  $sql = "DELETE FROM account WHERE professorID_FK = ".$thisID.";";

  $query = mysqli_query($mysqli,$sql);


  header('location: ../professor.php');
?>