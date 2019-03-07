<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');



// run query
$query = mysqli_query($con,"SELECT * FROM announcement");

// set array
$array = array();

// look through query
while($row = mysqli_fetch_assoc($query)){

  // add each row returned into an array
  $array[] = $row;
}
    
foreach($array as $key=>$value): 
						echo '<tr>
						<td>'; 
                            echo $array[$key]['text']; $id = $array[$key]['announcementID']; echo '</td>';


                        echo '<td>
                          <a class="add add2" title="Add" data-toggle="tooltip" ><i class="material-icons">&#xE03B;</i></a>
                          <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                          <a class="delete" onclick = "return UpdateConfirmation();" title="Delete" data-toggle="tooltip" href = "/pupwebdev/auth/admin/php/DeleteAnnouncement.php?key=<?php echo $id ?>"><i class="material-icons">&#xE872;</i></a>
                          <!-- <a class="delete" title="Delete" data-toggle="tooltip"> <i class="material-icons">&#xE872;</i></a> -->
                      </td>  </tr>';
endforeach; 
?>

