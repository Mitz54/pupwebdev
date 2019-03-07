<?php
	
	function getQueuePerOffice($staffid)
	{
		$dateToday = date("Y-m-d");
		require 'db.php';
		$queues = array();
		$result = $mysqli->query("call pup.getQueueTableLimit7('$staffid')") or die($mysqli->error());
		while($row = mysqli_fetch_array($result))
		{
			$queues[] = $row["queueNumber"];
		}
		return $queues;
	}
?>
