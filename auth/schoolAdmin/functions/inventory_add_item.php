<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function additem($itemname,$description)
{
  $conn = conn();
  $sql = "INSERT INTO item(name,description) values('$itemname','$description');";

  mysqli_query($conn,$sql);

  $conn->close();
}

additem($_POST['itemname'],$_POST['description'])



?>