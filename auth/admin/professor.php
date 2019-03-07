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
                    <div class="col-sm-8"><h2>Professor</h2></div>
                    <div class="col">
                       <button class="btn btn-info add-new" type="button" id="button-search"><i class="fa fa-plus "></i>Add New
                       </button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">First Name</th>
                      <th scope="col">Middle Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');


                        $sql = 'CALL selectAllAllProfessor()';
                        $stmt = $con->prepare($sql);
                        $stmt->execute();

                        $stmt->bind_result($professorID, $firstName, $middleName, $lastName);
                        /* fetch values */
                        while ($stmt->fetch()) {
                          echo "<tr>";
                          echo "<td class = 'hidden professorID'>".
                          "<input type='hidden' class = 'old-value' value=".$professorID." />".
                          "</td>";
                          echo "<td class = 'editableColumns firstName'>".
                          "<div class='old-value' >". $firstName ."</div>".
                          "<input type='text' class='form-control hidden new-value' required maxlength='30' />".
                          "</td>";
                          echo "<td class = 'editableColumns middleName'>".
                          "<div class='old-value' >". $middleName ."</div>".
                          "<input type='text' class='form-control hidden new-value' required maxlength='30' />".
                          "</td>";
                          echo "<td class = 'editableColumns lastName'>".
                          "<div class='old-value' >". $lastName ."</div>".
                          "<input type='text' class='form-control hidden new-value' required maxlength='30' />".
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

<script src="/pupwebdev/auth/admin/scripts/Professor.js" type="text/javascript"></script>