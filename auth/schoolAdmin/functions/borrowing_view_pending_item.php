<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getborrowable($itemid)
{
  $many = 0;
  $pdo = pdo();
  $sql = "select * from iteminfo where itemID_FK = ? and borrowable = 1;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid]);

  while($row = $stmt->fetch())
  {
    $iteminfoid = $row['itemInfoID'];
    if(checkborrowable($iteminfoid) == 0)
    {
      $many = $many + 1;
    }

  }

  return $many;
}

function checkborrowable($iteminfoid)
{
  $pdo = pdo();
  $sql = "select * from borroweditems 
      inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
      inner join item on iteminfo.itemID_FK = item.itemID
      inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
      inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID 
      where itemInfoID_FK = ? and verified_items = 1 and verified = 1 group by itemInfoID_FK;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$iteminfoid]);
  $row = $stmt->rowCOUNT();

  return $row;
}

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
		  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 0 and borrowingDetailsID = ? group by itemID_FK;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_POST['borrowid']]);

 
  if ($stmt->rowCOUNT() > 0) 
  {
  	  echo "<table class='table table-bordered table-hover'>";
	  echo "<thead class='thead-light'>
	          <tr>
	            <th scope='col' >No</th>
	            <th scope='col' >Borrower's Name</th>
	            <th scope='col' >Item</th>
	            <th scope='col' >Due Date</th>
	            <th scope='col' >Quantity</th>
              <th scope='col' >Available Quantity</th>
	          </tr>
	        </thead>";
	  echo "<tbody>";
      // output data of each row
      while($row = $stmt->fetch()) 
      {
        echo "<tr>
          <td>" . $row['borrowingDetailsID'] . "</td>
          <td>" . $row['borrowname'] . "</td>
          <td>" . $row['itemname'] . "</td>
          <td>" . $row['dueDate']. "</td>".
          "<td>" . getquantity($row['itemID']). "</td>".
           "<td>" . getborrowable($row['itemID']). "</td>";
        echo "</tr>"; 
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