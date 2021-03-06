<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';
function getquantity($itemid)
{
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo where itemID_FK = '$escapeitemid'";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function createtable()
{
  $conn = conn();
  $search = mysqli_real_escape_string($conn,$_POST['search']);
  $sql = "SELECT * FROM item where item.name like concat('%','".$search."','%')";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
    echo "<table class='table table-bordered table-hover'>";
    echo '<thead class="thead-light">
            <tr>
              <th scope="col" width="3%">ID</th>
              <th scope="col" width="15%">Item Name</th>
              <th scope="col" width="60%">Description</th>
              <th scope="col" width="7%">Quantity</th>
              <th scope="col" width="15%">Actions</th>
            </tr>
          </thead>';
    echo "<tbody>";
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      $disable = getquantity($row['itemID']);
      if($disable > 0)
      {
        $disable = "disabled";
      }
      else
      {
        $disable = "";
      }
      echo "<tr>
        <td>" . $row['itemID'] . "</td>
        <td>" . $row['name'] . "</td>
        <td>" . $row['description'] . "</td>
        <td>" . getquantity($row['itemID']). "</td>".
        '<td><center>
        <button type="button" name="edit" id="'.$row['itemID'].'" class="btn btn-sm btn-secondary edit_data_general">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" name="edit" id="'.$row['itemID'].'" '.$disable.' class="btn btn-sm btn-secondary delete_data_general">
          <i class="fas fa-trash-alt"></i>
        </button>
        </td></center>';
      echo "</tr>"; 
    }
    echo "</tbody>";
    echo "</table>";
  }
  else 
  {
    echo "<center>No Results Found</center>";
  }
  

  $conn->close();
}
  
createtable();
  

?>