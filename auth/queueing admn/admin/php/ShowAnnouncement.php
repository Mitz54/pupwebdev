<?php
//Carl Haerrold Cabanias 
  include 'db.php';



// run query
$query = mysqli_query($mysqli,"SELECT * FROM announcement");

// set array
$array = array();

// look through query
while($row = mysqli_fetch_assoc($query)){

  // add each row returned into an array
  $array[] = $row;

  // OR just echo the data:


}






?>