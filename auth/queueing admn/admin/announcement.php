<?php session_start(); ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/header.php' ?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/CSS/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/pupwebdev-kiosk/assets/stylesheet/admin.css" >

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
                    <div class="col-sm-8"><h2>Announcement</h2></div>
                    <div class="col">
                       <button class="btn btn-info add-new" type="button" id="button-search"><i class="fa fa-plus "></i>Add New
                       </button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Information</th>
                      <th scope="col">Actions</th>

                    </tr>
                  </thead>
                  <tbody>
                   
                      <?php include('php/ShowAnnouncement.php'); foreach($array as $key=>$value): ?>
						<tr>
						<td> <?php echo $array[$key]['text']; $id = $array[$key]['announcementID'];?>  </form> </td> 


					
					
                      <td>
                          <a class="add" title="Add" data-toggle="tooltip" ><i class="material-icons">&#xE03B;</i></a>
                          <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                          <a class="delete" onclick = "return UpdateConfirmation();" title="Delete" data-toggle="tooltip" href = "/pupwebdev-kiosk/auth/admin/php/DeleteAnnouncement.php?key=<?php echo $id ?>"><i class="material-icons">&#xE872;</i></a>
                      </td>
                  <?php endforeach; ?>
                    </tr>
                
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

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev-kiosk/auth/footer.php' ?>

<script src="/pupwebdev-kiosk/auth/admin/scripts/Announcement.js" type="text/javascript"></script>