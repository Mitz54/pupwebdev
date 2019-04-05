<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	session_start();
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	//$sql = "SELECT queue.queueNumber, transaction.transaction, queueingtransaction.queueingTransactionID,queueingtransaction.queueingTransactionDate, queueingTransaction.queueingTransactionStatus, transaction.officeID_FK, queueingtransaction.Remarks FROM queueingtransaction INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK WHERE queueingTransactionStatus = 'Pending';";
	$result = mysqli_query($con, "call selectPendTable('$staffID')");
	$resultCheck = mysqli_num_rows($result);
		while ($row = mysqli_fetch_assoc($result)) {
			$array[] = $row;
			$qtID = $row['queueNumber'];
			$date = $row['queueingTransactionDate'];
			echo '<tr>
							<td>'. $row['queueNumber'].'</td>
							<td>'.$row['queueingTransactionDate'].'</td>
							<td>'.$row['Remarks'].'</td>'.
							'<td><a href="deletePending.php?qtID='.$qtID.'&date='.$date.'" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
						</tr>';
		}
	
