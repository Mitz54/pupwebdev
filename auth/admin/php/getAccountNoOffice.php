<?php
	
		// $dateToday = date("Y-m-d");
		include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
		$result = $con->query("SELECT * FROM office WHERE staffID_FK IS NULL ORDER BY officeName") or die($con->error());
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $HasAvailableOffice = true;
            }
        }
        else
        {
          $HasAvailableOffice = false;
        }
        mysqli_next_result($con);
		return $HasAvailableOffice;
	
?>