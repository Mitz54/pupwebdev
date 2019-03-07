<?php session_start(); ?>
<?php
		include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
        $result = $con->query("SELECT * FROM pup.announcement;") or die($con->error());
        while($row = mysqli_fetch_array($result))
        {
            echo ($row["text"]) .  '&nbsp &nbsp &nbsp | &nbsp &nbsp &nbsp ' ;
        }
?>