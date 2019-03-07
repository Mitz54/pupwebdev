<?php session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php' ?>


<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- <link rel="stylesheet" href="/pupwebdev-student/assets/stylesheet/admin.css" > -->

<style type="text/css">
    .con
    {
      margin-top: 10px;
    }
    .htext
    {
      margin-top:120px;
    }
    .pupcolor
    {
      background-color: #7f0400;
    }
    .modaladjust
    {
      margin-top: 100px;
    }
    .btnadjust
    {
      height: 90px;
    }
    .contest
    {
      background-color: red;
      height: 500px;
    }
    .textsize
    {
      font-size: 24pt;
    }
    @page{
      size: 8.5in 11in;
    }

  	@media print {
		body * {
		  visibility: hidden;
		}
		#printArea * {
		  visibility: visible;
		  width:100%; 
		  height:100%;
		  page-break-after:always;
		  margin-left: auto;
		  margin-right: auto;
		  display: block;
		}
		#printArea {
		  position: absolute;
		;
		}
		#printArea button{
		  visibility: hidden;
		}

}


</style>


<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="container">
        <div class="col-12">
            <div class="row">
              <div class="col-12">
              <h2 class="text-white htext"> Choose Your Transaction </h2>
              </div>
            </div>
  <!------------------------------------------------------ QUEUE COLUMN ---------------------------------------------------->
  <div class="row">
  <?php
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';

		$res = mysqli_query($con, "call selectOffice()") or die("Query fail: " . mysqli_error());
		$officeID = array();
		$officeName = array();
		$officeHead = array();
		$officeRoom = array();
		$counter=0;

		while($row=mysqli_fetch_array($res))
		{
			$officeID[$counter] = $row['officeID'];
			$officeName[$counter] = strtoupper($row['officeName']);
			$officeHead[$counter] = strtoupper($row['firstName'] . " " . $row['lastName']);
			$officeRoom[$counter] = $row['roomID_FK'];
			$counter++;
		}
		mysqli_close($con);
		
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
		$res = mysqli_query($con, "call selectAllTransaction()") or die("Query fail: " . mysqli_error());
		$columnNames = array("transactionID","transaction","officeID_FK");
		$counter=0;
		
		while($row=mysqli_fetch_array($res))
		{
			for ($col=0;$col<3;$col++){
				$officeTransactions[$counter][$col]=$row[$columnNames[$col]];
			}
			$counter++;
		}
		mysqli_close($con);
		
		require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
		$res = mysqli_query($con, "call selectNextQueueNumber()") or die("Query fail: " . mysqli_error());
		
		while($row=mysqli_fetch_array($res))
		{
			if ($row['next']!=null)
				$queueNum=$row['next'];
			else
				$queueNum=1;
		}
		mysqli_close($con);
		
		if (isset($_POST['printModal']))
		{
			require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
			mysqli_query($con, 'call insertNewQueue("' . $queueNum . '", "' . date('Y-m-d') . '")') or die("Query fail: " . mysqli_error());
			
			$res = mysqli_query($con, 'call selectQueueID(' . $queueNum . ')') or die("Query fail: " . mysqli_error());
			while($row=mysqli_fetch_array($res))
			{
				$queueID=$row['queueID'];
			}
			mysqli_close($con);
			
			require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
			mysqli_query($con, 'call insertNewQueueingTransaction(' . $queueID . ', "' . date('Y-m-d') . '", ' . $_POST['printModal'] . ')') or die("Query fail: " . mysqli_error($con));
			mysqli_close($con);
			
			//-------------------------------KARL DITO KA MAGBAGO-----------------------------------------------
			
			/*$printer = "\\\\TETSUKY\\webdevPrinter"; 
			if($ph = printer_open($printer)) 
			{  
			   printer_set_option($ph, PRINTER_MODE, "RAW"); 
			   
			   $content="-------------------------" . $queueNum . "------------------------------"; 
			   
			   printer_write($ph, $content); 
			   printer_close($ph); 
			}*/
			
			//--------------------------------------------------------------------------------------------------
			
			header("Location: kiosk.php");
			exit(); 
		}
		
		$arrCount = count($officeID);
		for ($x=0;$x<$arrCount;$x++) {
			echo '<div class="col-sm-6 con">
				<div class="card-deck">
					<div class="card bg-white">
					   <div class="card-body text-center">
							 <h6 class="card-text">' . $officeName[$x] . '</h6>
							 <button class="btn btn-block text-white pupcolor"data-toggle="modal" data-target="#officeModal' . $officeID[$x] . '">Select</button>
							
						</div>
					</div>
				</div>
			</div>
			
			<!-- The Modal -->
			<div class="modal fade modaladjust" id="officeModal' . ($x+1) . '">
			<div class="modal-dialog">
			<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="col-12 modal-title text-center">Select Option</h4>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				<div class="card-deck">
					<div class="card bg-white">
						<div class="card-body text-center">
							<h3 class="card-text" style="margin: -15px 0px 0px 0px;">' . $officeName[$x] . '</h3>
                            <h5 class="card-text">' . $officeHead[$x] . '</h5>
                            <h6 class="card-text" style="margin: -5px 0px 5px 0px;">' . $officeRoom[$x] . '</h6>
							<div class="row">';
								
								for ($i=0;$i<count($officeTransactions);$i++)
								{
									if ($officeID[$x]==$officeTransactions[$i][2])
									{
										if ($officeTransactions[$i][0]==4)
										{
											
										}
										else
										{
											echo '<div class="col-6"><button class="card-text btnadjust pupcolor text-white" type="button" data-toggle="modal" data-target="#myModal" data-dismiss="modal"  id="transactionButton" value="' . $officeTransactions[$i][0] . '" onclick="getTransaction(this)">' . $officeTransactions[$i][1] . '</button></div>';
										}
										
									}
								}
								
						echo '</div>
					</div>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>';
			
		echo '<!-- The Modal(Print Queue) -->
					<div class="modal fade modaladjust" id="myModal">
						<div class="modal-dialog">
							<div class="modal-content">
							  <!-- Modal Header -->
							  <div class="modal-header">
								<h4 class="col-12 modal-title text-center" id="sample">Print Queue Number</h4>
							  </div>

							  <!-- Modal body -->
							  <div class="modal-body" id="printArea">
								<div class="card-deck">
								  <div class="card bg-white">
									<div class="card-body text-center">
										<h1 class="card-text">' . $queueNum . '</h1>
										<h5 class="card-text">Transaction Number</h5>
										<form method="post">
											<button class="btn btn-block text-white pupcolor" type="submit" name="printModal" id="printButton" value=" " onclick="window.print()">PRINT</button>
										</form>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						</div>
					</div>';
		}
  ?>
      

	
  </div>    
