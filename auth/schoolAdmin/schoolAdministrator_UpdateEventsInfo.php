<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$id = $_POST['id'];
$name = $_POST['name'];
$users = $_POST['users'];
$purpose =$_POST['purpose'];
$prof = $_POST['prof'];
$remarks= $_POST['remarks'];




// $sql = "UPDATE reservation set 	reservationUser = ".$name."
// 								,sectionID_FK = ".$section."
// 								,purposeID_FK = ".$purpose."
// 								,remarks = ".$remarks."
// 								,professorID_FK = ".$prof." 
// 								WHERE scheduleID_FK = ".$id;


// if ($con->query($sql) === TRUE) {

//   echo 'tama';
// } else {
//     echo "Error: " . $con->error;
// }


 $sql = "UPDATE reservation set 
                        reservationUser = '".$name."'
								,crowd_affected = '".$users."'
								,purposeID_FK = ".$purpose."
								,remarks = '".$remarks."'
								,professorID_FK = ".$prof." 
								WHERE scheduleID_FK = ".$id;

   
   if (mysqli_query($con, $sql)) {
      echo "Record updated successfully";
   } else {
      echo "Error updating record: " . mysqli_error($con);
   }
   mysqli_close($con);

?>