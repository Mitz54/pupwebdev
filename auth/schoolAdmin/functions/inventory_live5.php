<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/dbc/dbc.php';

function getitemoption()
{
  $conn = conn();
  $sql = "SELECT * FROM item";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<option value='".$row['itemID']."'>". $row['name']."</option>";
      }
  }
  $conn->close();
}

function getdonatoroption()
{
  $conn = conn();
  $sql = "SELECT * FROM donator";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "<option value='".$row['donatorID']."'>". $row['name']."</option>";
      }
  }
  $conn->close();
}

echo '<label class="radio-inline"><input type="radio" name="radioitem" id="radioitem" value="singleItem" checked> Single Item</label>
<label class="radio-inline"><input type="radio" name="radioitem" id="radioitem" value="multipleItem"> Multiple Item</label> <br>';

echo  '<label for="itemNumber" id="numberItemLabel" class="d-none">Number of Item</label>
        <input class="form-control d-none" type="text" name="itemNumber" id="itemNumber" maxlength="6" value=""  placeholder="300,150 etc." required>';

echo '<label for="selectItemId">Item Name</label>
        <select class="custom-select" name="selectItemId" id="selectItemId">
          <option disabled selected value="none">Select Item</option>';
          echo getitemoption();
echo    '</select>';
echo ' <label for="selectDonatorId">Donator</label>
        <select class="custom-select" name="selectDonatorId" id="selectDonatorId">';
          echo getdonatoroption();
echo    '</select>';

echo '<label for="condition">Condition</label>
        <input class="form-control" type="text" name="condition" id="condition" maxlength="13"  placeholder="Repaired, etc." required>

        <label for="unitprice">Unit Price</label>
        <input class="form-control" type="number" name="unitprice" id="unitprice" max="999999" placeholder="635, etc." required>

        <label for="serialnumber">Serial Number</label>
        <input class="form-control" type="text" name="serialnumber" id="serialnumber" maxlength="20"  placeholder="bsit345, etc." required>
        <div class="invalid-feedback" id="serialnumber-feedback"></div>

        <label for="whereabouts">Whereabouts</label>
        <input class="form-control" type="text" name="whereabouts" id="whereabouts" maxlength="30"  placeholder="Storage Room, etc." required>

        <label for="borrowable">Status</label>
        <select class="custom-select" name="borrowable" id="borrowable">
          <option value="1">Borrowable</option>
          <option value="0">Unborrowable</option>
        </select>';
?>