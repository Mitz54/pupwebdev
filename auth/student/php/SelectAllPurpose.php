  <?php   
  include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
                   $query = $con->query("CALL selectAllPurpose()");

                  $rowCount = $query->num_rows;
                  if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      {
                        echo '<option value='.$row['description'].'>'.$row['description'].'</option>';
                      }
                    }
                  else
                    {
                      echo'<option value="">No available Purpose</option>';
                    }
                    mysqli_next_result($con);
?>