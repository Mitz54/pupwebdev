<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

global $item_array;
$item_array = array();

function getquantity($itemid)
{
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo where itemID_FK = '$escapeitemid'";
  $result = $conn->query($sql);

  return $result->num_rows;
}

function gettotalcount($itemid)
{
  $datetotalcount = date('Y-m-d',(strtotime ( '-1 day',strtotime($_POST['date_1']))));
  $pdo = pdo();
  $sql = "select * from iteminfo inner join item on item.itemID = iteminfo.itemID_FK 
          where item.itemID = ? and acquisitionDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$datetotalcount]);
  return $stmt->rowCOUNT();
}

function getborrowed($itemid,$initialdate)
{
  $pdo = pdo();
  $sql = "select * from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
where itemID = ? and initialDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$initialdate]);

  return $stmt->rowCOUNT();
}

function getreturned($itemid,$datereturned)
{
  $pdo = pdo();
  $sql = "select * from borroweditems 
inner join iteminfo on iteminfo.itemInfoID = borroweditems.itemInfoID_FK 
inner join item on item.itemID = iteminfo.itemID_FK
inner join borrowingdetails on borrowingdetails.borrowingDetailsID = borroweditems.borrowingDetailsID_FK
where itemID = ? and dateReturned = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$datereturned]);
  
  return $stmt->rowCOUNT();
}

function getitemadd($itemid,$acquisitiondate)
{
  $pdo = pdo();
  $sql = "select * from iteminfo inner join item on item.itemID = iteminfo.itemID_FK 
          where item.itemID = ? and acquisitionDate = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$itemid,$acquisitiondate]);
  return $stmt->rowCOUNT();
}

function declareitem()
{
  $pdo = pdo();
  $sql = "select * from item";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  while($row = $stmt->fetch())
  {
     global $item_array;
     $item_array[$row['itemID']] = gettotalcount($row['itemID']);
  }
}



function createtable()
{
  declareitem();
  $period = new DatePeriod(
     new DateTime($_POST['date_1']),
     new DateInterval('P1D'),
     new DateTime($_POST['date_2']));

  $date_1 = $_POST['date_1'];
  $date_2 = $_POST['date_2'];
  $datetotalcount = date('Y-m-d',(strtotime ( '-1 day',strtotime($_POST['date_1']))));

  $totalcount = 0;
 

  echo "<table class='table table-bordered table-hover'>";
  echo '<thead class="thead-light">
          <tr>
            <th scope="col" width="12.5%">Item</th>
            <th scope="col" width="12.5%">Start Count</th>
            <th scope="col" width="12.5%">Add</th>
            <th scope="col" width="12.5%">Borrowed</th>
            <th scope="col" width="12.5%">Returned</th>
            <th scope="col" width="12.5%">Defective</th>
            <th scope="col" width="12.5%">Date</th>
            <th scope="col" width="12.5%">Total</th>
          </tr>
        </thead>';
  echo "<tbody>";

  $conn = conn();
  $sql = "SELECT * FROM item";
  $result = $conn->query($sql);

  // while($row = $result->fetch_assoc()) 
  // {
  //   global $item_array;
  //   $item_array[$row['itemID']] = $item_array[$row['itemID']] + getitemadd($row['itemID'],$datetotalcount);
  //   $item_array[$row['itemID']] = $item_array[$row['itemID']] - getborrowed($row['itemID'],$datetotalcount);
  //   $item_array[$row['itemID']] = $item_array[$row['itemID']] + getreturned($row['itemID'],$datetotalcount);



  //   echo "<tr>
  //         <td>" . $row['name'] . "</td>
  //         <td>" . gettotalcount($row['itemID']) . "</td>
  //         <td>" .  getitemadd($row['itemID'],$date_1) . "</td>
  //         <td>" . getborrowed($row['itemID'],$date_1). "</td>".
  //         "<td>" . getreturned($row['itemID'],$date_1). "</td>".
  //         "<td>" . getreturned($row['itemID'],$date_1). "</td>".
  //          "<td>" . $date_1. "</td>".
  //            "<td>" . $item_array[$row['itemID']]. "</td>";
  //       echo "</tr>"; 
  // }

  foreach ($period as $key => $value) 
  {

    $conn = conn();
    $sql = "SELECT * FROM item";
    $result = $conn->query($sql);
    $currentdate = $value->format('Y-m-d'); 
    
    if(strtotime($currentdate) == strtotime($datetotalcount) || strtotime($currentdate) > strtotime($datetotalcount))
    {
      while($row = $result->fetch_assoc()) 
      {
        global $item_array;

        $item_array[$row['itemID']] = $item_array[$row['itemID']] + getitemadd($row['itemID'],$currentdate);
        $item_array[$row['itemID']] = $item_array[$row['itemID']] - getborrowed($row['itemID'],$currentdate);
        $item_array[$row['itemID']] = $item_array[$row['itemID']] + getreturned($row['itemID'],$currentdate);



        echo "<tr>
          <td>" . $row['name'] . "</td>
          <td>" . gettotalcount($row['itemID']) . "</td>
          <td>" .  getitemadd($row['itemID'],$currentdate) . "</td>
          <td>" . getborrowed($row['itemID'],$currentdate). "</td>".
          "<td>" . getreturned($row['itemID'],$currentdate). "</td>".
          "<td>" . getreturned($row['itemID'],$currentdate). "</td>".
           "<td>" . $currentdate. "</td>".
             "<td>" . $item_array[$row['itemID']]. "</td>";
        echo "</tr>"; 
      }
    }  
  }
  echo "</tbody>";
  echo "</table>";

  $conn->close();
}
  
createtable();
  

?>