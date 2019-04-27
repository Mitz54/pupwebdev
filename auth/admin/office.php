<?php session_start();
require "logincheck.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php' ?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<script type="text/javascript">	// VALIDATIONS
		function UpdateConfirmation()
		{
			// var samecounter = 0;
			// $('#room').prop('selected', function() {
			// 		if (this.defaultSelected)
			// 		{
			// 			this.selected = true;
			// 			samecounter++;
			// 		}
				
			// });
			// if(sameCounter == 8)
			// 		{
			// 			alert("No changes made...");
			// 			return false;
			// 		}
			if (!confirm("Are you sure?"))
			{
				return false;
			}
		}
		function NoChanges()
		{
			// if (!confirm("no changes was made in office table."))
			// {
			// 	return false;
			// }
			alert("no changes was made in office table.");
		}
</script>
<style>
.col main-content {
	margin: 0px;
	padding: 0px;
	top: 0px;
}
.hidden {
				display: none;
}    
.cancel {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
}

.update {
    float: right;
    height: 30px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
    margin-right: 5px;
}

</style>

<?php
	$officeinfos = require 'php\GetOfficeInfo.php';
	$roominfos = require 'php\GetRoomInfo.php';
	if (isset($_POST['updateOfficeRoom']))	//submitted
	{
		$x = 0;	// index of room information
		$row1 = 0;
		$row2 = 0;
		$rsameroom = 0;
		$rchangecounter = 0;
		foreach($_POST['$rooms'] as $_POST['$room1'])	// check if 1 or more room was selected for offices
		{
			foreach($_POST['$rooms'] as $_POST['$room2'])
			{
				if($_POST['$room1'] == $_POST['$room2'] && ($row1 != $row2))
				{
					$rsameroom++;
					break;
				}
				$row2++;
			}
			$row1++;
			$row2 = 0;
		}
		if($rsameroom == 0)	// No same room
		{
			foreach($_POST['$rooms'] as $_POST['$room']) 	// check if there are changes made
			{
				if($_POST['$room'] != $officeinfos[$x]['roomID'])
				{
					$officeID = $officeinfos[$x]['officeID'];
					$newroom = $_POST['$room'];
					include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); 
					$result2 = $con->query("call pup.updateRoomIDinOffice('$officeID', '$newroom');");
					if(! empty( $con->error ) ){
					   echo $con->error;  // <- this is not a function call error()
					}
					else
					{
						$rchangecounter++;
					}
				}
				$x++;
			}
			if($rchangecounter == 0) //no changes, throw error
			{

				$message = 'Advisory: There is no changes made in room assignation';
				echo "<script type='text/javascript'>alert('$message')</script>";
			}
			else	// successful
			{
				// $message = 'You successfully updated a total of ' . $rchangecounter . ' room assigned in offices!';
				// echo "<script type='text/javascript'>alert('$message')</script>";
				$officeinfos = require 'php\GetOfficeInfo.php';
				$roominfos = require 'php\GetRoomInfo.php';
			}
		}
		else	// has same room throw error message
		{
			$message = 'Not allowed to pick same room for 2 or more offices';
			echo "<script type='text/javascript'>alert('$message')</script>";
		}
		
	}
?>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
            <form action="office.php" method="post" onsubmit="return CheckSameRoom();">
			  <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
								<?php
									echo "<select id='room-id-options' class='hidden col form-control selector'>".
                                    "<option selected>All</option>";
                                    foreach ($roominfos as $roominfo) {
                                      echo "<option>".$roominfo['roomID']."</option>";
                                    }                                 
                                echo "</select>";
								?>
                  <div class="row">
                    <div class="col-sm-8"><h2>Office</h2></div>
										<button class="btn btn-info add-new" type="button" id="button-search"><i class="fa fa-plus "></i>Add New
					  <!-- <input class="btn btn-info update" onclick = "return UpdateConfirmation();" value="UPDATE" type="Submit" style="margin-left: 100px;" name="updateOfficeRoom"/> -->
					  <!-- <button class="btn btn-info cancel" id="reset" type="button" >RESET</button> -->
						<!-- <input 	class="btn btn-info cancel" type="reset" id="reset" value="RESET" /> -->
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 60%" scope="col">Office</th>
											<th style="width: 10%" scope="col">OfficeCode</th>
                      <th style="width: 10%" scope="col">Room</th>
											<th style="width: 10%" scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php	//Office and DropdownList Room Table
					foreach($officeinfos as $officeinfo)
					{
						
						echo '<tr>';
						
						//id storage
						echo "<td class = 'hidden officeID'>".
						"<input type='hidden' class = 'old-value' value=". $officeinfo['officeID']." />".
						"</td>";

						//office cell
						echo '<td>'  . $officeinfo['officeName'] . '</td>';

						//office code cell
						echo '<td>'  . $officeinfo['officeCode'] . '</td>';

						//room cell
						echo '<td>';
						// echo "<td class = 'editableColumns roomID'>"  . $officeinfo['roomID'] . "</td>";
						echo '<select disabled name="$rooms[]" id="room" class="form-control new-value">';
						foreach($roominfos as $roominfo)
						{
							if($roominfo['roomID'] != $officeinfo['roomID'])
							{
									echo '<option value=' . $roominfo['roomID'] . '>' . $roominfo['roomID'] . '</option>';
							}
							else
							{
								echo '<option selected="selected" value=' . $roominfo['roomID'] . '>' . $roominfo['roomID'] . '</option>';
							}
						}
						echo '</select>';
						echo '</td>';

						//action cell
						echo '<td>';
						echo '<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>';
						echo '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>';
						echo '<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>';
						echo '</td>';

						echo '</tr>';
                    }
				  ?>
                  </tbody>
                </table>
              </div>
			  </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<script src="/pupwebdev/auth/admin/scripts/Office.js" type="text/javascript"></script>
<script type="text/javascript">
$("#reset").on("click", function () {
    $('#room').prop('selected', function() {
        return this.defaultSelected;
    });
});
</script>
