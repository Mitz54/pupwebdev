<?php session_start();
require "logincheck.php";
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

?>
<style>
.col-sm-6, .col-sm-8, .col-12,  .card-body {
  padding: 0;
}
.card{
  margin-right: 15px;
  height: 55vh;
  overflow-y: auto;
}
/* .col-sm-6, .col-sm-8,  .col-12,{
  padding: 0;
} */
h5{
 margin-top: 5px;
}
</style>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
      

  <div class="row">
    <div class="col-sm-6 htext">
     
      <div class="col-sm-8"><h2>Queue</h2></div>
          <div class="row">
            <div class="col-12 con">
              <div class="card">
                <div class="card-body">
                  <div class="table-wrapper-scroll-y">
                      <table class="table table-bordered table-hover table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Transactions</th>
                        </tr>
                      </thead>
                      <tbody id = "queueTable">
                      <?php
                      $dateToday = date("Y-m-d");
                      $staffID = $_SESSION['accntID'];
                      include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
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
      <br>
          <form class="row">
          <label class="switch">
          <input type="checkbox" id="notitoggle" value="notif" <?php if($_SESSION["notiToggle"] == 1){echo "checked";}?>>
          <span class="slider round"></span>
          </label>
          <h5>&nbsp; Notification</h5>
          </form>
    </div>

    <div class="col-sm-6 htext">
      <div class="col-sm-8"><h2>Pending</h2></div>
        <!-- <h1 class="text-white">Pending</h1> -->
          <div class="row">
            <div class="col-12 con">
              <div class="card">
                <div class="card-body">
                  <div class="table-wrapper-scroll-y">
                      <table class="table table-bordered table-hover table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col-sm-4">No.</th>
                          <th scope="col-sm-4">Date</th>
                          <th scope="col-sm-4">Remarks</th>
                          <th scope="col-sm-4"></th>
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
                          '<td><a href="deletePending.php?qtID='.$qtID.'" class="delete" title="Done" data-toggle="tooltip"><i class="fas fa-check fa-lg"></i></a></td>
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
      
      <br>
      <form class="row" action = "PendNumber.php" method = "post">
        <input class="btn btn-info pend" type="submit" id="pendBut" name ="pendbt" value = "Pend"/>
        <input class="txt-selected" type="text" name="pendRemark" id="pendRemark" placeholder="Remark/s" autocomplete="off"required/>
      </form>
    </div>
    
  </div>

    
  <?php
if(isset($_GET['pendbt'])){
  $_SESSION['remarks'] = $comm;
}
?>

  
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<!---<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>--->
<script src="\pupwebdev\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script>

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
    
    $("#notitoggle").click(function(){
			$.ajax({
				url:"notiftoggle.php",
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
		}, 1000);
    setInterval(function(){
			$('#transactionNum').load("loaddb.php");
		}, 4000);
		
	});
</script>

        </div>
      </div>
    </div>
  </div>
</div>