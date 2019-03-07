<?php


include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');


 $room = $_GET['room'];


$date = date("m/d/Y");
$dayvalue=date("l");


if($dayvalue=="Sunday")
{
    $date1 = str_replace('-', '/', $date);
    $date = date('m/d/Y',strtotime($date1 . "+1 days"));
}



$ts = strtotime($date);
$year = date('o', $ts);
$week = date('W', $ts);



$data= array();

$query = "CALL selectAllRoomSchedule('$room')";


$result = mysqli_query($con,$query);;

$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);


   
    foreach($rows as $row)
    {
        switch($row["scheduleDay"])
        {
            case "Mon": $ts = strtotime($year.'W'.$week.'1'); $selDate=date("Y-m-d", $ts);
            break;
            case "Tue": $ts = strtotime($year.'W'.$week.'2'); $selDate=date("Y-m-d", $ts);
            break;
            case "Wed": $ts = strtotime($year.'W'.$week.'3'); $selDate=date("Y-m-d", $ts);
            break;
            case "Thu": $ts = strtotime($year.'W'.$week.'4'); $selDate=date("Y-m-d", $ts);
            break;
            case "Fri": $ts = strtotime($year.'W'.$week.'5'); $selDate=date("Y-m-d", $ts);
            break;
            case "Sat": $ts = strtotime($year.'W'.$week.'6'); $selDate=date("Y-m-d", $ts);
            break;

        }

     $data[] = array(
        'id'   => $row["scheduleID"],
        'title'   => $row["subjectID_FK"]."\n".$row["sectionID_FK"]."\n".$row["fullName"],
        'start'   => $selDate." ".$row["startTime"],
        'end'   => $selDate." ".$row["endTime"]
   
        
     );
    }

echo json_encode($data);
$con->close();

?>





