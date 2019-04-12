<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$reservationinfo =null;
$query = $con->query("SELECT * FROM reservation as R 
                      INNER JOIN schedule as S ON
                      S.scheduleID = R.scheduleID_FK
                      LEFT JOIN section SE on 
                      R.crowd_affected = SE.sectionID

                       where S.scheduleID =".$_POST['ID']
                      );

                          $rowCount = $query->num_rows;
                          if($rowCount > 0)
                            {
                              while($row=$query->fetch_assoc())
                              {
                                 
                                $reservationinfo = [
                                  $row['reservationUser'],
                                  $row['courseID_FK'],
                                  $row['crowd_affected'],
                                  $row['professorID_FK'],
                                  $row['purposeID_FK'],
                                  $row['remarks'],
                                  $row['reservationType']
                                              ];
                              }
                        }

echo json_encode($reservationinfo);
                     
?>
