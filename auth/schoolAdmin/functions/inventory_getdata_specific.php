<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getquantity($itemid)
{
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo where itemID_FK = '$escapeitemid'";
  $result = $conn->query($sql);

  return $result->num_rows;
}

if(isset($_POST['itemid']))
{
  $conn = conn();
  $itemid = $_POST['itemid'];
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM item where itemID = '$itemid'";

  $result = $conn->query($sql);
  $followingdata = $result->fetch_assoc();
  $itemname = $followingdata['name'];
  $description = $followingdata['description'];
  echo "<input type='hidden' name='itemidgeneral' id='itemidgeneral' value='".$followingdata['itemID']."'>";
  echo '<div class="form-group">
            <label for="editgeneralitemname">Item Name</label>
            <input class="form-control" type="text" name="editgeneralitemname" id="editgeneralitemname" value="'.$itemname.'" placeholder="Chair, etc." required >
            <label for="editgeneraldescription">Item Description</label>
            <input class="form-control" type="text" name="editgeneraldescription" id="editgeneraldescription" value="'.$description.'" placeholder="a separate seat for one person, etc." required>
          </div>';
} 

?>