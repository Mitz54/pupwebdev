<?php 
session_start();
require "logincheck.php";
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header2.php';
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

?>

<style>

  .module-container{
    margin-top: -15px;
  }
  .btn-info2{
    margin-left: 20px;
  }
  .btn-info{
    margin-left: 490px;
  }
  .fc-content{
    color: white;
  }
  .modal-content.delete{
    width: 300px;
    margin-left: 90px;
  }
  .form-control.delete{
    margin-left: 40px;
  }
  .delete-down{
    margin-bottom: 20px;
    margin-top: 20px;
  }
  .modal-backdrop {
			z-index: 1050;
		}
</style>

<!-- ------------------------------------------ROOM DROPDOWN------------------------------------------------------------ -->

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
                 <option disabled selected hidden >Select Room</option>
                       
                    <?php  

                      $query = $con->query("CALL getAllRoomID()"); 
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
            </div>


<!-- -------------------------------------CREATE REPORT and DELETE SCHEDULE BUTTON---------------------------    -->  
      
          <button class="btn btn-info create-report" type="button" id="printbtn" >Create Report</button>          
          <button class="btn btn-info2"  type="button" data-toggle="modal" data-target="#deleteModal" id="deleteSchedBtn">Delete Schedule</button>
          </div>



<!-- ----------------------------------------------PRINT FUNCTION------------------------------------------------ -->


            <script>

             $(function()
             {
              $(document).on("click", "#printbtn", function(event)
                  {

                  
                
                    if(confirm("Do you want to proceed?")==true)
                    {
                        window.location.href = "schedulerReport.php";

                    }
                    else
                    {

                    }

                  });
                   

              }); 
          
            
            </script> 


<!-- ----------------------------------------------DELETE SCHEDULE MODAL POP UP------------------------------ -->


<form action="" method="post" id="deleteSchedModal">
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content delete">
            <div class="modal-header">
              <h5 class="modal-title delete" id="reportModalTitle">Delete Schedule</h5>
            </div>
            <div class="modal-body">
              <div class="form-group delete">
                  <div class="col-sm-12">
                  <div class="row delete-down">
                  <div class="col-sm-8">
                 
                <select class="form-control delete" id="RoomDelete">
             <option disabled selected hidden >Select Room</option>
             <option>All</option>
                   
                <?php  

                  $query = $con->query("CALL getAllRoomID()"); 
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
                  </div>
                  </div>
                  </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" id="deletebtn" class="btn btn-pupcustomcolor">Delete</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal"  id="cancelButton">Cancel</button>
            </div>
          </div>
        </div>
      </div>    
</form>

<!-- ---------------------------------------------FULL CALENDAR-------------------------------------------------- -->

        <div class="room-calendar">
          <div id="room_calendarview">
            
          </div>
        </div>

<!--  -----------------------------------------INSERT SCHEDULE MODAL---------------------------------------------------- -->

<form action="" method="post" id="addSchedModal">
        <div class="modal fade"  id="create-roomSchedule" tabindex="-1" role="dialog" aria-labelledby="roomScheduleCenterTitle" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="roomScheduleCenterTitle">Add Schedule</h5>
        
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="scheduleSubjectTitle">Subject Code</label>
                  <select class="form-control" type="text" name="scheduleSubjectTitle" id="SubjectTitle" required>
                  <option disabled selected hidden>Select Subject Code</option>
                   
                    <?php  

                      $query = $con->query("CALL selectAllSubject()"); 
                      $rowCount = $query->num_rows;

                      if($rowCount > 0)
                      {
                        while($row=$query->fetch_assoc())
                        {
                          echo '<option>'.$row['subjectID'].'</option>';
                        }
                      }

                      else
                      {
                        echo'<option value="">Subject not available</option>';
                      }

                      mysqli_next_result($con);

                    ?>

                  </select>


                  <form action="" method="post">

                  <label for="scheduleCourse">Course</label>
                  <select class="form-control" type="text" name="scheduleCourse" id="Course" onChange="change_Course();" required>
                  <option disabled selected hidden>Select Course</option>          
                  
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

                  <option disabled selected hidden>Select Section</option>
              
                  </select>
                  </div>
                   </form>

                  <script type="text/javascript">

                  function change_Course()
                  {
                    
                    var xmlhttp= new XMLHttpRequest();
                    xmlhttp.open("GET","dynamicSection.php?course="+document.getElementById("Course").value,false);
                    xmlhttp.send(null);
                    // alert(xmlhttp.responseText);
                    document.getElementById("section").innerHTML=xmlhttp.responseText;

                  } 

                  </script>

                  

                  <label for="scheduleSubjectProfessor">Professor</label>
                  <select class="form-control" type="text" name="scheduleSubjectProfessor" id="Professor" required>
                  <option disabled selected hidden>Select Professor</option>
         
                  <?php  

                    $query = $con->query("CALL selectAllProfessor('lastName')");
                    
                    $rowCount = $query->num_rows;

                    if($rowCount > 0)
                    {
                      while($row=$query->fetch_assoc())
                      {
                        echo '<option value='.$row['professorID'].'>'.$row['lastName'].", ".$row['firstName']." ".$row['middleName'].'</option>';
                      }
                    }

                    else
                      {
                        echo'<option value="">Professor not available</option>';
                      }

                    mysqli_next_result($con);

                  ?>

                  </select>
                
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
                <button type="button" class="btn btn-pupcustomcolor" id="submitButton" name="submitButton">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetSection()">Close</button>
              </div>
            </div>
           </div>
          </div>
</form>
      </div>
    </div>
  </div>
</div>

<!-- ---------------------------------------------RESER DROPDOWN DATAS FUNCTION------------------------------------------- -->
<script type="text/javascript">
  
  function resetSection()
  {

     $("#addSchedModal")[0].reset();
      $('#Section').empty();
      $('#Section').append(' <option disabled selected hidden>Select Section</option>');

  }


</script>

<!-- -----------------------------------------SCRIPT SOURCES-------------------------------------------------------- -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script  src="/pupwebdev/auth/acadservice/scripts/academicService3.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
<link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">
<script src="/pupwebdev/assets/javascript/moment.min.js"></script>
<script src="/pupwebdev/assets/javascript/fullcalendar390.min.js"></script>



