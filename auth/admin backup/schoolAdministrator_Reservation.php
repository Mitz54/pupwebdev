<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header2.php';
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

?>


<link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">

<style>
.navbar {
  position: sticky !important;
}

.navbar-dark>.navbar-brand{
  margin-top: -50px;
    margin-left: -10px;
}

 .bg-pupcustomcolornavbar {
    background-color: #7f0400;
    border-bottom: 4px solid #edeaea;
    border-top: 2px solid #edeaea;
}
.main-content {
  padding-top: 0px;
}

.fc-content {
  color: white;
  text-align: center;
}
</style>


<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="schedule-header">
          <div class="room-select">
            <select class="form-control" id="Room">
             <option disabled selected hidden >Select Room..</option>
                   
                  <?php  
                  $query = $con->query("CALL getAllRoomID()"); 
                  // $query = mysqli_query($connect, "CALL selectAllSubject") or die("Query fail: " . mysqli_error());
                  $rowCount = $query->num_rows;
                  if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      { 
                        echo '<option value='.$row['roomID'].'>'.$row['roomID'].'</option>';
                      }
                    }
                  else
                    {
                      echo'<option value="">Room not available</option>';
                    }
                    mysqli_next_result($con);
                  ?>
                  </select>
            <button type="button" class="btn btn-secondary">Refresh</button>
          </div>
             <div class="col">
            <button class="btn btn-info create-report" type="button" data-toggle="modal" data-target="#reportModal">Create Report</button>
          </div>
        </div>
        <div class="room-calendar">
          <div id="room_calendarview"></div>
        </div>



<!-- /////////// -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>

             $(function(){
              $(document).on("click", "#printbtn", function(event){
                  var mon1 = document.getElementById("frommonth").value;
                  var mon2 = document.getElementById("tomonth").value;
                  var year = document.getElementById("year").value;

                  if (mon1 == "00" && mon2 == "00")
                  {
                    alert("Please select a month!");
                  }
                  else if (mon1 == "00" && mon2 != "00")
                  {
                    alert("Please select a month!");
                  }
                  else if (mon1 != "00" && mon2 == "00")
                  {
                    alert("Please select a month!");
                  }
                  else
                  {
                     //alert(mon1+mon2+year);
                    confirm("are you sure?");
                        window.location.href = "reservationReport.php?mon1=" +mon1+"&mon2=" +mon2+ "&year=" +year;

                  }
                   $('#reportModal').modal('hide');


              }); 
          });
            
            </script> 

            <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="reportModalTitle">Create Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label for="month">Month</label>
                  <br>
                  <div class="col-sm-12">
                  <div class="row">
                  <div class="col-sm-6">
                  <span>From:</span>
                  <select class="form-control" type="text" name="month" id = "frhommonth" onChange="this.form.submit()"  required>
                  <option  value = "00" disabled selected hidden>Select Month</option>
                  <option value = "01">January</option>
                  <option value = "02">February</option>
                  <option value = "03">March</option>
                  <option value = "04">April</option>
                  <option value = "05">May</option>
                  <option value = "06">June</option>
                  <option value = "07">July</option>
                  <option value = "08">August</option>
                  <option value = "09">September</option>
                  <option value = "10">October</option>
                  <option value = "11">November</option>
                  <option value = "12">December</option>
                  </select>
                  </div>

                  <div class="col-sm-6">
                  <span>To:</span>
                  <select class="form-control" type="text" name="month" id = "tomonth" onChange="this.form.submit()"  required>
                  <option  value = "00" disabled selected hidden>Select Month</option>
                  <option value = "01">January</option>
                  <option value = "02">February</option>
                  <option value = "03">March</option>
                  <option value = "04">April</option>
                  <option value = "05">May</option>
                  <option value = "06">June</option>
                  <option value = "07">July</option>
                  <option value = "08">August</option>
                  <option value = "09">September</option>
                  <option value = "10">October</option>
                  <option value = "11">November</option>
                  <option value = "12">December</option>
                  </select>
                  </div>

                  <div class="col-sm-6">
                  <span>Year:</span>

                  <?php
                    $currently_selected = date('Y'); 
                    $earliest_year = 2018; 
                    $latest_year = date('Y'); 

                    echo '<select class="form-control" type="text" name="year" id = "year" onChange="this.form.submit()"  required>';

                    foreach ( range( $latest_year, $earliest_year ) as $i ) 
                    {
                      echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                    }
                    echo '</select>';
                    ?>

                  </div>
                  </div>
                  </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" id="printbtn" class="btn btn-pupcustomcolor">Print</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
        </div>


