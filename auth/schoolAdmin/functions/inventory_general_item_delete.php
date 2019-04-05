<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function deleteitem($itemid)
{
  $conn = conn();
  $sql = "UPDATE item set status = 0 where itemID = '$itemid'";

  mysqli_query($conn,$sql);

  $conn->close();
}

deleteitem($_POST['itemid'])



?>