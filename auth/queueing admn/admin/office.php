<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/header.php' ?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev-kiosk/assets/stylesheet/admin.css" >

<script type="text/javascript">	// VALIDATIONS
		function UpdateConfirmation()
		{
			if (!confirm("Are you sure?"))
			{
				return false;
			}
		}
</script>
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
					require 'php\db.php';
					$result2 = $mysqli->query("call pup.updateRoomIDinOffice('$officeID', '$newroom');");
					if(! empty( $mysqli->error ) ){
					   echo $mysqli->error;  // <- this is not a function call error()
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
				$message = 'You successfully updated a total of ' . $rchangecounter . ' number Offices!';
				echo "<script type='text/javascript'>alert('$message')</script>";
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
            <form action="room.php" method="post" onsubmit="return CheckSameRoom();">
			  <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-sm-8"><h2>Room</h2></div>
                    <div class="col">
					  <input class="btn btn-info update" onclick = "return UpdateConfirmation();" value="UPDATE" type="Submit" style="margin-left: 100px;" name="updateOfficeRoom"/>
					  <button class="btn btn-info cancel" type="button" onClick="window.location.reload()" >CANCEL</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 60%" scope="col">Office</th>
                      <th style="width: 10%" scope="col">Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php	//Office and DropdownList Room Table
					foreach($officeinfos as $officeinfo)
					{
						echo '<tr>';
						echo '<td>'  . $officeinfo['officeName'] . '</td>';
						echo '<td>';
						echo '<select name="$rooms[]" class="dropdown" id="room">';
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
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/footer.php' ?>

<script src="/pupwebdev-kiosk/auth/admin/scripts/Room.js" type="text/javascript"></script>