<?php
	
	function getQueuePerOfficeServing($staffid)
	{
		// $dateToday = date("Y-m-d");
		include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
		$result = $con->query("call pup.getQueueTableServing('$staffid')") or die($con->error());
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $serving = $row["queueNumber"];
            }
        }
        else
        {
            $serving = 0;
        }
		return $serving;
	}
?>
