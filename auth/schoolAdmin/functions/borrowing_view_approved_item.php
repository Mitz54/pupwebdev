<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getquantity($itemid)
{
  $pdo = pdo();
  $sql = "select * from borroweditems inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
where borrowingDetailsID_FK = ? and itemID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_POST['borrowid'],$itemid]);

  return $stmt->rowCOUNT();
}

function createtable()
{
  $pdo = pdo();
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
		  inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
		  inner join item on iteminfo.itemID_FK = item.itemID
		  inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
		  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 1 and borrowingDetailsID = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_POST['borrowid']]);

 
  if ($stmt->rowCOUNT() > 0) 
  {
  	  echo "<table class='table table-bordered table-hover'>";
	  echo "<thead class='thead-light'>
	          <tr>
              <th scope='col' >✔</th>
	            <th scope='col' >No</th>
	            <th scope='col' >Borrower's Name</th>
	            <th scope='col' >Item</th>
	            <th scope='col' >Due Date</th>
	          </tr>
	        </thead>";
	  echo "<tbody>";
      // output data of each row
      while($row = $stmt->fetch()) 
      {
        if($row['verified_items'] == 1)
        {
          echo "<tr>
          <td><input type='checkbox' class='checkboxid' name='iteminfoid[]' id='".$row['borrowingDetailsID']."' value='".$row['itemInfoID']."''></td>
          <td>" . $row['borrowingDetailsID'] . "</td>
          <td>" . $row['borrowname'] . "</td>
          <td>" . $row['itemname'] . "</td>
          <td>" . $row['dueDate']. "</td>";
          echo "</tr>"; 
        }
      }
      echo "</tbody>";
  	  echo "</table>";
  }
  else
  {
    echo "<center>No Data</center>";
  }
}
  
createtable();

?>