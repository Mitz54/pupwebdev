<nav class="navbar navbar-light">
  <div class="queue">
    <div class="queue-status" id="qNum">
      <h4>Queue Number</h4>
      <span class="queue-number">0001</span><br>
      <span class="queue-type">Transaction</span>
      <div class="queue-requestbutton">
        <button type="button" class="btn btn-sm btn-warning">Void</button>
        <button type="button" class="btn btn-sm btn-warning">Finish</button>
      </div>
    </div>
  </div>

  <?php
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $pageOn = explode('/pupwebdev/auth/acadservice/', $path);
    $activenav = isset($pageOn[1]) ? $pageOn[1] : null;
  ?>

  <div class="dashboard-menu">
    <h6>Dashboard</h6>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='acadService_Scheduler.php') {echo 'active';} ?>" href="acadService_Scheduler.php"><i class="fas fa-calendar-alt icon"></i>Schedule</a>
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
    }, 1500);
    
  });
</script>
