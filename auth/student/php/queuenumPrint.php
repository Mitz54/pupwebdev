<?php
  session_start();
  echo '-' . $_SESSION['increaseNumber'] . $_SESSION['queueNumber'];
?>