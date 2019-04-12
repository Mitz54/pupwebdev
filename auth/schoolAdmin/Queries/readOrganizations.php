<?php
          $query = $con->query("SELECT * FROM organizations");

                  $rowCount = $query->num_rows;
                  if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      {
                        echo '<option value='.$row['org_ID'].'>'.$row['org_ID'].'</option>';
                      }
                    }
                  else
                    {
                      echo'<option value="">Organization not available</option>';
                    }
                    mysqli_next_result($con);
                
?>