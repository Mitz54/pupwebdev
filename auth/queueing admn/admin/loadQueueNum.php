<?php
session_start();
	include_once 'includes/databse.php';
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	$result = mysqli_query($conn, "call selectQueueNumber($staffID)");
	$resultCheck = mysqli_num_rows($result);
						if ($resultCheck > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['PendingNum'] = $row['queueNumber'];
                echo $_SESSION['PendingNum'];
								}
							}
						else{
							echo "No more students";
							}
						//	$_SESSION['PendingNum'] = implode($array[0], " ");
						
	
