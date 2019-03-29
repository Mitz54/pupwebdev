<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

echo '<option disabled selected hidden value"">Select Course...</option>';
$query = $con->query("CALL selectAllCourse()");

                          $rowCount = $query->num_rows;
                          if($rowCount > 0)
                            {
                              while($row=$query->fetch_assoc())
                              {
                                echo '<option value='.$row['courseID'].'>'.$row['courseID'].'</option>';
                              }
                            }
                          else
                            {
                              echo'<option value="">Course not available</option>';
                            }
                            mysqli_next_result($con);
?>