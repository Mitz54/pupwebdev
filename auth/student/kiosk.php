 <!-- vm machine virtual box 2003 muna tapos 2012
1db
1 folder


COLOR


STUDENY id VALIDATION 
RESERVATION
CALASSROOM ACTIVITY
ORG ACTIVITY
seminar
thesis def

Dropdown (Purpose) 






CONTROL NUM PER LETTER (All)




NOtification for conflicts

Room Utilization for maam iya

Activity should be official 
Activity  or Thesis Def
should be known by maam chat first

Then sir nucum


monthly , weekyly , yearly and custom  report




kapag gagawa ng connection  -->







<?php  include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header3.php';


?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- <link rel="stylesheet" href="/pupwebdev-student/assets/stylesheet/admin.css" > -->

<style type="text/css">
	.modal-body{
	  padding: 4px;
	}
    .con
    {
      margin-top: 10px;
    }
    .htext
    {
      margin-top:20px;
    }
    .pupcolor
    {
      background-color: #7f0400;
    }
    .modaladjust
    {
      margin-top: 100px;
    }
    .btnadjust
    {
      height: 90px;
      width: 206px;
    }
    .contest
    {
      background-color: red;
      height: 500px;
    }
    .textsize
    {
      font-size: 24pt;
    }
    .modal
    {
    	overflow-y: auto;
    }
	h1 
	{
		display: inline;
	}
    @page{
      size: 8.5in 11in;
    }


  	@media print {
		body * {
		  visibility: hidden;
		}
		#printArea * {
		  visibility: visible;
		  width:100%; 
		  height:100%;
		  page-break-after:always;
		  margin-left: auto;
		  margin-right: auto;
		  display: block;
		}
		#printArea {
		  position: absolute;
		;
		}
		#printArea button{
		  visibility: hidden;
		}

		.modal-backdrop {
			z-index: 1050;
		}

		.fc-content {
			color: white;
		}
}


</style>


