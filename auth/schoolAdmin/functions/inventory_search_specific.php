<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';
function getquantity($itemid,$donatorid)
{
  $conn = conn();
  $escapedonatorid = mysqli_real_escape_string($conn, $donatorid);
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT *,item.name as itemname FROM iteminfo INNER JOIN item ON item.itemID = iteminfo.itemID_FK INNER JOIN donator ON donator.donatorID = iteminfo.donatorID_FK
          WHERE donatorID = '$donatorid' and itemID = '$itemid';";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function createtable()
{
  $conn = conn();
  $search = mysqli_real_escape_string($conn,$_POST['search']);
  $sql = "select * from item inner join iteminfo on iteminfo.itemID_FK = item.itemID where item.name like concat('%','".$search."','%');";
  $result = $conn->query($sql);

  
  if ($result->num_rows > 0) 
  {
    echo "<table class='table table-bordered table-hover'>";
    echo '<thead class="thead-light">
            <tr>
              <th scope="col" >ID</th>
              <th scope="col" >Item Name</th>
              <th scope="col" >Serial Number</th>
              <th scope="col" >Condition</th>
              <th scope="col" >Borrowable</th>
              <th scope="col" >Actions</th>
            </tr>
          </thead>';
    echo "<tbody>";
    
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      $borrow = $row['borrowable'];
      if($borrow == 1)
      {
        $borrow = "Yes";
      }
      else
      {
        $borrow = "No";
      }

      echo "<tr>
        <td>" . $row['itemInfoID'] . "</td>
        <td>" . $row['name'] . "</td>
        <td>" . $row['serialNumber'] . "</td>
        <td>" . $row['condition'] . "</td>
        <td>" . $borrow. "</td>".
        '<td><center>
        <button type="button" name="edit" id="'.$row['itemInfoID'].'" class="btn btn-sm btn-secondary edit_data_specific">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" name="edit" id="'.$row['itemInfoID'].'" class="btn btn-sm btn-secondary delete_data_specific">
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