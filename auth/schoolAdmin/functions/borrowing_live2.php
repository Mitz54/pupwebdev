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
where borrowingDetailsID_FK = $escapedonatorid and verified_items = 1;";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function checkifverify($borrowingdetailsid,$iteminfoid)
{
  $pdo = pdo();
  $sql = "select * from borroweditems where borrowingDetailsID_FK = ? and verified_items = 1 and itemInfoID_FK = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowingdetailsid,$iteminfoid]);

  return $stmt->rowCOUNT();
}

function checkitems($borrowingdetailsid)
{
  $pdo = pdo();
  $sql = "select * from borroweditems inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
          where borrowingDetailsID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowingdetailsid]);
  $checker = 0;

  while($row = $stmt->fetch())
  {
    if(checkifverify($borrowingdetailsid,$row['itemInfoID_FK']) > 0)
    {
      $checker = $checker + 1;
    }
  }

   return $checker;
}

function approveitem($borrowingdetailsid)
{
  $pdo = pdo();
  $sql = "update borrowingdetails set verified = 3 where borrowingDetailsID = ? ;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowingdetailsid]);
}

function createtable()
{
  $conn = conn();
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
		  inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
		  inner join item on iteminfo.itemID_FK = item.itemID
		  inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
		  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 1 group by borrowingDetailsID_FK;";
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
        if(checkitems($row['borrowingDetailsID_FK']) > 0)
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
        else
        {
          approveitem($row['borrowingDetailsID_FK']);
        }
        
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