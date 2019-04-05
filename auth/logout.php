<?php
  session_start();
  unset($_SESSION['username']);
  unset($_SESSION['office']);
  unset($_SESSION['accntID']);
  unset($_SESSION['accountType']);
  header("Location: ../index.php");
  exit;
 ?>