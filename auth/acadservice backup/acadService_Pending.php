
<?php session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
       include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');?>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills" id="pendingmodules-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pendingmodules-lor-tab" data-toggle="pill" href="#pendingmodules-lor" role="tab" aria-controls="pendingmodules-lor" aria-selected="true">Letter of Request</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pendingmodules-roomr-tab" data-toggle="pill" href="#pendingmodules-roomr" role="tab" aria-controls="pendingmodules-roomr" aria-selected="false">Room Reservation</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pendingmodules-lor" role="tabpanel" aria-labelledby="pendingmodules-lor-tab">
                <table id="example" class="table table-bordered table-hover">
                  
            
             
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <script>
                      $(document).ready(function () 
                      {
                        $('#example tbody').on('click', 'tr', function()
                        {
                          var tabledata = $(this).children("td").map(function() 
                          {
                            return $(this).text();
                          }).get();
                          var td=tabledata[0]+' '+tabledata[1]+' '+tabledata[2]+' '+tabledata[3]+' '+tabledata[4]+' '+tabledata[5]+' '+tabledata[6]+' '+tabledata[7];

                          var number = tabledata[0];
                          var name = tabledata[1];
                          var purpose = tabledata[2];
                          var date = tabledata[3];
                          var room = tabledata[4];
                          var starttime = tabledata[5];
                          var endtime = tabledata[6];
                          var sched = tabledata[7];

                          var con = confirm("Proceed for printing?" + "\n" + "\n" + name +" "+ purpose +" "+ room + "\n" + date +" "+ starttime +" - "+ endtime +" "+ sched);
                             
                            if (con == true) {
                                window.location.href = "requestLetter.php?name=" +name+"&room=" +room+ "&date=" +date+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +sched+ "&purpose=" +purpose;
                            }
                        });
                      });
                  </script>

                   <?php
                  
                  //letter table

                  $sel = "SELECT reservationID, reservationUser,purpose, reservationDate,
                    roomID_FK,
                    TIME_FORMAT(startTime,'%h:%i %p') as startTime,
                    TIME_FORMAT(endTime,'%h:%i %p') as endTime, scheduleDay
                    FROM schedule S
                    INNER JOIN reservation R ON R.scheduleID_FK = S.scheduleID
                    WHERE reservationStatus = 'pending'
                    ORDER BY 
                         CASE
                            WHEN scheduleDay = 'SUN' THEN 1
                              WHEN scheduleDay = 'MON' THEN 2
                              WHEN scheduleDay = 'TUE' THEN 3
                              WHEN scheduleDay = 'WED' THEN 4
                              WHEN scheduleDay = 'THU' THEN 5
                              WHEN scheduleDay = 'FRI' THEN 6
                              WHEN scheduleDay = 'SAT' THEN 7
                         END ASC, startTime;";

                  $res=$con->query($sel);

                  echo "<thead class='thead-light'>
                        <tr>
                      <th scope='col'>Queue Number</th>
                      <th scope='col'>Name</th>
                      <th scope='col'>Purpose</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Room</th>
                      <th scope='col'>Start Time</th>
                      <th scope='col'>End Time</th>
                      <th scope='col'>Schedule</th>
                    </tr>
                    </thead>
                    <tbody>";


                $num=001;
                while($row= $res->fetch_assoc())
                {

                  echo
                  "<tr>
                  <td>{$num}</td>
                  <td>{$row['reservationUser']}</td>
                  <td>{$row['purpose']}</td>
                  <td>{$row['reservationDate']}</td>
                  <td>{$row['roomID_FK']}</td> 
                  <td>{$row['startTime']}</td>
                  <td>{$row['endTime']}</td>
                  <td>{$row['scheduleDay']}</td>                           
                  </tr>
                  </tbody>\n";
                 $num++; 
                }           
              //letter table
                  ?>
                </table>


                
              </div>
              
              
              <div class="tab-pane fade" id="pendingmodules-roomr" role="tabpanel" aria-labelledby="pendingmodules-roomr-tab">
                <table id ="table2" class="table table-bordered table-hover">

               <script>

               $(document).ready(function () 
                      {

                        $('#table2 tbody').on('click', 'tr', function()
                        {
                          var tabledata = $(this).children("td").map(function() 
                          {
                            return $(this).text();
                          }).get();
                          var td=tabledata[0]+' '+tabledata[1]+' '+tabledata[2]+' '+tabledata[3]+' '+tabledata[4]+' '+tabledata[5]+' '+tabledata[6]+' '+tabledata[7];
                          
                          var num = tabledata[0];
                          var name1 = tabledata[1];
                          var pur = tabledata[2];
                          var dt = tabledata[3];
                          var rm = tabledata[4];
                          var starttime = tabledata[5];
                          var endtime = tabledata[6];
                          var schedule = tabledata[7];

                          $('#actionApproveModal').modal('show');

                          $("#approvebtn").click(function()
                        {
                          var conf = confirm("Are you sure you want to approve?")
                          if(conf == true)
                          {
                              document.location.href = "updateReservationStatus.php?name=" +name1+"&room=" +rm+ "&date=" +dt+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +schedule+ "&purpose=" +pur + "&stat=approved" ;
                            alert("Request has been approved!");
                          }

                          $('#actionApproveModal').modal('hide');
                        })

                          $("#rejectbtn").click(function()
                        {
                          var con = confirm("Are you sure you want to reject?")
                          if(con == true)
                          {
                              document.location.href = "updateReservationStatus.php?name=" +name1+"&room=" +rm+ "&date=" +dt+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +schedule+ "&purpose=" +pur + "&stat=reject" ;
                            alert("Request has been rejected!");
                          }

                          $('#actionApproveModal').modal('hide');
                        })                          

                        });
                        });

                </script>
                  

                  <?php
                 
                  //pending
      
                  $select = "CALL selectPendingReservationSchedule();";

                  $result=$con->query($select);

                  echo "<thead class='thead-light'>
                      <tr>
                      <th scope='col'>Queue Number</th>
                      <th scope='col'>Name</th>
                      <th scope='col'>Purpose</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Room</th>
                      <th scope='col'>Start Time</th>
                      <th scope='col'>End Time</th>
                      <th scope='col'>Schedule</th>
                      </tr>
                    </thead>
                    <tbody>";


                $num=001;
                
                while($row= $result->fetch_assoc())
                {
                  $id=$row['reservationID'];

                  echo
                  "<tr >
                  <td>{$num}</td>
                  <td>{$row['reservationUser']}</td>
                  <td>{$row['purpose']}</td>
                  <td>{$row['reservationDate']}</td>
                  <td>{$row['roomID_FK']}</td> 
                  <td>{$row['startTime']}</td>
                  <td>{$row['endTime']}</td>
                  <td>{$row['scheduleDay']}</td> 
                  </tr>
                  </tbody>\n";
                 $num++; 
                }           
              //pending
                  ?>
                  
               </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="actionApproveModal" tabindex="-1" role="dialog" aria-labelledby="actionApproveModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionApproveModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Approve or Reject Reservation request</h3>
      </div>
      <div class="modal-footer">

      <button type="button" id="approvebtn" class="btn btn-pupcustomcolor" >Approve</button>
        <button type="button" id="rejectbtn" class="btn btn-pupcustomcolor">Reject</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>
