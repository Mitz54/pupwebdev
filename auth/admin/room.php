<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php' ?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev/assets/stylesheet/admin.css" >

<!--hidden-->
<style>
  .hidden {
         display: none;
  }      
</style>

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
                    <div class="col-sm-8"><h2>Room</h2></div>
                    <div class="col">
                       <button class="btn btn-info add-new" type="button" id="button-search"><i class="fa fa-plus "></i>Add New
                       </button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Room ID</th>
                      <th scope="col">Room Type</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');


                        $sql = 'CALL selectAllRoom()';
                        $stmt = $con->prepare($sql);
                        $stmt->execute();

                        $stmt->bind_result($roomID, $roomType);
                        /* fetch values */
                        while ($stmt->fetch()) {
                          echo "<tr>";
                          echo "<td class = 'editableColumns roomID'>".
                          "<div class='old-value' >". $roomID ."</div>".
                          "<input type='text' class='form-control hidden new-value' required maxlength='10' />".
                          "</td>";
                          echo "<td class = 'editableColumns roomType'>".
                          "<div class='old-value' >". $roomType ."</div>".
                          "<select class='form-control hidden new-value'>
                                    <option selected>". $roomType. "</option>
                                    <option>office</option>
                                    <option>class</option>                                   
                                '</select>".
                          "</td>";

                          echo '<td>';
                          echo '<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>';
                          echo '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>';
                          echo '<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>';
                          echo '</td>';
                          echo "</tr>";
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

<script src="/pupwebdev/auth/admin/scripts/Room.js" type="text/javascript"></script>