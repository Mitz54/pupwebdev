<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header2.php';
?>
<!-- Trigger the modal with a button -->
<button type="button" id="modalbtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Calendar Modal -->
<div id="student-cal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Room Reservation</h4>
      </div>
      <div class="modal-body">
        
        <div class="student-detail-wrap">
          <div id="student-calendar"></div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
<link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">
<script src="/pupwebdev/assets/javascript/moment.min.js"></script>

<script src="/pupwebdev/assets/javascript/fullcalendar390.min.js"></script>
<!-- <script src="/tooltip.js"></script> -->
<script  src="/pupwebdev/auth/student/studentReservationCalendar.js"></script> 