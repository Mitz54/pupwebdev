<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getquantity()
{
  $conn = conn();
  $sql = "select count(*) from iteminfo";
}

function getitemoption()
{
  $conn = conn();
  $sql = "SELECT * FROM item";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<option value='".$row['itemID']."'>". $row['name']."</option>";
      }
  }
  $conn->close();
}

function getdonatoroption()
{
  $conn = conn();
  $sql = "SELECT * FROM donator";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<option value='".$row['donatorID']."'>". $row['name']."</option>";
      }
  }
  $conn->close();
}

function getitems()
{
  $conn = conn();
  $sql = "SELECT * FROM item INNER JOIN iteminfo ON iteminfo.itemID_FK = item.itemID 
  WHERE iteminfo.condition=1;";
  $sql2 = "SELECT * FROM ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<tr>
          <td>" . $row['itemID'] . "</td>
          <td>" . $row['name'] . "</td>
          <td>" . $row['description'] . "</td>
          <td>" . $row['name'] . "</td>".
          '<td><center>
          <button type="button" name="edit" id="'.$row['itemID'].'" class="btn btn-sm btn-secondary view_data">
            <i class="fas fa-pencil-alt"></i>
          </button>
          </td></center>';
        echo "</tr>"; 
      }
  }
  else 
  {
    echo "0 results";
  }

  $conn->close();
}




?>