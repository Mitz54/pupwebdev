<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';
function getitemid()
{
  $pdo = pdo();
  $sql = "select * from itemInfo where itemInfoID = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_POST['iteminfoid']]);
  $info = $stmt->fetch();

  return $info['itemID_FK']; 
}

function getitem()
{
  $pdo = pdo();
  $sql = "select * from item;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  echo '<label for="selectItemIdEdit">Item</label>';
  echo '<select class="custom-select" name="selectItemIdEdit" id="selectItemIdEdit">';
    while($row = $stmt->fetch())
    {
      $selected = "";
      if($row['itemID'] == getitemid())
      {
        $selected = "selected";
      }
      echo "<option ".$selected." value='".$row['itemID']."'>".$row['name']."</option>";
    }
  echo '</select>';
}

function getdonator($donatorid)
{
  $pdo = pdo();
  $sql = "select * from donator;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  echo '<label for="selectDonatorId">Donator</label>
        <select class="custom-select" name="selectDonatorIdEdit" id="selectDonatorIdEdit">';
    while($row = $stmt->fetch())
    {
      $selected = "";
      if($row['donatorID'] == $donatorid)
      {
        $selected = "selected";
      }
      echo "<option ".$selected." value='".$row['donatorID']."'>".$row['name']."</option>";
    }
  echo '</select>';
}

function getquantity($itemid)
{
  $conn = conn();
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo where itemID_FK = '$escapeitemid'";
  $result = $conn->query($sql);

  return $result->num_rows;
}

if(isset($_POST['iteminfoid']))
{
  $conn = conn();
  $itemid = $_POST['iteminfoid'];
  $escapeitemid = mysqli_real_escape_string($conn, $itemid);
  $sql = "SELECT * FROM iteminfo inner join item on item.itemID = iteminfo.itemID_FK where iteminfoID = '$escapeitemid'";

  $result = $conn->query($sql);
  $followingdata = $result->fetch_assoc();
  $itemname = $followingdata['name'];
  $description = $followingdata['description'];
  echo "<input type='hidden' name='iteminfoidspecific' id='iteminfoidspecific' value='".$_POST['iteminfoid']."'>";
  echo '<div class="form-group">';
            
      echo getitem();
      echo getdonator($followingdata['donatorID_FK']);
      $borrowable = "";
      if($followingdata['borrowable'] == 1)
      {
        $borrowable = '<option selected value="1">Borrowable</option> <option value="0">Unborrowable</option>';
      }
      else
      {
        $borrowable = '<option value="1">Borrowable</option> <option selected value="0">Unborrowable</option>';
      }

      echo '<label for="conditionEdit">Condition</label>
            <input class="form-control" type="text" name="conditionEdit" id="conditionEdit" maxlength="13" value="'.$followingdata['condition'].'" placeholder="Repaired, etc." required>

            <label for="unitpriceEdit">Unit Price</label>
            <input class="form-control" type="number" name="unitpriceEdit" id="unitpriceEdit" max="999999" value="'.$followingdata['unitPrice'].'" placeholder="635, etc." required>

            <label for="serialnumberEdit">Serial Number</label>
            <input class="form-control" type="text" name="serialnumberEdit" id="serialnumberEdit" maxlength="20" value="'.$followingdata['serialNumber'].'"  placeholder="bsit345, etc." required>

            <label for="acquisitionEdit">Acquisition Date</label>
            <input class="form-control" type="date" name="acquisitionEdit" id="acquisitionEdit" maxlength="30" value="'.$followingdata['acquisitionDate'].'" placeholder="Storage Room, etc." required>

            <label for="whereaboutsEdit">Whereabouts</label>
            <input class="form-control" type="text" name="whereaboutsEdit" id="whereaboutsEdit" maxlength="30" value="'.$followingdata['whereabouts'].'" placeholder="Storage Room, etc." required>

            <label for="remarksEdit">Remarks</label>
            <input class="form-control" type="text" name="remarksEdit" id="remarksEdit" maxlength="30" value="'.$followingdata['remarks'].'" placeholder="Storage Room, etc." required>

            <label for="condemndateEdit">Condemn Date</label>
            <input class="form-control" type="date" name="condemndateEdit" id="condemndateEdit" maxlength="30" value="'.$followingdata['dateOfCondemn'].'" placeholder="Storage Room, etc." required>

            <label for="borrowableEdit">Status</label>
            <select class="custom-select" name="borrowableEdit" id="borrowableEdit">
              '.$borrowable.'
            </select>
          </div>';
}
  
  

?>