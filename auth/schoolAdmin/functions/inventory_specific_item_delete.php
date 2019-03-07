<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function deleteitem($iteminfoid)
{
  $conn = conn();
  $sql = "DELETE from iteminfo where itemInfoID = '$iteminfoid'";

  mysqli_query($conn,$sql);

  $conn->close();
}

deleteitem($_POST['iteminfoid'])



?>