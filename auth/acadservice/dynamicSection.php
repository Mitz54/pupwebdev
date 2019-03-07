<?php

include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');



$course=$_GET["course"];


if($course!="")
{

  echo "<label for='Section'>Section</label>";
  echo"<select class='form-control' type='text' name='Section' id='Section'required>";
  
  $query = $con->query("CALL selectAllSection('$course')"); 
     			
  $rowCount = $query->num_rows;
  if($rowCount > 0)
    {
      while($row=$query->fetch_assoc())
      {
        echo '<option>'.$row['sectionID'].'</option>';
      }
    }
  else
    {
      echo'<option value="">Section not available</option>';
    }
    mysqli_next_result($con);

  echo"</select>";


}

$con->close();

?>
