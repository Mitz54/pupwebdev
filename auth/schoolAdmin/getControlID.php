<?php
	include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$reservationID = $_POST['reserveID'];	

	$insert = "CALL insertReservationLetter('$reservationID');";

    $con->query($insert);


    // $select = "CALL selectMaxReservationLetterID();";

    // $con->query($select);



    //                     $query = $con->query("CALL selectMaxReservationLetterID()");
                    
    //                 $rowCount = $query->num_rows;

    //                 if($rowCount > 0)
    //                 {
    //                   while($row=$query->fetch_assoc())
    //                   {
    //                     echo json_encode($rows['reservationLetterID']);
    //                   }
    //                 }

    $query = "CALL selectMaxReservationLetterID()";


$result = mysqli_query($con,$query);

$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);


   
    foreach($rows as $row)
    {

    echo json_encode($row['reservationLetterID']);
}
    
?>

