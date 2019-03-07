<?php
	
	function getQueuePerOffice($staffid)
	{
		$dateToday = date("Y-m-d");
		include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
		$queues = array();
		$result = $con->query("call pup.getQueueTableLimit7('$staffid')") or die($con->error());
		while($row = mysqli_fetch_array($result))
		{
			$queues[] = $row["queueNumber"];
		}
		return $queues;
	}
?>
