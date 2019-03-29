<?php  
require_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

echo '<option disabled selected hidden value"">Select Professor...</option>';

                    $query = $con->query("CALL SelectAllAllProfessor()");
                    
                    $rowCount = $query->num_rows;

                    if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      {
                        echo '<option value='.$row['professorID'].'>'.$row['lastName'].", ".$row['firstName']." ".$row['middleName'].'</option>';
                      }
                    }

                    else
                      {
                        echo'<option value="">Professor not available</option>';
                      }

                    mysqli_next_result($con);
?>