<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="container">
        <div class="col-12">
            <div class="row">
              <div class="col-12">
              <h2 class="text-white htext"> Choose Your Transaction </h2>
              </div>
            </div>
  <!------------------------------------------------------ QUEUE COLUMN ---------------------------------------------------->
  <div class="row">
  <?php
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';

		$res = mysqli_query($con, "call selectOffice()") or die("Query fail: " . mysqli_error());
		$officeID = array();
		$officeName = array();
		$officeHead = array();
		$officeRoom = array();
		$officeCode = array();
		$counter=0;

		while($row=mysqli_fetch_array($res))
		{
			$officeID[$counter] = $row['officeID'];
			$officeName[$counter] = strtoupper($row['officeName']);
			$officeHead[$counter] = strtoupper($row['firstName'] . " " . $row['lastName']);
			$officeRoom[$counter] = $row['roomID_FK'];
			$officeCode[$counter] = strtoupper($row['code']);
			$counter++;
		}
		mysqli_close($con);
		
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
		$res = mysqli_query($con, "call selectAllTransaction()") or die("Query fail: " . mysqli_error());
		$columnNames = array("transactionID","transaction","officeID_FK");
		$counter=0;
		
		while($row=mysqli_fetch_array($res))
		{
			for ($col=0;$col<3;$col++){
				$officeTransactions[$counter][$col]=$row[$columnNames[$col]];
			}
			$counter++;
		}
		mysqli_close($con);
		
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
		$res = mysqli_query($con, "call selectNextQueueNumber()") or die("Query fail: " . mysqli_error());
		
		while($row=mysqli_fetch_array($res))
		{
			if ($row['next']!=null)
				$queueNum=$row['next'];
			else
				$queueNum=1;
		}
		mysqli_close($con);
		
		if ($queueNum<10){
			$increase="000";
		}
		elseif ($queueNum<100) {
			$increase="00";
		}
		elseif ($queueNum<1000) {
			$increase="0";
		}
		
		if (isset($_POST['printModal']))
		{
			require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
			mysqli_query($con, 'call insertNewQueue("' . $queueNum . '", "' . date('Y-m-d') . '")') or die("Query fail: " . mysqli_error());
			
			$res = mysqli_query($con, 'call selectQueueID(' . $queueNum . ')') or die("Query fail: " . mysqli_error());
			while($row=mysqli_fetch_array($res))
			{
				$queueID=$row['queueID'];
			}
			mysqli_close($con);
			
			require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
			mysqli_query($con, 'call insertNewQueueingTransaction(' . $queueID . ', "' . date('Y-m-d') . '", ' . $_POST['printModal'] . ')') or die("Query fail: " . mysqli_error($con));
			mysqli_close($con);
			
			//-------------------------------KARL DITO KA MAGBAGO-----------------------------------------------
			
			/*$printer = "\\\\TETSUKY\\webdevPrinter"; 
			if($ph = printer_open($printer)) 
			{  
			   printer_set_option($ph, PRINTER_MODE, "RAW"); 
			   
			   $content="-------------------------" . $queueNum . "------------------------------"; 
			   
			   printer_write($ph, $content); 
			   printer_close($ph); 
			}*/
			
			//--------------------------------------------------------------------------------------------------
			
			header('Location: kiosk.php?');
			// exit(); 

			// location.reload(true);
		}
		
		$arrCount = count($officeID);
		for ($x=0;$x<$arrCount;$x++) {
			echo '<div class="col-sm-6 con">
				<div class="card-deck">
					<div class="card bg-white">
					   <div class="card-body text-center">
							 <h6 class="card-text">' . $officeName[$x] . '</h6>
							 <button class="btn btn-block text-white pupcolor"data-toggle="modal" data-target="#officeModal' . $officeID[$x] . '" onclick="getOfficeCode(\'' . $officeCode[$x] . '\')">Select</button>
							
						</div>
					</div>
				</div>
			</div>
			
			<!-- The Modal -->
			<div class="modal fade modaladjust" id="officeModal' . ($officeID[$x]) . '">
			<div class="modal-dialog">
			<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="col-12 modal-title text-center">Select Option</h4>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				<div class="card-deck">
					<div class="card bg-white">
						<div class="card-body text-center">
							<h3 class="card-text" style="margin: -15px 0px 0px 0px;">' . $officeName[$x] . '</h3>
                            <h5 class="card-text">' . $officeHead[$x] . '</h5>
                            <h6 class="card-text" style="margin: -5px 0px 5px 0px;">' . $officeRoom[$x] . '</h6>
							<div class="row">';
								
								for ($i=0;$i<count($officeTransactions);$i++)
								{
									if ($officeID[$x]==$officeTransactions[$i][2])
									{
										if ($officeTransactions[$i][0]==93)
										{
											echo '<div class="col-6">
											<button class="card-text btnadjust pupcolor text-white" type="button" data-dismiss="modal" id="reservationButton" value="' . $officeTransactions[$i][0] . '" onclick="getTransaction(this)">' . $officeTransactions[$i][1] . '</button> 
											</div>';
										}
										else
										{
											echo '<div class="col-6">
											<button class="card-text btnadjust pupcolor text-white" type="button" data-toggle="modal" data-target="#myModal" data-dismiss="modal" id="transactionButton" value="' . $officeTransactions[$i][0] . '" onclick="getTransaction(this)">' . $officeTransactions[$i][1] . '</button>
											</div>';
										}
									}
								}
								
						echo '</div>
					</div>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>';
		}

		echo '<!-- The Modal(Print Queue) -->
		<div class="modal fade modaladjust" id="myModal"> 
			<div class="modal-dialog">
				<div class="modal-content">
				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="col-12 modal-title text-center" id="sample">Print Queue Number</h4>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body" id="printArea">
					<div class="card-deck">
					  <div class="card bg-white">
						<div class="card-body text-center">
							<h1 class="card-text" id="offcode">N/A</h1>
							<h1 class="card-text" id="offnum">-'. $increase . $queueNum . '</h1>
							<h5 class="card-text">Transaction Number</h5>
							<form method="post">
								<button class="btn btn-block text-white pupcolor" type="submit" name="printModal" id="printButton" value=" " onclick="window.print()">PRINT</button>
							</form>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>';
  ?>
  
	
  </div>    
</div>
</div>
</div>


