<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function additem($itemname,$description,$itemid)
{
  $conn = conn();
  $escapeitemname = mysqli_real_escape_string($conn, $itemname);
  $escapedescription = mysqli_real_escape_string($conn, $description);
  $sql = "UPDATE item set name='$escapeitemname',description='$escapedescription' where itemID = '$itemid'";

  mysqli_query($conn,$sql);

  $conn->close();
}

additem($_POST['itemname'],$_POST['description'],$_POST['itemid'])



?>