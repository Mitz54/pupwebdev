<?php
	echo "<script>alert();</script>";
  	session_start();
    require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
		$res = mysqli_query($con, "call selectNextQueueNumber(" . $_POST['transactionNum'] .")") or die("Query fail: " . mysqli_error());
	
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
    $_SESSION['queueNumber'] = $queueNum;
    $_SESSION['increaseNumber'] = $increase;
?>