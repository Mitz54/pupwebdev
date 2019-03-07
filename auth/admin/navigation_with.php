
<style>
  .modal-backdrop {
  z-index: 0;
}

#dropdownMenu {
  background-color: #a12c28;
  border: 1px solid white;
  color: white;
  padding: 0px;
  padding-right: 6px; 
}

#changePassword {
  text-align: center;
}
</style>

<nav class="navbar navbar-light">
  <div class="queue">
    <div class="queue-status">
      <h4>Dashboard</h4>
    </div>
  </div>

  <?php
    $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $pageOn = explode('/pupwebdev/auth/admin/', $path);
    $activenav = isset($pageOn[1]) ? $pageOn[1] : null;
  ?>

  <div class="dashboard-menu">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='kiosk.php') {echo 'active';} ?>" href="kiosk.php"><i class="fas fa-kaaba icon"></i>Kiosk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='account.php') {echo 'active';} ?>" href="account.php"><i class="fas fa-chalkboard-teacher icon"></i>Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='transaction.php') {echo 'active';} ?>" href="transaction.php"><i class="fas fa-newspaper icon"></i>Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='office.php') {echo 'active';} ?>" href="office.php"><i class="fas fa-building icon"></i>Office</a>
      </li>
      <!-- PAEDIT NA LANG PO NUNG PHP THANKS -->
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='announcement.php') {echo 'active';} ?>" href="announcement.php"><i class="fas fa-exclamation icon"></i>Announcement</a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='course.php') {echo 'active';} ?>" href="course.php"><i class="fas fa-book icon"></i>Course</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='subject.php') {echo 'active';} ?>" href="subject.php"><i class="fas fa-chalkboard icon"></i>Subject</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='section.php') {echo 'active';} ?>" href="section.php"><i class="fas fa-calendar-alt icon"></i>Section</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='professor.php') {echo 'active';} ?>" href="professor.php"><i class="fas fa-chalkboard-teacher icon"></i>Professor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($activenav=='room.php') {echo 'active';} ?>" href="room.php"><i class="fas fa-building icon"></i>Room</a>
      </li>
    </ul>
  </div>
</nav>

<body>
<div class="modal fade" id="voidSuccess" tabindex="-1" .modal-backdrop role="dialog" aria-labelledby="voidModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="voidModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Are you sure you want to void the transaction?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="finishSuccess" .modal-backdrop tabindex="-1" role="dialog" aria-labelledby="voidModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="finishModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Are you sure you want to finish the transaction?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body>