</div>
</div>
</div>

<!---------------------------------------------------- ANNOUNCEMENT COLUMN ---------------------------------------------------->
<div class="col-sm-6 htext">
  <div class="container ">
    <h2 class="text-white">Announcements</h2>
		
      <div class="row">
        <div class="col-12 con">
			<div class="card">
			<?php
				require $_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php';
				
				$res = mysqli_query($con, "call selectAllAnnouncement()") or die("Query fail: " . mysqli_error());
				$announcements = array();
				$counter=0;

				while($row=mysqli_fetch_array($res))
				{
					$announcements[$counter] = $row['text'];
					$counter++;
				}
				
				mysqli_close($con);
				
				if ($counter>0)
				{
					echo '<div class="card-body">';
					echo '<ul class="list-group list-group-flush">';
					for ($x=0;$x<$counter;$x++)
					{
						echo '<li class="list-group-item">' . $announcements[$x] . '</li>';
					}
					echo '</ul>';
					echo '</div>';
				} 	
			?>
			</div>
        </div>
      </div>
  </div>
</div>


</div>


  </div>
  
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/footer.php' ?>

<!--<script src="/pupwebdev-student/auth/admin/scripts/Course.js" type="text/javascript"></script>-->
<script>

function getTransaction(objButton){
	document.getElementById("printButton").value=objButton.value;
}
</script>
