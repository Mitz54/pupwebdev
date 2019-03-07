<?php session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

?>
<!-- <?php	//include_once 'includes/databse.php';?> -->


<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <!--
      <div class="module-container">
        <div class="row">
        <?php
            //session_start();
            $dateToday = date("Y-m-d");
            $staffID = $_SESSION['accntID'];
						$sql = "SELECT queue.queueNumber FROM `queueingtransaction` INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK INNER JOIN office ON office.officeID = transaction.officeID_FK where queueingTransactionStatus = 'Serving' and queueingTransactionDate = '$dateToday' and office.staffID_FK = $staffID LIMIT 1";
						$result = mysqli_query($conn,$sql);
						$resultCheck = mysqli_num_rows($result);
						if ($resultCheck > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['PendingNum'] = $row['queueNumber'];
                echo $_SESSION['PendingNum'];
								}
							}
						else{
							echo "No more students";
							}
						//	$_SESSION['PendingNum'] = implode($array[0], " ");
						
						 ?> </h1>
         <button class="btn btn-info next" type="submit" id="button03" style="float: right; margin-top: -50px;">Next</button>
    </div>
  </div> 
  -->

  <div class="row" style="width: 1000px">
    <div class="col-sm-6 htext">
      <div class="container ">
        <h1 class="text-white">Queue</h1>
          <div class="row">
            <div class="col-12 con">
              <div class="card">
                <div class="card-body">
                  <div class="table-wrapper-scroll-y">
                      <table class="table table-bordered table-hover table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Queue Number</th>
                          <th scope="col">Transactions</th>
                          <th scope="col">Date Queue</th>
                        </tr>
                      </thead>
                      <tbody id = "queueTable">
                      <?php
                      $dateToday = date("Y-m-d");
                      $staffID = $_SESSION['accntID'];
								$sql = "SELECT queue.queueNumber, transaction.transaction, queueingtransaction.queueingTransactionDate, queueingTransaction.queueingTransactionStatus, transaction.officeID_FK FROM queueingtransaction INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK INNER JOIN office ON office.officeID = transaction.officeID_FK WHERE queueingTransactionStatus = 'Waiting' and queueingTransactionDate = $dateToday and office.staffID_FK = $staffID;";
								$result = mysqli_query($con, $sql);
								$resultCheck = mysqli_num_rows($result);
								while ($row = mysqli_fetch_assoc($result)) {
									$array[] = $row;
									echo "<tr><td>" . $row['queueNumber'] . "</td>" ."<td>".$row['transaction']. "</td>"."<td>".$row['queueingTransactionDate'].  "</td></tr>";
									}
								
							?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="col-sm-6 htext">
      <div class="container ">
        <h1 class="text-white">Pending</h1>
          <div class="row">
            <div class="col-12 con">
              <div class="card">
                <div class="card-body">
                  <div class="table-wrapper-scroll-y">
                      <table class="table table-bordered table-hover table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col-sm-4">Queue Number</th>
                          <th scope="col-sm-4">Date Pend</th>
                          <th scope="col-sm-4">Remarks</th>
                          <th scope="col-sm-4">Actions</th>
                        </tr>
                      </thead>
                      <tbody id = "pendTable">
                      <?php
                      $staffID = $_SESSION['accntID'];
                      $dateToday = date("Y-m-d");
                $sql = "SELECT queue.queueNumber, transaction.transaction, queueingtransaction.queueingTransactionDate, queueingTransaction.queueingTransactionStatus, transaction.officeID_FK, queueingtransaction.Remarks FROM queueingtransaction INNER JOIN transaction ON transaction.transactionID = queueingtransaction.transactionID_FK INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK INNER JOIN office ON office.officeID = transaction.officeID_FK WHERE queueingTransactionStatus = 'Pending' and queueingTransactionDate = $dateToday and office.staffID_FK = $staffID;";
                $result = mysqli_query($con, $sql);
                $resultCheck = mysqli_num_rows($result);

                while ($row = mysqli_fetch_array($result)) {
                  $array[] = $row;
                  $qtID = $row['queueNumber'];
                  echo '<tr>
                          <td>'.$row['queueNumber'].'</td>
                          <td>'.$row['queueingTransactionDate'].'</td>
                          <td>'.$row['Remarks'].'</td>'.
                          '<td><a href="deletePending.php?qtID='.$qtID.'" class="delete" title="Done" data-toggle="tooltip"><i class="material-icons">&#xf268;</i></a></td>
                        </tr>';
                  }
              ?>
                      </tbody>
                    </table>
                  </div>
                </div>	
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <br><br><br>
  <div class="row">
    <div class="col">
    <form action = "PendNumber.php" method = "post">
      <input class="btn btn-info pend" type="submit" id="pendBut" name ="pendbt" value = "Pend" style="margin: -50px 0px 0px 30px;"/>
      <div class="col-sm-6">
      <input class="textbox-selected" style="position: absolute; margin: -55px 0px 0px 100px; width: 820px;" type="text" name="pendRemark" id="pendRemark" placeholder="Pend" autocomplete="off"required/>
      </form>
      <br>
      

  <?php
if(isset($_GET['pendbt'])){
  $_SESSION['remarks'] = $comm;
}
?>
    </div>
    </div>
  </div>
</div>
<div class="row" style="margin: -80px 0px 0px 50px;">
<div class="col">
  <input class="btn btn-info pend" type="submit" id="breakBtn" name ="breakbt" value = "Break"/>
</div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<!---<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>--->
<script src="\pupwebdev-kiosk\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script>

<script type="text/javascript">
		
		
	$(document).ready(function(){
		var profcount =  0;
		var qCount =  0;
    var breakCount = 1;
		var x = document.getElementById("pendRemark").value;
	
		$("#button03").click(function(){
			profcount = profcount + 1;
			qCount = qCount + 1;
			$.ajax({
				url:"queueTable.php",
				method:"POST",
				data:{queueNewCount: qCount},
			});
      $("#transactionNum").load("loaddb.php", {profNewCount: profcount});
		});
		$("#pendBut").click(function(){
			/*$.ajax({
				url:"PendNumber.php",
				method:"POST",
				data:{queueNewCount: qCount},
			});*/
      $("#transactionNum").load("loaddb.php", {profNewCount: profcount});
		});
    $("#breakBtn").click(function(){
			$.ajax({
				url:"breakButton.php",
				method:"POST",
				data:{breakNewCount: breakCount},
			});
      $("#transactionNum").load("loaddb.php", {breakNewCount: breakCount});
		});
		setInterval(function(){
			$('#queueTable').load("loadQueueTable.php");
		}, 100);
    setInterval(function(){
			$('#pendTable').load("loadPendTable.php");
		}, 500);
    setInterval(function(){
			$('#transactionNum').load("loaddb.php");
		}, 100);
		
	});
</script>

        </div>
      </div>
    </div>
  </div>
</div>







<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>