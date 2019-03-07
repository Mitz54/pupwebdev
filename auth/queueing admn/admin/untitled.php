<?php

include 'php\db.php';

                    $selected = $_POST['selected'];

                    $sql2 = "SELECT * FROM transaction WHERE officeID_FK =".$selected;
                    $result2 = mysqli_query($mysqli,$sql2);
                    
                    while($row2 = mysqli_fetch_array($result2)){
                      $transactionID = $row2['transactionID'];
                      echo'<tr>
									           <td>'.$row2['transaction'].'</td>
									           <td>
                                <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete" onclick = "return UpdateConfirmation();"  title="Delete" data-toggle="tooltip" href = "php/deletetransaction.php?transID='.$transactionID.'&officeID='.$selected.'"><i class="material-icons">&#xE872;</i></a>
                             </td>
								           </tr>';
                    }
                
?>