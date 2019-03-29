<?php
  session_start();
  if( $_SESSION["notiToggle"] == 0) {
    $_SESSION["notiToggle"] = 1;
  }
  else {
    $_SESSION["notiToggle"] = 0;
  }
?>