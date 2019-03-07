<?php

//mysqli
// insert Room to database
function insertRoom(mysqli $conn, $roomID, $roomType){

	// call insertRoom stored proc
	$sql = 'CALL insertRoom(?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $roomID, $roomType);
	$stmt->execute();

}
// update Room from database 
function updateRoom(mysqli $conn, $oldRoomID, $newRoomID, $roomType){

	// call updateRoom stored proc
	$sql = 'CALL updateRoom(?,?,?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $oldRoomID, $newRoomID, $roomType);
	$stmt->execute();

}
// delete Room from database 
function deleteRoom(mysqli $conn, $roomID){

	// call deleteRoom stored proc
	$sql = 'CALL deleteRoom(?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $roomID);
	$stmt->execute();
}
?>