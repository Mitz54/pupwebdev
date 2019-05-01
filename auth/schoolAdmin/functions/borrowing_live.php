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

function getquantityitem($itemid,$borrowid)
{
  $pdo = pdo();
  $sql = "select * from borroweditems inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
where borrowingDetailsID_FK = ? and itemID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowid,$itemid]);

  return $stmt->rowCOUNT();
}

function checkAvailability($borrowid)
{
  //echo "<script>console.log( '".$borrowid."' );</script>";
  $pdo = pdo();
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
      inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
      inner join item on iteminfo.itemID_FK = item.itemID
      inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
      inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 0 and borrowingDetailsID = ? group by itemID_FK;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowid]);

  if ($stmt->rowCOUNT() > 0) 
  {
     while($row = $stmt->fetch()) 
      {
        
        if(getquantityitem($row['itemID'],$borrowid) > getborrowable($row['itemID']))
        {
          return 1;
          break;
        }
      }
  }
}

function checkAvailability2($borrowid)
{
  date_default_timezone_set("Asia/Manila");
  $pdo = pdo();
  $sql = "select * from borrowingdetails where borrowingdetailsID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$borrowid]);
  $result = $stmt->fetch();
  $date = strtotime(date("Y-m-d"));
  $duedate = strtotime($result['dueDate']);

  if($date > $duedate)
  {
    return 1;
  }
  else
  {
    return 0;
  }
}

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


function createtable()
{
  $conn = conn();
  $sql = "select *,borrower.name as borrowname,item.name as itemname from borroweditems 
		  inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK
		  inner join item on iteminfo.itemID_FK = item.itemID
		  inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
		  inner join borrower on borrowingdetails.borrowerID_FK = borrower.borrowerID  where verified = 0 group by borrowingDetailsID_FK;";
  $result = $conn->query($sql);

  echo mysqli_error($conn);
 
  if ($result->num_rows > 0) 
  {
  	  echo "<table class='table table-bordered table-hover'>";
	  echo "<thead class='thead-light'>
	          <tr>
	            <th scope='col' >No</th>
	            <th scope='col' >Borrower's Name</th>
	            <th scope='col' >Issued Date</th>
              <th scope='col' >Initial Date</th>
              <th scope='col' >Due Date</th>
	            <th scope='col' >Quantity</th>
              <th scope='col' >Status</th>
	            <th scope='col'>Actions</th>
	          </tr>
	        </thead>";
	  echo "<tbody>";
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        $iDate = new DateTime($row['initialDate']);
        $isDate = new DateTime($row['issueDate']);
        $dDate = new DateTime($row['dueDate']);

        $dDate = $dDate->format("F j, Y");
        $isDate = $isDate->format("F j, Y");
        $iDate = $iDate->format("F j, Y");
        echo "<tr>
          <td>" . $row['borrowingDetailsID'] . "</td>
          <td>" . $row['borrowname'] . "</td>"
          ."<td>" .  $isDate . "</td>"
          ."<td>" .  $iDate . "</td>"
          ."<td>" .  $dDate . "</td>".
          "<td>" . getquantity($row['borrowingDetailsID_FK']). "</td>";

          echo "<td>";
          if(checkAvailability($row['borrowingDetailsID']) == 1)
          {
            echo '<h6 class="text-danger">Insufficient <br> Quantity</h6>';
          }
          else if(checkAvailability2($row['borrowingDetailsID']) == 1)
          {
            echo '<h6 class="text-danger">Due Date</h6>';
          }
          else
          {
            echo '<h6 class="text-success">Good</h6>';
          }
          echo "</td>";

        echo '<td>
                <center>';



              echo'<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary view_pending_item"><i class="fas fa-eye"></i></button> ';

              //echo "<script>console.log( '".checkAvailability($row['borrowingDetailsID'])."' );</script>";
              if(checkAvailability($row['borrowingDetailsID']) == 1)
              {
                echo '<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary approve_pending_item" disabled><i class="fas fa-check"></i></button>';
              }
              else if(checkAvailability2($row['borrowingDetailsID']) == 1)
              {
                echo '<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary approve_pending_item" disabled><i class="fas fa-check"></i></button>';
              }
              else
              {
                echo '<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary approve_pending_item"><i class="fas fa-check"></i></button>';
              }

             



           
              echo'	<button type="button" id="'.$row['borrowingDetailsID'].'" class="btn btn-sm btn-secondary delete_pending_item" data-toggle="modal" data-target="#actionDeleteItemModal"><i class="fas fa-times"></i></button>
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

disablefullgroup();
createtable();
  

?>