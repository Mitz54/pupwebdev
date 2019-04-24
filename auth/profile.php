<!-- <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
    <span class="nav-text profile-name" href="#"><img class="profile-image" src="/pupwebdev/assets/images/profile.jpg"/>"profile_username"</span>
  </li>
  <li class="nav-item">
    <a class="nav-link logout-button" href="../../index.php"><i class="fas fa-power-off icon"></i>Logout</a>
  </li>
</ul> -->
<?php    

if(isset($_POST['ChangePasswordBtn'])){
  include ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
  $newpass = $_POST['new_password'];
  $username = $_SESSION['username'];
  $result = mysqli_query($con, "call getPasswordByUsername('$username')");
	$resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $userpassword = $row['password'];
    }
    
    if(password_verify($_POST['current_password'],$userpassword)){
      if( $_POST['new_password'] == $_POST['confirm_password'])
      {
        $con->close();
        $hash_newpassword = password_hash($newpass, PASSWORD_DEFAULT);
        // echo "<script>alert('". $hash_newpassword . " " . $username ."');</script>";
        // mysqli_query($con, "call updatePass('$hash_newpassword', '$username')");
      
        include ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
        // mysqli_query($con, "call updatePass('" .$hash_newpassword. "', '".$username."')") or die(mysqli_error());
        $query = mysqli_query($con, "call updatePass('" .$hash_newpassword. "', '".$username."')") or die (mysqli_error($con)); 
// $sql = "UPDATE account 
// SET
// password='$hash_newpassword'
// WHERE userName = '$username'";
							
        // mysqli_query($con, $sql) or die(mysqli_error());
        // if ($con->query($sql) === TRUE) {
        // } else {
        //     echo "Error: " . $con->error;
        // }
        
        //header('Location:http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_Reservation.php?');
          // exit;
        // mysqli_close($con);
       
        echo "<script>alert('Successfully changed password.');</script>";
      }
      else {
        echo "<script>alert('new password does not match. Please recheck');</script>";
      }
    }
    else{
      echo "<script>alert('Current Password is wrong.');</script>";
    }
    $con->close();
  }
}    
?>

<style>
	#changePassword {
		text-align: center;
	}

	.modal-backdrop {
		z-index: 0;
	}
</style>

<div class="btn-group ml-auto">
  <button class="btn btn-sm  btn-pupcustomcolor dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="nav-text profile-name" href="#"><img class="profile-image" src="/pupwebdev/assets/images/profile.jpg"/>
<?php
  $fName = $_SESSION['firstName'];
  $lName = $_SESSION['lastName'];

  echo $fName.' '.$lName;
?>
    </span>
  	</button>
  <div class="dropdown-menu">
    <a class="dropdown-item" data-toggle="modal" data-target="#changePassword" href="#"><i class="fas fa-key icon"></i>Change Password</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item logout-button" id="logoutButton" href="../logout.php" ><i class="fas fa-power-off icon"></i>Logout</a>
  </div>
</div>
<body>
<div class="modal fade" id="changePassword" tabindex="-1" .modal-backdrop role="dialog" aria-labelledby="voidModalTitle" aria-hidden="true" data-backdrop="false" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="voidModalTitle">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
      <form method = "post">
        <div class="control-group">
            <label for="current_password" class="control-label">Current Password</label>
            <div class="controls">
                <input type="password" name="current_password" required>
            </div>
        </div>
        <div class="control-group">
            <label for="new_password" class="control-label">New Password</label>
            <div class="controls">
                <input type="password" name="new_password" required>
            </div>
        </div>
        <div class="control-group">
            <label for="confirm_password" class="control-label">Confirm Password</label>
            <div class="controls">
                <input type="password" name="confirm_password" required>
            </div>
        </div>      
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" id="password_modal_save" name="ChangePasswordBtn">Save changes</button>
    </div>
    </form>
</div>