<?php 
  echo date('Y-m-d',strtotime('2018/10/30'. '+2 days'));

 ?>
  
<!--======================================================================================================================================================-->


<form action="" methd="post" id="addSchedModal">
        <div class="modal fade"  id="create-roomSchedule" tabindex="-1" role="dialog" aria-labelledby="roomScheduleCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="roomScheduleCenterTitle">Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetSection()">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="scheduleReservationUser">Name</label>
                  <textarea class="form-control" rows="1" placeholder="Enter Name.." id="scheduleReservationUser"></textarea>


                  <form action="" method="post">

                  <label for="scheduleCourse">Course</label>
                  <select class="form-control" type="text" name="scheduleCourse" id="Course" onChange="change_Course();" required>
                  <option disabled selected hidden>Select Course..</option>          
                  
                  <?php  
                   $query = $con->query("CALL selectAllCourse()");

                  $rowCount = $query->num_rows;
                  if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      {
                        echo '<option value='.$row['courseID'].'>'.$row['courseID'].'</option>';
                      }
                    }
                  else
                    {
                      echo'<option value="">Course not available</option>';
                    }
                    mysqli_next_result($con);
                  ?>
                  </select>
                

              

                 <div id="section">
                  <label for="scheduleSection">Section</label>
                  <select class="form-control" type="text" name="scheduleSection" id="Section" required>

                  <option disabled selected hidden>Select Section..</option>
                  <!-- <include 'ajax.php';> -->

                  </select>
                  </div>
                   </form>

                  <script type="text/javascript">

                    function change_Course()
                    {
                    
                    var xmlhttp= new XMLHttpRequest();
                    xmlhttp.open("GET","ajax.php?course="+document.getElementById("Course").value,false);
                    xmlhttp.send(null);
                    // alert(xmlhttp.responseText);
                    document.getElementById("section").innerHTML=xmlhttp.responseText;
                  } 

                  </script>
                  
                <label for="scheduleReservationPurpose">Reservation Purpose</label>
                <textarea class="form-control" rows="5" id="scheduleReservationPurpose" placeholder="Enter Reservation Purpose.."></textarea>
                
                </div>

                <div class="form-group" style="display: flex; font-size: 16px;">
                  <label for="selectedRoomSched">Schedule: </label>
                  <div id="selectedRoomSched" style="margin-left: 20px;">
                    <input type="hidden" id="startTime" />
                    <input type="hidden" id="endTime" />
                    <input type="hidden" id="Day" />
                    <input type="hidden" id="Date" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" onsubmit="doSubmit()" class="btn btn-pupcustomcolor" id="submitButton" name="submitButton">Save</button>
                <button type="button" id ="closeButton"class="btn btn-secondary" data-dismiss="modal" onclick="resetSection()">Close</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<!-- <link href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.css' rel='stylesheet' />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
  
<script src="/pupwebdev-iya/assets/javascript/moment.min.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

  <script src="/pupwebdev-iya/assets/javascript/fullcalendar390.min.js" type="text/javascript"></script>
 -->
  
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->

  

<script type="text/javascript">
  
function resetSection()
{

   $("#addSchedModal")[0].reset();
    $('#Section').empty();
    $('#Section').append(' <option disabled selected hidden>Select Section..</option>');

}


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="schoolAdministrator.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
<script src="/pupwebdev/assets/javascript/moment.min.js " type="text/javascript"></script>
<script src="/pupwebdev/assets/javascript/fullcalendar390.min.js" type="text/javascript"></script>

<link href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.css' rel='stylesheet' />

<!-- <script src="/pupwebdev-iya/auth/admin/roomScheduling-iya.js" type="text/javascript"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script> -->


