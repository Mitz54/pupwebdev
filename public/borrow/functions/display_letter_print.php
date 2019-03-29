<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getquantity($borrowerid)
{
  $conn = conn();
  $escapedonatorid = mysqli_real_escape_string($conn, $borrowerid);
  $sql = "select * from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
inner join item on iteminfo.itemID_FK = item.itemID
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID 
where borrowingDetailsID_FK = $escapedonatorid;";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function createtable()
{
  $conn = conn();
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
      inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
      inner join item on iteminfo.itemID_FK = item.itemID
      inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
      inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 0 group by borroweditems.borrowingDetailsID_FK;";
  $result = $conn->query($sql);

  echo mysqli_error($conn);
 
  if ($result->num_rows > 0) 
  {
      echo "<table class='table table-bordered table-hover'>";
    echo "<thead class='thead-light'>
            <tr>
              <th scope='col' >No</th>
              <th scope='col' >Borrower's Name</th>
              <th scope='col' >Due Date</th>
              <th scope='col' >Quantity</th>
              <th scope='col'>Actions</th>
            </tr>
          </thead>";
    echo "<tbody>";
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<tr>
          <td>" . $row['borrowingDetailsID'] . "</td>
          <td>" . $row['borrowname'] . "</td>
          <td>" . $row['dueDate']. "</td>".
          "<td>" . getquantity($row['borrowingDetailsID_FK']). "</td>";
        echo '<td>
                <center>

                  <input type="submit" name="'.$row['borrowingDetailsID'].'" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary print_letter_btn" value="Print">
                  </center>
                </td>';
        echo "</tr>"; 
      }
      echo "</tbody>";
      echo "</table>";
  }
  else
  {
    echo "<center>No Data</center>";
  }
  $conn->close();
}
  
createtable();
  

?>