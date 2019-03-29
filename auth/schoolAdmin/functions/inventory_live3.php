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
  $sql = "SELECT *,item.name as itemname FROM iteminfo INNER JOIN item ON item.itemID = iteminfo.itemID_FK INNER JOIN donator ON donator.donatorID = iteminfo.donatorID_FK
          WHERE donatorID_FK > 0 and donatorID !=1 ;";
  $result = $conn->query($sql);

  $i = 0;
  if ($result->num_rows > 0) 
  {
    echo "<table class='table table-bordered table-hover'>";
  echo '<thead class="thead-light">
          <tr>
            <th scope="col" >ID</th>
            <th scope="col" >Donator</th>
            <th scope="col" >Item</th>
            <th scope="col" >Date</th>
          </tr>
        </thead>';
  echo "<tbody>";
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {

          echo "<tr>
          <td>" . $row['itemID'] . "</td>
          <td>" . $row['name'] . "</td>
          <td>" . $row['itemname'] . "</td>
          <td>" . $row['acquisitionDate']. "</td>";
          echo "</tr>"; 
      }
  }
  else 
  {
    echo "<center>No Item</center>";
  }
  echo "</tbody>";
  echo "</table>";

  $conn->close();
}
  
createtable();
  

?>