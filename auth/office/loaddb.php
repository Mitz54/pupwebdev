<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	session_start();
	//$num1 = $_POST['profNewCount'];
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	//$profNewCount = $_SESSION['PendingNum'];
	//$queueCount = $_SESSION['PendingNum']+$num1;
$result = mysqli_query($con, "call selectQueueNumber($staffID)");
	$resultCheck = mysqli_num_rows($result);
						if ($resultCheck > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
				$_SESSION['PendingNum'] = $row['queueNumber'];
				echo '<h4>Queue Number</h4>';
      echo '<span class="queue-number" id="qNum">'. $_SESSION['PendingNum'] .'</span>';
		 echo '<div class="queue-requestbutton">';
		 echo  '<span>Transaction</span>';
     echo  '<span id="transaction">'.$row['transaction'].'</span>';
      echo  '<button type="button" class="btn btn-sm btn-warning" id="brkBtn">Break</button>
        <button type="button" class="btn btn-sm btn-warning" id="nxtBtn">Next</button>';
            //    echo "Current Serving: ". $_SESSION['PendingNum']."<br>". $row['transaction'];
								}
							}
						else if ($resultCheck == 0){
							echo '<h4>Queue Number</h4>';
      echo '<span class="queue-number" id="qNum">&nbsp;</span>';
		 echo '<div class="queue-requestbutton">';
		 echo  '<span >Transaction</span>';
     echo  '<span id="transaction">&nbsp;</span>';
      echo  '<button type="button" class="btn btn-sm btn-warning" id="brkBtn">Break</button>
        <button type="button" class="btn btn-sm btn-warning" id="nxtBtn">Next</button>';
              //  echo "Current Serving: ". $_SESSION['PendingNum']."<br>". $row['transaction'];
							}
						//	$_SESSION['PendingNum'] = implode($array[0], " ");
	$curlastqueue = include 'CheckLastTransaction.php';
	if($_SESSION['prevlastqueue'] != $curlastqueue)
		{
			if($curlastqueue == "")
			{

			}
			else {
				echo "<script>$('#btn-notif').trigger('click');</script>";
				echo '<script type="text/javascript">soundHandle.play();</script>';
			}
			//echo '<script type="text/javascript">alert('. $_SESSION['oldserving'] . ');</script>';
			$_SESSION['prevlastqueue'] = $curlastqueue;
		}
?>

<!-- <script src="\pupwebdev\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script> -->
<script type="text/javascript">
		
		
	$(document).ready(function(){
		var profcount =  0;
		var qCount =  0;
    var breakCount = 1;
		// var x = document.getElementById("pendRemark").value;
	
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
	});
		</script>
