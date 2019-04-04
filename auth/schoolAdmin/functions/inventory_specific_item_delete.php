<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function deleteitem($iteminfoid)
{
  $conn = conn();
  $sql = "UPDATE iteminfo set status = 0 where itemInfoID = '$iteminfoid'";

  mysqli_query($conn,$sql);

  $conn->close();
}

deleteitem($_POST['iteminfoid'])



?>