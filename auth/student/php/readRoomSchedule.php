<?php


$data= array();
//$room =$_GET['room'];

  session_start();

selectRoomSched();
selectReservationSched();
function selectRoomSched()
{

    include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

// $room = $_POST['room'];

$selDate="";

$startdate = $_GET['startdate']; // 2018-10-18

//$startdate = $_GET['startdate'];
$date1 = str_replace('-', '/', $startdate);

/*$date1 = str_replace('-', '/', $startdate);
$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

echo ($tomorrow);*/


//$enddate = $_GET['enddate'];

$room =$_GET['room'];

$roomdata= array();

$query = "CALL selectAllRoomSchedule($room)";


$result = mysqli_query($con,$query);

$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);


   
    foreach($rows as $row)
    {
        switch($row["scheduleDay"])
        {
            case "Mon": $selDate=$date1;
            break;
            case "Tue": $selDate=date('Y-m-d',strtotime($date1 . "+1 days"));
            break;
            case "Wed": $selDate=date('Y-m-d',strtotime($date1 . "+2 days"));
            break;
            case "Thu": $selDate=date('Y-m-d',strtotime($date1 . "+3 days"));
            break;
            case "Fri": $selDate=date('Y-m-d',strtotime($date1 . "+4 days"));
            break;
            case "Sat": $selDate=date('Y-m-d',strtotime($date1 . "+5 days"));
            break;

        }

     $roomdata[] = array(
        'id'   => $row["scheduleID"],
        'title'   => $row["subjectID_FK"]."
                    ".$row["sectionID_FK"]."
                    ".$row["fullName"],
        'start'   => $selDate." ".$row["startTime"],
        'end'   => $selDate." ".$row["endTime"],
        'editable' => false,
        'selectable' => false,
        'selectHelper' => false,
        'textColor' => '#ffffff',
        'color' => '#BB2528',
// aa0000

   
        
    //   'startTime'   => $row["startTime"],
    //   'endTime'   => $row["endTime"],
    //   'subject'   => $row["subjectID_FK"],
    //   'section'   => $row["sectionID_FK"],
    //   'professor'   => $row["fullName"]
     );
    }
 $GLOBALS['data'] = $roomdata;


$con->close();
}

function selectReservationSched()
{
   include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
//echo"<script> alert('dfsdfs'); </script>";
// $room = $_POST['room'];

$selDate="";

$startdate = $_GET['startdate']; // 2018-10-18
$enddate =  date('Y-m-d',strtotime($startdate. '+6 days'));//$_GET['enddate'];
//$enddate = '2018-10-26';
//$startdate = $_GET['startdate'];
$date1 = str_replace('-', '/', $startdate);

/*$date1 = str_replace('-', '/', $startdate);
$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

echo ($tomorrow);*/




$room =$_GET['room'];

$reservedata=  $GLOBALS['data'];

$query = "CALL selectAllReservationSchedule($room,'$startdate','$enddate')";


$result = mysqli_query($con,$query);

$rows=mysqli_fetch_all($result,MYSQLI_ASSOC);


   
    foreach($rows as $row)
    {
        switch($row["scheduleDay"])
        {
            case "Mon": $selDate=$date1;
            break;
            case "Tue": $selDate=date('Y-m-d',strtotime($date1 . "+1 days"));
            break;
            case "Wed": $selDate=date('Y-m-d',strtotime($date1 . "+2 days")); 
            break;
            case "Thu": $selDate=date('Y-m-d',strtotime($date1 . "+3 days"));
            break;
            case "Fri": $selDate=date('Y-m-d',strtotime($date1 . "+4 days"));
            break;
            case "Sat": $selDate=date('Y-m-d',strtotime($date1 . "+5 days"));
            break;
        }

     if($row["reservationStatus"] ==="approved"){
        $reservedata[] = array(
        'id'   => $row["scheduleID"],
        'title'   =>$row["sectionID_FK"]."
                    ".$row["ProfName"]."   
                    ".$row["reservationStatus"],
        'start'   => $selDate." ".$row["startTime"],
        'end'   => $selDate." ".$row["endTime"],
        'editable' => false,
        'textColor' => '#ffffff',
        'color' => '#146B3B');
     }
  
    else{
         $reservedata[] = array(
        'classNames' => 'pending-event',
        'id'   => $row["scheduleID"],
        'title'   => $row["sectionID_FK"]."   
                    ".$row["ProfName"]."    
                    ".$row["reservationStatus"],
        'start'   => $selDate." ".$row["startTime"],
        'end'   => $selDate." ".$row["endTime"],
        'editable' => false,
        'color' => '#F8B229');
    }
        
   // $row["sectionID_FK"]."   |  ".$row["ProfName"]."   |   ".$row["reservationStatus"]
        
    //   'startTime'   => $row["startTime"],
    //   'endTime'   => $row["endTime"],
    //   'subject'   => $row["subjectID_FK"],
    //   'section'   => $row["sectionID_FK"],
    //   'professor'   => $row["fullName"]
    }

echo json_encode($reservedata);

$con->close();
}


?>





