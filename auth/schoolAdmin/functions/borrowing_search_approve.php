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
  $search = mysqli_real_escape_string($conn,$_POST['search']);
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
		  inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
		  inner join item on iteminfo.itemID_FK = item.itemID
		  inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
		  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 1 and borrower.name like concat('%','".$search."','%') group by borrowingDetailsID_FK;";
  $result = $conn->query($sql);

 
  if ($result->num_rows > 0) 
  {
  	  echo "<table class='table table-bordered table-hover'>";
	  echo "<thead class='thead-light'>
	          <tr>
	            <th scope='col' >No</th>
	            <th scope='col' >Borrower's Name</th>
	            <th scope='col' >Item</th>
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
          <td>" . $row['itemname'] . "</td>
          <td>" . $row['dueDate']. "</td>".
          "<td>" . getquantity($row['borrowingDetailsID_FK']). "</td>";
        echo '<center>
        		<td>
              		<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary remove_approve_item" data-toggle="modal" data-target="#actionDeleteItemModal"><i class="fas fa-times"></i></button>
              	</td>
              </center>';
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