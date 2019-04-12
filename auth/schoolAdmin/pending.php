<?php 
session_start();
require "logincheck.php";
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
                          var sect = tabledata[2];
                          var purpose = tabledata[3];
                          var date = tabledata[4];
                          var room = tabledata[5];
                          var starttime = tabledata[6];
                          var endtime = tabledata[7];
                          var sched = tabledata[8];
                          var reserveID = tabledata[9];
                          var remarks = tabledata[10];
                          var prof = tabledata[12];
                          var reservationType = tabledata[13];
                          // alert(remarks);
                          var con = confirm("Proceed for printing?");
                             
                          var controlID = null;
                            if (con == true) {
                              // alert(reserveID);
                                $.ajax({
                                      url:"updateReservationStatus.php",
                                      type:"GET",
                                      data:{stat:'ongoing',
                                            name:name,
                                            sect:sect,
                                            purpose:purpose,
                                            date:date,
                                            room:room,
                                            starttime:starttime,
                                            endtime:endtime,
                                            sched:sched},
                                      success:function(data){
                                        // alert(data)
                                      }
                                });

                                $.ajax({
                                  url:"getControlID.php",
                                  dataType:'json',
                                  type:"POST",
                                  async:false,
                                  data:{reserveID:reserveID},
                                  success:function(data){
                                    controlID = data;
                                    // alert(data);   
                                  }
                                })

                                if(reservationType=="student")
                                {
                                   window.location.href = "StudentRequestLetter.php?name=" +name+"&room=" +room+ "&date=" +date+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +sched+ "&purpose=" +purpose+"&controlID="+controlID+ "&sect="+sect+ "&remarks="+remarks+ "&prof="+prof;
                                }
                                else
                                {
                                   window.location.href = "requestLetter.php?name=" +name+"&room=" +room+ "&date=" +date+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +sched+ "&purpose=" +purpose+"&controlID="+controlID+ "&sect="+sect+ "&remarks="+remarks+ "&prof="+prof;
                                }
                               
                            }
                          });
                      });
                  </script>

                   <?php
                  
                  //letter table

                  $sel = "SELECT remarks,reservationID, reservationUser,description, reservationDate,
                    roomID_FK, CONCAT(PR.firstName,' ',PR.middleName,'. ',PR.lastName) as prof,
                    CONCAT(PR.firstName,' ',LEFT(PR.lastName,1),'.') as profInitial,queueCode,
                    TIME_FORMAT(startTime,'%h:%i %p') as startTime,
                    TIME_FORMAT(endTime,'%h:%i %p') as endTime, scheduleDay,crowd_affected,reservationType
                    FROM schedule S
                    INNER JOIN reservation R ON R.scheduleID_FK = S.scheduleID
                    INNER JOIN purpose P on P.purposeID=R.purposeID_FK
                    LEFT JOIN professor as PR on PR.professorID = R.professorID_FK
                    WHERE 
                     reservationStatus = 'pending' AND reservationDate >=(SELECT DATE_ADD(now(), INTERVAL -1 DAY))
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
                      <th scope='col'>Queue Code</th>
                      <th scope='col'>Name</th>
                      <th scope='col'>Section</th>
                      <th scope='col'>Purpose</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Room</th>
                      <th scope='col'>Start Time</th>
                      <th scope='col'>End Time</th>
                      <th hidden scope='col'>Day</th>
                      <th hidden scope='col'>reserveID</th>
                      <th hidden scope='col'>Remarks</th>
                      <th scope='col'>Professor</th>
                      <th hidden scope='col'>ProfFullName</th>
                      <th hidden scope='col'>Type</th>
                    </tr>
                    </thead>
                    <tbody>";


                $num=001;
                while($row= $res->fetch_assoc())
                {

                  echo
                  "<tr>
                  <td>{$row['queueCode']}</td>
                  <td>{$row['reservationUser']}</td>
                  <td>{$row['crowd_affected']}</td>
                  <td>{$row['description']}</td>
                  <td>{$row['reservationDate']}</td>
                  <td>{$row['roomID_FK']}</td> 
                  <td>{$row['startTime']}</td>
                  <td>{$row['endTime']}</td>
                  <td hidden>{$row['scheduleDay']}</td>      
                  <td hidden >{$row['reservationID']}</td>
                  <td hidden >{$row['remarks']}</td>   
                  <td>{$row['profInitial']}</td>
                  <td hidden >{$row['prof']}</td>         
                  <td hidden >{$row['reservationType']}</td>                          
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
              //APPROVE SCHEDULE
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
                          var pur = tabledata[3];
                          var dt = tabledata[4];
                          var rm = tabledata[5];
                          var starttime = tabledata[6];
                          var endtime = tabledata[7];
                          var schedule = tabledata[8];
                          var reservationID = tabledata[9];


                          $('#actionApproveModal').modal('show');

                          $("#approvebtn").click(function()
                        {
                          var conf = confirm("Are you sure you want to approve?")
                          if(conf == true)
                          {
                            // alert("ETO YON");

                            $.ajax({
                                  url:"Queries/updateReservationLetter.php",
                                  type:"POST",
                                  data:{reservationID:reservationID}
                            })

                              document.location.href = "updateReservationStatus.php?name=" +name1+"&room=" +rm+ "&date=" +dt+ "&starttime=" +starttime+ "&endtime=" +endtime+ "&sched=" +schedule+ "&purpose=" +pur + "&stat=approved" ;
                            // alert(reservationID);
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
      
                  $select = "CALL selectOngoingReservationSchedule();";

                  $result=$con->query($select);

                  echo "<thead class='thead-light'>
                      <tr>
                      <th scope='col'>Queue Code</th>
                      <th scope='col'>Name</th>
                      <th scope='col'>Section</th>
                      <th scope='col'>Purpose</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Room</th>
                      <th scope='col'>Start Time</th>
                      <th scope='col'>End Time</th>
                      <th hidden scope='col'>Schedule</th>
                      <th hidden scope='col'>ReservationID</th>
                      <th scope='col'>Professor</th>
                      </tr>
                    </thead>
                    <tbody>";


                $num=001;
                
                while($row= $result->fetch_assoc())
                {
                  $id=$row['reservationID'];

                  echo
                  "<tr >
                  <td>{$row['queueCode']}</td>
                  <td>{$row['reservationUser']}</td>
                  <td>{$row['crowd_affected']}</td>
                  <td>{$row['description']}</td>
                  <td>{$row['reservationDate']}</td>
                  <td>{$row['roomID_FK']}</td> 
                  <td>{$row['startTime']}</td>
                  <td>{$row['endTime']}</td>
                  <td hidden>{$row['scheduleDay']}</td>
                  <td hidden>{$row['reservationID']}</td> 
                  <td>{$row['profInitial']}</td>
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
