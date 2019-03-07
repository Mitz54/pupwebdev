<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php';
      include_once 'includes/databse.php';
      $selected = 0;
	    if(isset($_GET['submit'])){
		      $selected = $_GET['office'];
	    }
	    $selected = $selected;
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<script type="text/­javascript">	// VALIDATIONS
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
                            <select id="room-type-options" class="col form-control" name="office">
                              <option value="0">--SELECT OFFICE--</option>
                              <?php
                                $sql1 = "SELECT * FROM office";
                                $result1 = mysqli_query($conn, $sql1);
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
                            <button type = "submit" name = "submit">Submit</button>
                          </form>
                        </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Transactions</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <?php

                    $sql2 = "SELECT * FROM transaction WHERE officeID_FK =".$selected;
                    $result2 = mysqli_query($conn,$sql2);

                    while($row2 = mysqli_fetch_array($result2)){
                      $transactionID = $row2['transactionID'];
                      echo'<tr>
									           <td>'.$row2['transaction'].'</td>
									           <td>
                                <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a onclick="return UpdateConfirmation();" class="delete" title="Delete" data-toggle="tooltip" href = "externalprocess/deletetransaction.php?transID='.$transactionID.'&officeID='.$selected.'"><i class="material-icons">&#xE872;</i></a>
                             </td>
								           </tr>';
                    }
                    echo '</tbody>
							             </table>';
                   ?>
                  <!--
                  <tbody>
                    <tr>
                      <td>Content</td>

                      <td>
                          <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                          <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                          <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                      </td>

                    </tr>
                    <tr>
                      <td>Content</td>

                      <td>
                          <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                          <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                          <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                      </td>

                    </tr>
                    <tr>
                     <td>Content</td>

                      <td>
                          <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                          <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                          <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                      </td>
                    </tr>
                  </tbody>
                </table> -->
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

<script src="/pupwebdev/auth/admin/scripts/Transaction.js" type="text/javascript"></script>
