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

function disablefullgroup()
{
  $pdo = pdo();
  $sql = "SET sql_mode = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $pdo2 = pdo();
  $sql2 = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
  $stmt2 = $pdo2->prepare($sql2);
  $stmt2->execute();
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
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo inner join borroweditems on borroweditems.itemInfoID_FK = iteminfo.itemInfoID where itemID_FK = '$escapeitemid' and verified_items = 2";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function createtable()
{
  $conn = conn();
  $sql = "SELECT * FROM item join iteminfo on iteminfo.itemID_FK = item.itemID group by itemID_FK";
  $result = $conn->query($sql);

  echo "<table class='table table-bordered table-hover'>";
  echo '<thead class="thead-light">
          <tr>
            <th scope="col"> </th>
			<th scope="col">Item Name</th>
			<th scope="col">Description</th>
			<th scope="col">Condition</th>
			<th scope="col">Quantity</th>
      <th scope="col" width="2%">Request Quantity</th>
          </tr>
        </thead>';
  echo "<tbody>";
  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
      	$borrowable = getborrowable($row['itemID']);
      	if($borrowable == 0)
      	{
      		$borrowable = "disabled";
      	}

        $disable = getquantity($row['itemID']);
        if($disable == 0)
        {
          $disable = "disabled";
        }
        else
        {
          $disable = "";
        }
        echo "<tr>
          <td><input type='checkbox' class='checkboxid' ".$borrowable." name='itemid[]' id='".getborrowable($row['itemID'])."' value='".$row['itemID']."''></td>
          <td>" . $row['name'] . "</td>
          <td>" . $row['description'] . "</td>
          <td>" . $row['condition'] . "</td>".
          '<td>'.getborrowable($row['itemID']).'</td>';
          echo "<td><input type='textbox' class='form-control quantity' ".$borrowable." name='".$row['itemID']."' id='quanti".$row['itemID']."' value='0'></td>";
        echo "</tr>"; 
      }
  }
  else 
  {
    echo "0 results";
  }
  echo "</tbody>";
  echo "</table>";

  $conn->close();
}

disablefullgroup();
createtable();
  

?>