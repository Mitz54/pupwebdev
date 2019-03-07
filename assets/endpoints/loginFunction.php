<?php

$loginPageUrl = '/pupwebdev/index.php';
$dashboardAdminUrl = '/pupwebdev/auth/acadservice/acadService_Scheduler.php';

$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = raw_inputData($_POST["profileUsername"]);
  $password = raw_inputData($_POST["profilePassword"]);

  if ($username == "admin" && $password == "demo") {
    header('Location: ' . $dashboardAdminUrl, 301); exit;
  } else {
    header('Location: ' . $loginPageUrl, 301); exit;
  }
}

function raw_inputData($processedData) {
  $processedData = trim($processedData);
  $processedData = stripslashes($processedData);
  $processedData = htmlspecialchars($processedData);
  return $processedData;
}

?>
