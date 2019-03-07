<?php
	include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$stat = $_GET['stat'];	
	$name1 = $_GET['name'];
	$pur = $_GET['purpose'];
	$dt = $_GET['date'];
	$rm = $_GET['room'];
	$starttime = date("H:i:s", strtotime($_GET['starttime']));
	$endtime = date("H:i:s", strtotime($_GET['endtime']));
	$schedule = $_GET['sched'];

	$update = "CALL updateReservationStatus('$stat', '$name1', '$pur', '$dt', '$starttime', '$endtime', '$rm', '$schedule');";

    if ($con->query($update) === TRUE) 
    {
    	
        header('Location:http://localhost:1234/pupwebdev/auth/schoolAdmin/pending.php?');
	} 
	else 
	{
    	echo "Error Updating Record: '$db->error'";
        //header('Location:http://localhost:1234/pupwebdev/auth/admin/pending.php?');
    }


    
?>
