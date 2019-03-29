<!-- <ul class="navbar-nav ml-auto">
  <li class="nav-item active">
    <span class="nav-text profile-name" href="#"><img class="profile-image" src="/pupwebdev/assets/images/profile.jpg"/>"profile_username"</span>
  </li>
  <li class="nav-item">
    <a class="nav-link logout-button" href="../../index.php"><i class="fas fa-power-off icon"></i>Logout</a>
  </li>
</ul> -->


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
        <div class="control-group">
            <label for="current_password" class="control-label">Current Password</label>
            <div class="controls">
                <input type="password" name="current_password">
            </div>
        </div>
        <div class="control-group">
            <label for="new_password" class="control-label">New Password</label>
            <div class="controls">
                <input type="password" name="new_password">
            </div>
        </div>
        <div class="control-group">
            <label for="confirm_password" class="control-label">Confirm Password</label>
            <div class="controls">
                <input type="password" name="confirm_password">
            </div>
        </div>      
    </div>
    <div class="modal-footer">
        <button href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button href="#" class="btn btn-primary" id="password_modal_save">Save changes</button>
    </div>
</div>