<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!---------------------------------------------------- RESERVATION CALENDAR COLUMN START---------------------------------------------------->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<div id="student-cal" class="modal fade" role="dialog" style="top:-30px;" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" style="max-height: 80%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      		<h4 class="modal-title">Room Reservation</h4>
      		<select class="form-control" id="Room">
             <option disabled selected hidden value="" >Select Room..</option>
                   
                  <?php  
                  require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
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


        
      </div>
      <div class="modal-body">
        
        <div class="student-detail-wrap container-fluid">
          <div id="student-calendar"></div>
        </div>

      
      </div>
      
      <div class="modal-footer">
        <button type="button" id ="stud-cal-close"class="btn btn-danger" data-dismiss="modal">Close</button>

      </div>
      

    </div>

  </div>
</div>
<!---------------------------------------------------- RESERVATION CALENDAR COLUMN  END---------------------------------------------------->

<form action="" methd="post" id="addSchedModal">
   <div class="modal fade"  id="create-roomSchedule" tabindex="-1" role="dialog" aria-labelledby="roomScheduleCenterTitle" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
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
                  <!-- NAME -->
                  
                 <div class="form-row">
    				<div class="form-group col-md-6">
      					<label >First Name</label>
      					<input autocomplete="off" type="text" class="form-control" id="inpt-fname" placeholder="First Name">
    				</div>
    				<div class="form-group col-md-6">
      					<label>Last Name</label>
      					<input autocomplete="off" type="text" class="form-control" id="inpt-lname" placeholder="Last Name">
    				</div>
  				</div>
                  <!-- COURSE -->
                  <form action="" method="post">

                  <label for="scheduleCourse">Course</label>
                  <select class="form-control mb-1" type="text" name="scheduleCourse" id="Course" onChange="change_Course();" required>
                  <option disabled selected hidden value="">Select Course..</option>          
                  
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
                

             
                  <!-- SECTION -->
                 <div id="section">
                  <label for="scheduleSection">Section</label>
                  <select disabled column="10" class="form-control mb-1" type="text" name="scheduleSection" id="Section" required>

                  <option disabled selected hidden value="">Select Section..</option>
                  <!-- <include 'ajax.php';> -->

                  </select>
                  </div>
                   </form>

                 <!-- PROFESSOR -->
              	<label>Professor</label>
              	<select id = "Professor" class="form-control mb-1">
              		<option disabled selected hidden>Select Professor...</option>
              		<?php
              		include '../schoolAdmin/Queries/readProfessors.php';
              		?>
              	</select>    


              	<!-- PURPOSE -->
                <label for="scheduleReservationPurpose">Resersvation Purpose</label>

                <select  class="form-control mb-1" type="text" name="roomPurpose" id="roomPurpose" required>
                	
                  <option disabled selected hidden>Select Purpose..</option>
                	<?php  
                			include include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/student/php/SelectAllPurpose.php');
                    ?>
                  </select>
                <div hidden id="remarks-div">
                	<label>Please be specific</label>
                	<textarea class="form-control mb-1" rows="1" id="Remarks" placeholder="for our..."></textarea>
                </div>
                
                
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
        <script type="text/javascript">
  
		function resetSection()
		{

		   $("#addSchedModal")[0].reset();
		   $('#Section').empty();
		   $('#Section').append(' <option disabled selected hidden>Select Section..</option>');

		}
	</script>

</div>


  </div>
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script  src="/pupwebdev/auth/student/studentReservationCalendar.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
<link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">
<script src="/pupwebdev/assets/javascript/moment.min.js"></script>
<script src="/pupwebdev/assets/javascript/fullcalendar390.min.js"></script>
<script>

function getTransaction(objButton){
	document.getElementById("printButton").value=objButton.value;
}

function getOfficeCode(code){
	document.getElementById("offcode").innerHTML=code;
}


       

function change_Course()
{    
	$("#Section").prop('disabled',false);
   	var xmlhttp= new XMLHttpRequest();
    xmlhttp.open("GET","ajax.php?course="+document.getElementById("Course").value,false);
    xmlhttp.send(null);
    // alert(xmlhttp.responseText);
    document.getElementById("section").innerHTML=xmlhttp.responseText;
} 


</script>
