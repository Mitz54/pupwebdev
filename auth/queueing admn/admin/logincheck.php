<?php 
  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
     header ("Location: ../../index.php");
     echo "<script>alert('Please log in first.');</script>";
     
     die;
  }


  ?>