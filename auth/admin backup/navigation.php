<nav class="navbar navbar-light">
  <div class="queue">
    <div class="queue-status" id = "qNum">
      <!-- <h4>Queue Number</h4>
      <span class="queue-number" id="qNum">0001</span>
      <div class="queue-requestbutton">
        <span id="transaction">Transaction</span>
        <button type="button" class="btn btn-sm btn-warning" id="brkBtn">Break</button>
        <button type="button" class="btn btn-sm btn-warning" id="nxtBtn">Next</button> -->
      </div>
    </div>
  <!-- </div> -->


  <?php
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $pageOn = explode('/pupwebdev/auth/admin/', $path);
    $activenav = isset($pageOn[1]) ? $pageOn[1] : null;
  ?>

<style>
	* {
	/*overflow-y: visible;*/
	}
</style>

  <!-- <div class="dashboard-menu" style="overflow-y:visible;"> -->
  <div class="dashboard-menu" style=" height: 250px; overflow-y:scroll;" >
    <h6>Dashboard</h6>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='index.php' || $activenav=='') {echo 'active';} ?>" href="index.php"><i class="fas fa-home icon"></i>Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='inventory.php') {echo 'active';} ?>" href="inventory.php"><i class="fas fa-window-restore icon"></i>Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='borrowing.php') {echo 'active';} ?>" href="borrowing.php"><i class="fas fa-dolly-flatbed icon"></i>Borrowing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='schoolAdministrator_Reservation.php') {echo 'active';} ?>" href="schoolAdministrator_Reservation.php"><i class="fas fa-calendar-alt icon"></i>Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='pending.php') {echo 'active';} ?>" href="pending.php"><i class="fas fa-clock icon"></i>Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='staff.php') {echo 'active';} ?>" href="staff.php"><i class="fas fa-user-friends icon"></i>Staff</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='queuePerOffice.php') {echo 'active';} ?>" href="queuePerOffice.php"><i class="fas fa-user-friends icon"></i>Queue Per Office</a>
      </li>
    </ul>
  </div>
</nav>
<script src="\pupwebdev\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script>
<script type="text/javascript">
		
		
	$(document).ready(function(){
		var profcount =  0;
		var qCount =  0;
    var breakCount = 1;
	
		$("#nxtBtn").click(function(){

      alert("aaaaaa");
			profcount = profcount + 1;
			qCount = qCount + 1;
			$.ajax({
				url:"queueTable.php",
				method:"POST",
				data:{queueNewCount: qCount},
			});
      $("#qNum").load("loaddb.php", {profNewCount: profcount});
		});
    $("#brkBtn").click(function(){
			$.ajax({
				url:"breakButton.php",
				method:"POST",
				data:{breakNewCount: breakCount},
			});
      $("#qNum").load("loaddb.php", {breakNewCount: breakCount});
		});
    setInterval(function(){
			$('#qNum').load("loaddb.php");
		}, 800);
		
	});
</script>