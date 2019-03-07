<?php
	include_once 'includes/databse.php';
	session_start();
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	//$sql = "SELECT queue.queueNumber, transaction.transaction, queueingtransaction.queueingTransactionID,queueingtransaction.queueingTransactionDate, queueingTransaction.queueingTransactionStatus, transaction.officeID_FK, queueingtransaction.Remarks FROM queueingtransaction INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK WHERE queueingTransactionStatus = 'Pending';";
	$result = mysqli_query($conn, "call selectPendTable('$staffID')");
	$resultCheck = mysqli_num_rows($result);
		while ($row = mysqli_fetch_assoc($result)) {
			$array[] = $row;
			$qtID = $row['queueNumber'];
			echo '<tr>
							<td>'. $row['queueNumber'].'</td>
							<td>'.$row['queueingTransactionDate'].'</td>
							<td>'.$row['Remarks'].'</td>'.
							'<td><a href="deletePending.php?qtID='.$qtID.'" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a></td>
						</tr>';
		}
	
