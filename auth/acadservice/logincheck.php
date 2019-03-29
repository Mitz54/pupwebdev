<?php 
  if(!isset($_SESSION['username']) || empty($_SESSION['username']))
  {
     echo "<script>alert('Please log in first.');</script>";
     header("Location: ../../index.php");
     exit();
  }
?>