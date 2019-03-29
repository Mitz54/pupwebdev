<?php session_start(); 
require "logincheck.php";?>
<?php 
	 include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
      include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
      $selected = 0;
	    if(isset($_GET['submit'])){
		      $selected = $_GET['office'];
	    }
	    $selected = $selected;
		 $_SESSION['officeid'] = $selected;
?>
<style type="text/css">
  .submit {
    position: absolute;
    margin:-38px 0px 0px 430px;
  }
</style>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<script type="text/javascript">	// VALIDATIONS
  function UpdateConfirmation(){
    if (!confirm("Are you sure?")){
      return false;
    }
  }
</script>


<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-sm-8"><h2>Transaction</h2></div>
                    <div class="col">
                       <button class="btn btn-info add-new" type="button" id="button-search"><i class="fa fa-plus "></i>Add New
                       </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          <form method="get">
                            <select id="room-type-options" class="col form-control officeidid" name="office">
                              <option value="0">--SELECT OFFICE--</option>
                              <?php
                                $sql1 = "SELECT * FROM office";
                                $result1 = mysqli_query($con, $sql1);
                                while($row1 = mysqli_fetch_array($result1)){
									                if($selected == $row1['officeID']){
										                echo '<option value="'.$row1['officeID'].'" selected>'.$row1['officeName'].'</option>';
									                }
									                else{
										                echo '<option value="'.$row1['officeID'].'">'.$row1['officeName'].'</option>';
									                }
								                }
                               ?>
                                <!--<option selected>Administrative Office</option>
                                <option>Academic Office</option>
                                <option>Students Services</option>-->
                            </select>
                            <br>
							
                          </form>
                        </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover" id="transtable">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Transactions</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                  <?php

                    $sql2 = "SELECT * FROM transaction WHERE officeID_FK =".$selected;
                    $result2 = mysqli_query($con,$sql2);

                    while($row2 = mysqli_fetch_array($result2)){
                      $transactionID = $row2['transactionID'];
                      echo'<tr>
									           <td>'.$row2['transaction'].'</td>
									           <td>
                                <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a class="delete" onclick = "return UpdateConfirmation();"  title="Delete" data-toggle="tooltip" href = "php/deletetransaction.php?transID='.$transactionID.'&officeID='.$selected.'"><i class="material-icons">&#xE872;</i></a>
                             </td>
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
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<script src="\pupwebdev-kiosk\assets\javascript\jquery-3.2.0.min.js" type='text/javascript'></script>

<script type="text/javascript">
		
		
	$(document).ready(function(){

    $(document).on("change","#room-type-options", function(){

      var $selected = $(this).val();

      $.ajax({
				url:"transaction_load.php",
				method:"POST",
				data:{selected: $selected},
        success: function(data){

          $("#transtable").find("tbody").children().remove()
          $("#transtable").append(data);
        }
			});
  
      
    });
		
		
    //$("#rhoom-type-options").click(function(){
			//$.ajax({
				//url:"untitled.php",
				//method:"POST",
				//data:{breakNewCount: breakCount},
			//});
      //$("#transactionNum").load("loaddb.php", {breakNewCount: breakCount});
		//});
		//setInterval(function(){
			//$('#queueTable').load("loadQueueTable.php");
		//}, 100);
		
	});
</script>

<script src="scripts/Transaction.js" type="text/javascript"></script>
