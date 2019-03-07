<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function approveitem($borrowingdetailsid)
{
  $conn = conn();
  $sql = "update borrowingdetails set verified = 3 where borrowingDetailsID = '$borrowingdetailsid' ;";

  mysqli_query($conn,$sql);

  $conn->close();
}

approveitem($_POST['borrowingdetailsid'])



?>