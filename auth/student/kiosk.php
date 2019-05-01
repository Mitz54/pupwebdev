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







 <?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header3.php';
	session_start();
	if (isset($_SESSION['queueNumber']) && isset($_SESSION['increaseNumber'])) { } else {
		$_SESSION['increaseNumber'] = 0;
		$_SESSION['queueNumber'] = 0;
	}
	?>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <!-- <link rel="stylesheet" href="/pupwebdev-student/assets/stylesheet/admin.css" > -->

 <style type="text/css">
 	.modal-body {
 		padding: 4px;
 	}

 	.con {
 		margin-top: 10px;
 	}

 	.htext {
 		margin-top: 20px;
 	}

 	.pupcolor {
 		background-color: #7f0400;
 	}

 	.modaladjust {
 		margin-top: 100px;
 	}

 	.btnadjust {
 		height: 90px;
 		width: 206px;
 	}

 	.contest {
 		background-color: red;
 		height: 500px;
 	}

 	.textsize {
 		font-size: 24pt;
 	}

 	.modal {
 		overflow-y: auto;
 	}

 	h1 {
 		display: inline;
 	}

 	@page {
 		size: 8.5in 11in;
 	}


 	@media print {
 		body * {
 			visibility: hidden;
 		}

 		#printArea * {
 			visibility: visible;
 			width: 100%;
 			height: 100%;
 			page-break-after: always;
 			margin-left: auto;
 			margin-right: auto;
 			display: block;
 		}

 		#printArea {
 			position: absolute;
 			;
 		}

 		#printArea button {
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
							require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';

							$res = mysqli_query($con, "call selectOffice()") or die("Query fail: " . mysqli_error());
							$officeID = array();
							$officeName = array();
							$officeHead = array();
							$officeRoom = array();
							$officeCode = array();
							$counter = 0;

							while ($row = mysqli_fetch_array($res)) {
								$officeID[$counter] = $row['officeID'];
								$officeName[$counter] = strtoupper($row['officeName']);
								$officeHead[$counter] = strtoupper($row['firstName'] . " " . $row['lastName']);
								$officeRoom[$counter] = $row['roomID_FK'];
								$officeCode[$counter] = strtoupper($row['code']);

								$counter++;
							}
							mysqli_close($con);

							require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
							$res = mysqli_query($con, "call selectAllTransaction()") or die("Query fail: " . mysqli_error());
							$columnNames = array("transactionID", "transaction", "officeID_FK");
							$counter = 0;

							while ($row = mysqli_fetch_array($res)) {
								for ($col = 0; $col < 3; $col++) {
									$officeTransactions[$counter][$col] = $row[$columnNames[$col]];
								}
								$counter++;
							}
							mysqli_close($con);

							if (isset($_POST['printModal'])) {
								require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
								$res = mysqli_query($con, "call selectNextQueueNumber(" . $_POST['printModal'] . ")") or die("Query fail: " . mysqli_error());

								while ($row = mysqli_fetch_array($res)) {
									if ($row['next'] != null)
										$queueNum = $row['next'];
									else
										$queueNum = 1;
								}
								mysqli_close($con);
								if ($queueNum < 10) {
									$increase = "000";
								} elseif ($queueNum < 100) {
									$increase = "00";
								} elseif ($queueNum < 1000) {
									$increase = "0";
								}
								$_SESSION['queueNumber'] = $queueNum;
								$_SESSION['increaseNumber'] = $increase;
								// mysqli_close($con);

								require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
								mysqli_query($con, 'call insertNewQueue("' . $_SESSION['queueNumber'] . '", "' . date('Y-m-d') . '")') or die("Query fail: " . mysqli_error());

								$res = mysqli_query($con, 'call getCurrentQueueOnTransaction()') or die("Query fail: " . mysqli_error());
								while ($row = mysqli_fetch_array($res)) {
									$queueID = $row['next'];
								}
								mysqli_close($con);
								// echo '<script>alert('. $queueID.');</script>';
								require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
								mysqli_query($con, 'call insertNewQueueingTransaction(' . $queueID . ', "' . date('Y-m-d') . '", ' . $_POST['printModal'] . ')') or die("Query fail: " . mysqli_error($con));

								mysqli_close($con);
								unset($_POST['printModal']);
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

								header('Location: kiosk.php');
								// exit(); 

								// location.reload(true);
							}

							$arrCount = count($officeID);
							for ($x = 0; $x < $arrCount; $x++) {
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

								for ($i = 0; $i < count($officeTransactions); $i++) {
									if ($officeID[$x] == $officeTransactions[$i][2]) {
										if ($officeTransactions[$i][0] == 93) {
											echo '<div class="col-6">
											<button class="card-text btnadjust pupcolor text-white" type="button" data-dismiss="modal" id="reservationButton" value="' . $officeTransactions[$i][0] . '" onclick="getTransaction(this)">' . $officeTransactions[$i][1] . '</button> 
											</div>';
										} else {
											echo '<div class="col-6">
											<button class="card-text btnadjust pupcolor text-white" type="button" data-toggle="modal" data-target="#myModal" data-dismiss="modal" id="transactionButton" value="' . $officeTransactions[$i][0] . '" onclick="getTransaction(this)">' . $officeTransactions[$i][1] . '</button>
											</div>';
										}
									}
								}

								echo '<div class="col-6">
											<button class="card-text btnadjust pupcolor text-white" type="button" data-toggle="modal" data-target="#borrowingModal" data-dismiss="modal">Borrowing Request for Item</button>
											</div>';

								echo '</div>
					</div>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>';
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
								<h1 class="card-text" id="offnum">-' . $_SESSION['increaseNumber'] . $_SESSION['queueNumber'] . '</h1>
								<h5 class="card-text">Transaction Number</h5>
								<form method="post">
									<button class="btn btn-block text-white pupcolor" type="submit" name="printModal" id="printButton" value=" ">PRINT</button>
								</form>
							</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>';
							}
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

 						<div class="form-group col-md-6">
 							<label>Reservation Type</label>
 							<select class=form-control id="reserve-type">
 								<option disabled selected hidden value="">Select Reservation Type</option>
 								<option value="student">Student</option>
 								<option value="organization">Organization</option>
 							</select>
 						</div>
 						<div class="form-group col-md-6">
 							<label>Room</label>
 							<select class="form-control" id="Room">
 								<option disabled selected hidden value="">Select Room..</option>

 								<?php
									require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
									$query = $con->query("CALL getAllRoomID()");
									// $query = mysqli_query($connect, "CALL selectAllSubject") or die("Query fail: " . mysqli_error());
									$rowCount = $query->num_rows;
									if ($rowCount > 0) {
										while ($row = $query->fetch_assoc()) {
											echo '<option value=' . $row['roomID'] . '>' . $row['roomID'] . '</option>';
										}
									} else {
										echo '<option value="">Room not available</option>';
									}
									mysqli_next_result($con);
									?>
 							</select>
 						</div>


 						<!-- <h4 class="modal-title">Room Reservation</h4>
      		<select class="form-control" id="Room">
             <option disabled selected hidden value="">Select Room..</option>
                   
                  <?php
									require $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/dbConnect.php';
									$query = $con->query("CALL getAllRoomID()");
									// $query = mysqli_query($connect, "CALL selectAllSubject") or die("Query fail: " . mysqli_error());
									$rowCount = $query->num_rows;
									if ($rowCount > 0) {
										while ($row = $query->fetch_assoc()) {
											echo '<option value=' . $row['roomID'] . '>' . $row['roomID'] . '</option>';
										}
									} else {
										echo '<option value="">Room not available</option>';
									}
									mysqli_next_result($con);
									?>
                  </select>
 -->




 					</div>
 					<div class="modal-body">

 						<div class="student-detail-wrap">
 							<div id="student-calendar"></div>
 						</div>


 					</div>

 					<div class="modal-footer">
 						<button type="button" id="stud-cal-close" class="btn btn-default" data-dismiss="modal">Close</button>

 					</div>


 				</div>

 			</div>
 		</div>
 		<!---------------------------------------------------- RESERVATION CALENDAR COLUMN  END---------------------------------------------------->

 		<form action="" methd="post" id="addSchedModal">
 			<div class="modal fade" id="create-roomSchedule" tabindex="-1" role="dialog" aria-labelledby="roomScheduleCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
 										<label>First Name</label>
 										<input autocomplete="off" type="text" class="form-control" id="inpt-fname" placeholder="First Name">
 									</div>
 									<div class="form-group col-md-6">
 										<label>Last Name</label>
 										<input autocomplete="off" type="text" class="form-control" id="inpt-lname" placeholder="Last Name">
 									</div>
 								</div>
 								<!-- COURSE -->
 								<div id="course-div" hidden>
 									<form action="" method="post">

 										<label for="scheduleCourse">Course</label>
 										<select class="form-control mb-1" type="text" name="scheduleCourse" id="Course" onChange="change_Course();" required>
 											<option disabled selected hidden value="">Select Course..</option>

 											<?php
												$query = $con->query("CALL selectAllCourse()");

												$rowCount = $query->num_rows;
												if ($rowCount > 0) {
													while ($row = $query->fetch_assoc()) {
														echo '<option value=' . $row['courseID'] . '>' . $row['courseID'] . '</option>';
													}
												} else {
													echo '<option value="">Course not available</option>';
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
 								</div>

 								<div id="org-div" hidden>
 									<label for="scheduleCourse">Organization</label>
 									<select class="form-control mb-1" type="text" name="scheduleCourse" id="Organization">
 										<option disabled selected hidden value="">Select Organization..</option>


 										<?php
											include '../schoolAdmin/Queries/readOrganizations.php';
											?>

 									</select>
 								</div>

 								<!-- PROFESSOR -->
 								<label>Professor</label>
 								<select id="Professor" class="form-control mb-1">
 									<option disabled selected hidden>Select Professor...</option>
 									<?php
										include '../schoolAdmin/Queries/readProfessors.php';
										?>
 								</select>


 								<!-- PURPOSE -->
 								<label for="scheduleReservationPurpose">Resersvation Purpose</label>

 								<select class="form-control mb-1" type="text" name="roomPurpose" id="roomPurpose" required>

 									<option disabled selected hidden>Select Purpose..</option>
 									<?php
										include($_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/student/php/SelectAllPurpose.php');
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
 				function resetSection() {

 					$("#addSchedModal")[0].reset();
 					$('#Section').empty();
 					$('#Section').append(' <option disabled selected hidden>Select Section..</option>');

 				}
 			</script>

 	</div>


 </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="/pupwebdev/auth/student/studentReservationCalendar.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
 <link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">
 <script src="/pupwebdev/assets/javascript/moment.min.js"></script>
 <script src="/pupwebdev/assets/javascript/fullcalendar390.min.js"></script>

 <script>
 	function getTransaction(objButton) {
 		document.getElementById("printButton").value = objButton.value;
 		// alert('inside function');
 		$.ajax({
 			url: "php/getNextQueueNumber.php",
 			method: "POST",
 			data: {
 				transactionNum: objButton.value
 			},
 			success: function() {
 				// alert("Event Removed");
 			}
 		});
 	}

 	function getOfficeCode(code) {
 		document.getElementById("offcode").innerHTML = code;
 	}




 	function change_Course() {
 		$("#Section").prop('disabled', false);
 		var xmlhttp = new XMLHttpRequest();
 		xmlhttp.open("GET", "ajax.php?course=" + document.getElementById("Course").value, false);
 		xmlhttp.send(null);
 		// alert(xmlhttp.responseText);
 		document.getElementById("section").innerHTML = xmlhttp.responseText;
 	}
 </script>
 <script type="text/javascript">
 	setInterval(function() {
 		$('#offnum').load("php/queuenumPrint.php");
 	}, 100);
 </script>

 <!-- DEKU/MICHAEL WORKS -->

<div class="modal fade" id="borrowingModal">
 	<div class="modal-dialog modal-lg">
 		<div class="modal-content">
 			<!-- Modal Header -->
 			<div class="modal-header">
 				<h4 class="col-12 modal-title text-center" id="sample">Print Queue Number</h4>
 			</div>
 			<!-- Modal body -->
 			<div class="modal-body">
 				<div class="card">
 					<div class="card-body">
 						<div class="tab-content" id="pills-tabContent">
 							<div class="card">
 								<div class="card-header">

 									<div class="form-group row borrowingInputs">
 										<input type="hidden" id="borrowertype" name="borrowertype" value="Class Rep" class="form-control">
 										<input type="hidden" id="borrowerid" name="borrowerid" class="form-control">
 										<input type="hidden" id="borrowingdetailsid" name="borrowingdetailsid" class="form-control">

 										<div class="col-3">
 											<label>Initial Date:</label>
 											<input type="date" name="initialdate" id="initialdate" class="form-control">
 										</div>

 										<div class="col-3">
 											<label>Due Date:</label>
 											<input type="date" name="duedate" id="duedate" class="form-control">
 										</div>

 										<div class="col-3">
 											<label>Start Time:</label>
 											<input type="time" name="stime" id="stime" class="form-control">
 										</div>

 										<div class="col-3">
 											<label>End Time:</label>
 											<input type="time" name="etime" id="etime" class="form-control">
 										</div>

 										<div class="col-4">
 											<label>Full Name:</label>
 											<input type="text" id="fullname" name="fullname" class="form-control" id="borrower-name" placeholder="Full Name" required>
 										</div>

 										<div class="col-4">
 											<label>Contact Number:</label>
 											<input type="text" id="contactnumber" name="contactnumber" class="form-control" id="borrower-no" maxlength="11" placeholder="Contact No#" required>
 										</div>

 										<div class="col-4">
 											<label>Organization:</label>
 											<select name="organization" id="organization" class="form-control">
 												<option selected value="" disabled>Select Organization</option>
 												<option value="Association of Competent and Aspiring Psychologists">ACAP</option>
 												<option value="Association of Electronics and Communication Engineering Students">AECES</option>
 												<option value=" Eligible League of Information Technology Enthusiasts">ELITE</option>
 												<option value="Guild of Imporous and Valuable Educator">GIVE</option>
 												<option value="Junior Marketing Association of the Philippines">JMAP</option>
 												<option value="Junior Executive of Human Resource Association">JPIA</option>
 												<option value="Philippine Institute of Industrial Engineers">PIIE</option>
 											</select>
										 </div>

										<div class="col">
											<label>Reason for Borrowing:</label>
											<input type="text" id="reason" name="reason" class="form-control" placeholder="Seminar" required>
										</div>
 									</div>
 								</div>
 								<div class="card-body">
 									<div class="search-etc mb-3">
 										<div class="row">
 											<div class="col-7" style="margin-left: 2.2rem;">
 												<div class="input-group" style="margin-left: -6%; ">
 													<input type="text" class="form-control" id="search" placeholder="Search by name.." aria-label="Search Iem.." aria-describedby="button-search">
 													<div class="input-group-append">
 														<button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
 													</div>
 												</div>
 											</div>
 											<button type="button" class="btn btn-pupcustomcolor request_item" style="margin-left: 25%;">Request</button>
 										</div>
 									</div>
 									<div id="live_table"></div>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
</div>

 <script>
 	$(document).ready(function() {
 		$('#search').keyup(function() {
 			var text = $(this).val();
 			if (text != '') {
 				$.ajax({
 					url: "../../public/borrow/functions/classRep_search.php",
 					method: "post",
 					data: {
 						search: text
 					},
 					dataType: "text",
 					success: function(data) {
 						$('#live_table').html(data);
 					}
 				});
 			} else {
 				fetch_data();
 			}
 		});

 		setInterval(function() {
 			getnextid();
 			getdetailsid();
 		}, 200);

 		function getnextid() {
 			$.ajax({
 				url: "../../public/borrow/functions/classRep_getborrowerid.php",
 				method: "post",
 				success: function(data) {
 					$('#borrowerid').val(data);
 				}
 			});
 		}

 		function getdetailsid() {
 			$.ajax({
 				url: "../../public/borrow/functions/classRep_getdetailsid.php",
 				method: "post",
 				success: function(data) {
 					$('#borrowingdetailsid').val(data);
 				}
 			});
 		}

 		function forceNumeric() {
 			var $input = $(this);
 			$input.val($input.val().replace(/[^\d]+/g, ''));
 		}
 		$('body').on('propertychange input', '#contactnumber', forceNumeric);
 		$('body').on('propertychange input', '#quantity', forceNumeric);
 		$('body').on('propertychange input', '.quantity', forceNumeric);


 		function fetch_data() {
 			//  alert();
 			$.ajax({
 				url: "../../public/borrow/functions/classRep_live.php",
 				method: "post",
 				success: function(data) {
 					$('#live_table').html(data);
 					//  alert(data);
 				}
 			});
 		}

 		function fetch_data2() {
 			$.ajax({
 				url: "../../public/borrow/functions/display_letter_print.php",
 				method: "post",
 				success: function(data) {
 					// alert(data);
 					$('#live_table2').html(data);
 				}
 			});
 		}

 		fetch_data();
 		fetch_data2();

 		$(document).on('click', '.print_letter_btn', function(e) {
 			e.preventDefault();
 			//window.location.href = "../borrow/documents/admin_classlist.php";


 			window.open('../borrow/documents/admin_classlist.php?borrowid=' + this.id, '_blank');
 		});

 		$(document).on('click', '.request_item', function(e) {
 			e.preventDefault();
 			var value = $('.checkboxid:checked').val();
 			if (value == undefined) {
 				alert("Select an Item first before requesting!");
 			} else {
 				checkfullname();
 				checkcontact();
 				checkinitialdate();
 				checkduedate();
 				checkreason();
 				checkorganization();
 				checkstime();
 				checketime();
 				if (checkfullname() != false && checkcontact() != false && checkduedate() != false && checkinitialdate() != false && checkreason() != false && checkorganization() != false && checkstime() != false && checketime() != false) {
 					var favorite = [];
 					var ids = [];
 					var numberchecked = 0;
 					$.each($("input[type='checkbox']:checked"), function() {
 						favorite.push($(this).val());
 						numberchecked = numberchecked + 1;
 					});

 					$.each($("input[type='checkbox']:checked"), function() {
 						var id = ($(this).attr('id'));
 						ids.push(id);
 					});

 					var chklength = favorite.length;
 					var error = 0;
 					for (var k = 0; k < chklength; k++) {

 						$('#' + favorite[k]).removeClass(' is-invalid');
 						if (ids[k] < $('#quanti' + favorite[k]).val() || $('#quanti' + favorite[k]).val() == 0) {
 							error = error + 1;
 							$('#quanti' + favorite[k]).addClass(' is-invalid');
 						}
 					}

 					if (error == 0) {
 						for (var k = 0; k < numberchecked; k++) {
 							var quantityvalue = $('#quanti' + favorite[k]).val();
 							var contactnumber = $('#contactnumber').val();
 							var fullname = $('#fullname').val();
 							var reason = $('#reason').val();
 							var organization = $('#organization').val();
 							var item = favorite[k];
 							var borrowerid = $('#borrowerid').val();
 							var borrowertype = $('#borrowertype').val();
 							var issuedate = $('#initialdate').val();
 							var duedates = $('#duedate').val();
 							var borrowingdetailsid = $('#borrowingdetailsid').val();
 							var stime = $('#stime').val();
 							var etime = $('#etime').val();

 							$.ajax({
 								url: "../../public/borrow/functions/classRep_insert.php",
 								data: {
 									quantityvalue: quantityvalue,
 									contactnumber: contactnumber,
 									fullname: fullname,
 									item: item,
 									borrowerid: borrowerid,
 									borrowertype: borrowertype,
 									issuedate: issuedate,
 									duedates: duedates,
 									borrowingdetailsid: borrowingdetailsid,
 									reason: reason,
 									organization: organization,
 									stime: stime,
 									etime: etime
 								},
 								method: "post",
 								success: function(data) {
 									fetch_data();
 									fetch_data2();
 								}
 							});
 						}
 						alert('Item successfully requested!');
 					}
 				}
 			}
 		});

 		function checkquantity() {
 			var quantity = $('.checkboxid:checked').attr("id");
 			var quantityvalue = $('#quantity').val();
 			if (Number($('#quantity').val()) > Number(quantity) || quantityvalue.trim().length == 0 || Number($('#quantity').val()) == 0) {
 				$('#quantity').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#quantity').removeClass(' is-invalid');
 			}
 		}

 		function checkinitialdate() {
 			var today = new Date();
 			var dd = String(today.getDate()).padStart(2, '0');
 			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
 			var yyyy = today.getFullYear();

 			today = yyyy + '-' + mm + '-' + dd;

 			var initialdate = $('#initialdate').val();
 			var duedate = $('#duedate').val();

 			if (initialdate == "" || Date.parse(duedate) < Date.parse(initialdate) || Date.parse(today) > Date.parse(initialdate)) {
 				$('#initialdate').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#initialdate').removeClass(' is-invalid');
 			}
 		}

 		function checkduedate() {
 			var today = new Date();
 			var dd = String(today.getDate()).padStart(2, '0');
 			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
 			var yyyy = today.getFullYear();

 			today = yyyy + '-' + mm + '-' + dd;

 			var initialdate = $('#initialdate').val();
 			var duedate = $('#duedate').val();

 			if (duedate == "" || Date.parse(duedate) < Date.parse(initialdate) || Date.parse(today) > Date.parse(duedate)) {
 				$('#duedate').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#duedate').removeClass(' is-invalid');
 			}
 		}

 		function checkfullname() {
 			var fullname = $('#fullname').val();
 			if (fullname.trim().length == 0) {
 				$('#fullname').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#fullname').removeClass(' is-invalid');
 			}
 		}

 		function checkreason() {
 			var reason = $('#reason').val();
 			if (reason.trim().length == 0) {
 				$('#reason').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#reason').removeClass(' is-invalid');
 			}
 		}

 		function checkorganization() {

 			var organization = $('#organization').val();
 			if (organization == null) {
 				$('#organization').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#organization').removeClass(' is-invalid');
 			}
 		}

 		function checkcontact() {
 			var contactnumber = $('#contactnumber').val();
 			if (contactnumber.trim().length == 0 || contactnumber.length != 11) {
 				$('#contactnumber').addClass(' is-invalid');
 				return false;
 			} else {
 				$('#contactnumber').removeClass(' is-invalid');
 			}
 		}

 		function checkstime() {
 			var sdate = $('#sdate').val();
 			var edate = $('#edate').val();

 			var stime = $('#stime').val();
 			var etime = $('#etime').val();

 			if (stime == "") {
 				$('#stime').removeClass(' is-valid');
 				$('#stime').addClass(' is-invalid');
 				return false;
 			} else {
 				if (stime > etime) {
 					$('#stime').removeClass(' is-valid');
 					$('#stime').addClass(' is-invalid');
 					return false;
 				} else {
 					$('#stime').removeClass(' is-invalid');
 				}
 			}
 		}

 		function checketime() {
 			var stime = $('#stime').val();
 			var etime = $('#etime').val();
 			str = etime.replace(":", '');
 			if (etime == "") {
 				$('#etime').removeClass(' is-valid');
 				$('#etime').addClass(' is-invalid');
 				return false;
 			} else {
 				if (etime < stime) {
 					$('#etime').removeClass(' is-valid');
 					$('#etime').addClass(' is-invalid');
 					return false;
 				} else {
 					$('#etime').removeClass(' is-invalid');
 				}
 			}
 		}
 	});
 </script>


 <!-- DEKU/MICHAEL WORKS -->