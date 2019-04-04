<?php


$data= array();
selectReservationSched();

function selectReservationSched()
{
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$query = "select * from borrowingdetails inner join borrower on borrower.borrowerID = borrowingdetails.borrowerID_FK;";


$result = mysqli_query($con,$query);

$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);


   
    foreach($rows as $row)
    {
     $reservedata[] = array(
        'id'   => $row["borrowingDetailsID"],
        'title'   => $row["reason"],
        'start'   => $row["initialDate"]." ".$row["startTime"],
        'end'   => $row["dueDate"]." ".$row["endTime"],
        'editable' => true,
            'color' => '#28a058'
     );
    }

echo json_encode($reservedata);

$con->close();
}


?>





