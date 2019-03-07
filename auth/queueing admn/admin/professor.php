<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/header.php' ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/db.php' ?>

<?php
  $officeinfos = require 'php\GetOfficeInfo.php';
  include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/db.php';
  // OFFICE VALIDATION
  if (isset($_POST['updateOffice']))	//submitted
	{
    // echo '<script>alert();</script>';
		$x = 0;	// index of room information
		$row1 = 0;
		$row2 = 0;
		$rsameoffice = 0;
		$rchangecounter = 0;
		foreach($_POST['$offices'] as $_POST['$office1'])	// check if 1 or more room was selected for offices
		{
			foreach($_POST['$offices'] as $_POST['$office2'])
			{
				if($_POST['$office1'] == $_POST['$office2'] && ($row1 != $row2))
				{
					$rsameoffice++;
					break;
				}
				$row2++;
			}
			$row1++;
			$row2 = 0;
		}
		if($rsameoffice == 0)	// No same room
		{
			foreach($_POST['$offices'] as $_POST['$office']) 	// check if there are changes made
			{
        // echo '<script>alert(' . $officeinfos[$x]['staffID'] . " ".	$officeinfos[$x]['officeID']  . " " .$_POST['$office'] . ');</script>';
				if($_POST['$office'] != $officeinfos[$x]['officeID'])
				{
          // echo '<script>alert(' . $_POST['$office'] . ' ' . );</script>';
          $officeID = $officeinfos[$x]['officeID'];
          $staffID = $officeinfos[$x]['staffID'];
					$newOffice = $_POST['$office'];
          require 'php\db.php';
          // echo '<script>alert(' . 	$officeID  . ' ' . $newOffice . ');</script>';
					$result3 = $mysqli->query("call pup.updateStaffAssignedInOffice('$staffID','$officeID', '$newOffice');");
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
			}
		}
		else	// has same room throw error message
		{
			$message = 'Not allowed to pick same Office for 2 or more account';
			echo "<script type='text/javascript'>alert('$message')</script>";
		}
	}
      $message = "";
      // get highest value of prof id and add 1 to be used as new id
      // not working

      // for  Professor table input
      if ($_POST)  {
          // EDIT ****************************************************
          // if (isset($_POST['edit'])) {
          //     $sql = "SELECT * FROM account WHERE userName = '$_POST[editusername]' AND professorID_FK != '$_POST[edit]'";
          //     $result = mysqli_query($mysqli, $sql);
          //     if(mysqli_num_rows($result) > 0){
          //           $message .= "Username already exists.";
          //     }             
          //     if ($_POST['editpassword'] != $_POST['editconfirmpassword']) {
          //           $message .= "Password does not match.";
          //     }

          //     if ($message == "") {
          //           // professor
          //           $sql = "UPDATE professor SET firstName = '$_POST[editProf_fname]', middleName = '$_POST[editProf_mname]', lastName = '$_POST[editProf_lname]' WHERE professorID = '$_POST[edit]'";             
          //           mysqli_query($mysqli, $sql);

          //           // account
          //           $password = "";
          //           if($_POST['editpassword'] != "") {
          //             $password = ", password = '$_POST[editpassword]'";
          //           }

          //           $sql = "UPDATE account SET userName = '$_POST[editusername]', accountType = 'admin' $password WHERE professorID_FK = '$_POST[edit]'";
          //           mysqli_query($mysqli, $sql); 

          //           // get last insert account id
          //           $sql = "SELECT accountID AS id FROM account WHERE professorID_FK = '$_POST[edit]' LIMIT 1";
          //           $result = mysqli_query($mysqli, $sql);
          //           $acctId = mysqli_fetch_array($result)['id'];

          //           // office
          //             $sql = "UPDATE office SET staffID_FK = NULL WHERE staffID_FK = '$acctId'";
          //             mysqli_query($mysqli, $sql); 
          //           if ($_POST['editoffice'] != "") {
          //                 $sql = "UPDATE office SET staffID_FK = '$acctId' WHERE officeID = '$_POST[editoffice]'";
          //                 mysqli_query($mysqli, $sql); 
          //           }
          //     }
          // }
          if (isset($_POST['add'])) {
            // ADD **************************************************** 
            $sql = "SELECT * FROM account WHERE userName = '$_POST[username]'";
            $result = mysqli_query($mysqli, $sql);
            if(mysqli_num_rows($result) > 0){
                  $message .= "Username already exists.";
            }             
            if ($_POST['password'] != $_POST['confirmpassword']) {
                  $message .= "Password does not match.";
            }
            if ($_POST['office'] == -1){
              $message .= "No office selected. Please select office.";
            }

            if ($message == "") {
              // professor
              //$sql = "INSERT INTO professor(firstName, middleName, lastName) VALUES('$_POST[addProf_fname]', '$_POST[addProf_mname]', '$_POST[addProf_lname]')";             
              //mysqli_query($mysqli, $sql);
        
              // get last insert professor id
              //$sql = "SELECT professorID AS id FROM professor ORDER BY professorID DESC LIMIT 1";
              //$result = mysqli_query($mysqli, $sql);
              //$profId = mysqli_fetch_array($result)['id'];

              // account

              $userName = $_POST['username'];
              $password = $_POST['password'];
              $profID = $_POST['professorID'];
              $accountType = "admin";

              $sqlins = 'INSERT INTO account (professorID_FK, userName, password, accountType) VALUES ('.$profID.', "'.$userName.'", "'.$password.'", "'.$accountType.'");';

              mysqli_query($mysqli, $sqlins);





              /*$sql = "INSERT INTO account(professorID_FK, userName, password, accountType) VALUES('$_POST[professorId]', '$_POST[username]', '$_POST[password]', 'admin')";
              mysqli_query($mysqli, $sql); */

              // get last insert account id
              $sql = "SELECT accountID AS id FROM account ORDER BY accountID DESC LIMIT 1";
              $result = mysqli_query($mysqli, $sql);
              $acctId = mysqli_fetch_array($result)['id'];

              // office
              if ($_POST['office'] != "") {
                    $sql = "UPDATE office SET staffID_FK = '$acctId' WHERE officeID = '$_POST[office]'";
                    mysqli_query($mysqli, $sql); 
              }

              $_POST = array();
            }
          } 

      }

      // get office
      $sql = "SELECT * FROM office WHERE staffID_FK IS NULL ORDER BY officeName";
      $officeList = mysqli_query($mysqli, $sql);
      $officeList2 = mysqli_query($mysqli, $sql);
?>
<?php if ($message != "") { ?>
      <script>
            alert("<?=$message?>")
      </script>
<?php } ?>

<?php

$sql = "call selectProfAccountOffice();";
// $result2 = mysqli_query($mysqli, "$sql");

?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev-kiosk/assets/stylesheet/admin.css" >

<style>
  .add-prof {
    float: right;
}
</style>
<script type="text/javascript">	// VALIDATIONS
  function deleteConfirmation(){
    if (!confirm("Are you sure?")){
      return false;
    }
  }
  function UpdateConfirmation()
  {
    if (!confirm("Are you sure?"))
    {
      return false;
    }
  }
</script>

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
              <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-sm-8"><h2>Professor</h2></div>
                    <div class="col">
                       <button class="btn btn-info add-prof" type="button" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus "></i>Add New
                       </button>
                       <!-- <button class="btn btn-info update-prof" type="button" data-toggle="modal" data-target=""></i>Update Office
                       </button> -->
                       <form action="professor.php" method="post">
                       <input class="btn btn-info update" onclick = "return UpdateConfirmation();" value="Update Office" type="Submit"  name="updateOffice"/>
					 
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">First Name</th>
                      <th scope="col">Middle Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Office</th>
                      <th scope="col">Username</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php require 'php\db.php';?>
                    <?php $result2 = mysqli_query($mysqli, "$sql");?>
                    <?php while($value = $result2->fetch_assoc()) { ?>
                      <tr>
                        <td data-id="<?=$value['professorID']?>"><?=$value['firstName']?></td>
                        <td><?=$value['middleName']?></td>
                        <td><?=$value['lastName']?></td>
                        <!-- [offices] -->
                        <td>
                        <?php
                          echo '<select name="$offices[]" class="col form-control" id="office">';
                          foreach($officeinfos as $officeinfo)
                          {
                            if($value['officeID'] != $officeinfo['officeID'])
                            {
                                echo '<option value=' . $officeinfo['officeID'] . '>' . $officeinfo['officeName'] . '</option>';
                            }
                            else
                            {
                              echo '<option selected="selected" value=' . $officeinfo['officeID'] . '>' . $officeinfo['officeName'] . '</option>';
                            }
                          }
                          echo '</select>';
                        ?>
                        </td>
                        <td><?=$value['userName']?></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                           <a onclick = "return deleteConfirmation();" class="delete" title="Delete" data-toggle="tooltip" href="externalprocess/deleteprof.php?submit=<?=$value['professorID']?>"><i class="material-icons">&#xE872;</i></a>
                        </td>
                      </tr>
                    <?php }; ?>
                  </tbody>
                </table>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/footer.php' ?>

<!-- <script src="/pupwebdev-kiosk/auth/admin/scripts/Professor.js" type="text/javascript"></script> -->








<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalTitle">Add Professor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/assets/endpoints/addProf.php' ?>

    </div>
  </div>
</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalTitle">Edit Professor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/assets/endpoints/editProf.php' ?>

    </div>
  </div>
</div>
<script src="/pupwebdev-kiosk/auth/admin/scripts/Professor.js" type="text/javascript"></script>