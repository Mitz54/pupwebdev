<?php
	php include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php'); 
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
                echo "Current Serving: ". $_SESSION['PendingNum']."<br>". $row['transaction'];
								}
							}
						else if ($resultCheck == 0){
							$_SESSION['PendingNum'] = 0;
							echo "No Current Serving";
							}
						//	$_SESSION['PendingNum'] = implode($array[0], " ");

?>
