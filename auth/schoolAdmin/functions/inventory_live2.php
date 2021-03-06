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
  $sql = "select * from item inner join iteminfo on iteminfo.itemID_FK = item.itemID where iteminfo.status = 1;";
  $result = $conn->query($sql);

  echo "<table id='table_2' class='table table-bordered table-hover checkbox_table' width='100%' >";
  echo '<thead class="thead-light">
          <tr>
            <th scope="col" >✔</th>
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
        <td><input type='checkbox' name='item_specific_checkbox' id='item_specific_checkbox' value='". $row['itemInfoID'] ."'></td>
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

  $conn->close();
}
  
createtable();
  

?>