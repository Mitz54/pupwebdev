<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function deleteitem($itemid)
{
  $conn = conn();
  $sql = "DELETE from item where itemID = '$itemid'";

  mysqli_query($conn,$sql);

  $conn->close();
}

deleteitem($_POST['itemid'])



?>