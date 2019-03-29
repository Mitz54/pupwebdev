<?php session_start(); 
require "logincheck.php";
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php'; ?>
<?php include 'functions/inventory_functions.php' ?>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills" id="inventorymodules-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="inventorymodules-stock-tab" data-toggle="pill" href="#inventorymodules-stock" role="tab" aria-controls="inventorymodules-stock" aria-selected="true">In-stock Items</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="inventorymodules-allitem-tab" data-toggle="pill" href="#inventorymodules-allitem" role="tab" aria-controls="inventorymodules-allitem" aria-selected="false">All Items</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="inventorymodules-donated-tab" data-toggle="pill" href="#inventorymodules-donated" role="tab" aria-controls="inventorymodules-donated" aria-selected="false">Donated Items</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="inventorymodules-condemned-tab" data-toggle="pill" href="#inventorymodules-condemned" role="tab" aria-controls="inventorymodules-condemned" aria-selected="false">Condemned Items</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col">
                      <div class="input-group">
                        <input type="text" class="form-control" id="search_general" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor" data-toggle="modal"  data-target="#addItemModal">Add Item</button>
                      <form method="POST" enctype="multipart/form-data" id="docuform_2" action="documents/admin_generalitem.php" target="_blank">
                        <input type="submit" class="btn btn-pupcustomcolor" name="print_pending" value ="Print list" style="margin-left: 20%; margin-top: -12%;">
                      </form>
                    </div>
                  </div>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table"></div> 
                <div class="float-right">
                </div>
              </div>
              <div class="tab-pane fade" id="inventorymodules-allitem" role="tabpanel" aria-labelledby="inventorymodules-allitem-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col">
                      <div class="input-group">
                        <input type="text" class="form-control" id="search_specific" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor add_item_specfic_button" data-toggle="modal"  data-target="#addItemSpecificModal">Add Item</button>
                      <form method="POST" enctype="multipart/form-data" id="docuform" action="documents/admin_allitem.php" target="_blank">
                        <input type="submit" class="btn btn-pupcustomcolor" name="print_specific" value ="Print list" style="margin-left: 20%; margin-top: -12%;">
                      </form>
                    </div>
                  </div>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table2"></div> 
              </div>
              <div class="tab-pane fade" id="inventorymodules-donated" role="tabpanel" aria-labelledby="inventorymodules-donated-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col">
                      <!-- <button type="button" class="btn btn-pupcustomcolor">Print list</button> -->
                    </div>
                  </div>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table3"></div> 
              </div>
              <div class="tab-pane fade" id="inventorymodules-condemned" role="tabpanel" aria-labelledby="inventorymodules-condemned-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col">
                      <!-- <button type="button" class="btn btn-pupcustomcolor">Print list</button> -->
                    </div>
                  </div>
                </div>
               <!-- For Live Table Data -->
                  <div id="live_table4"></div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStaffModalTitle">Add Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="add_form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="staffLastName">Item Name</label>
            <input class="form-control" type="text" name="itemname" id="itemname" placeholder="Chair, etc." required >
            <label for="staffFirstName">Item Description</label>
            <input class="form-control" type="text" name="description" id="description" placeholder="a separate seat for one person, etc." required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="add_confirm_general">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addItemSpecificModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStaffModalTitle">Add Specific Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="add_form_specific" enctype="multipart/form-data">
          <div class="form-group" id="fetch_data_5">

            

           

            

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="add_confirm_specific">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editItemGeneral" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStaffModalTitle">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="edit_general_form" enctype="multipart/form-data">
          <div id="edit_item_general"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="save_confirm_general">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editItemSpecific" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStaffModalTitle">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="edit_specific_form" enctype="multipart/form-data">
          <div id="edit_item_specific"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="save_confirm_specific">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteItemGeneral" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionAddConfirmModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="deleteItemIDGeneral" id="deleteItemIDGeneral">
        <h3>Are you sure?</h3><small>This action is irreversible.</small>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_general">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteItemSpecific" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionAddConfirmModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="deleteItemIDSpecific" id="deleteItemIDSpecific">
        <h3>Are you sure?</h3><small>This action is irreversible.</small>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_specific">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>  
$(document).ready(function()
{  

  $('#search_general').keyup(function()
  {
    var text = $(this).val();
    if(text != '')
    {
       $.ajax({
        url:"functions/inventory_search_general.php",
        method:"post",
        data:{search:text},
        dataType:"text",
        success:function(data)
        {
          $('#live_table').html(data);
        }
      });
    }
    else
    {
      fetch_data();
      fetch_data2();
      fetch_data3();
      fetch_data4();
    }
  });

  $('#search_specific').keyup(function()
  {
    var text = $(this).val();
    if(text != '')
    {
       $.ajax({
        url:"functions/inventory_search_specific.php",
        method:"post",
        data:{search:text},
        dataType:"text",
        success:function(data)
        {
          $('#live_table2').html(data);
        }
      });
    }
    else
    {
      fetch_data();
      fetch_data2();
      fetch_data3();
      fetch_data4();
    }
  });

  function fetch_data()
  {
    $.ajax({  
            url:"functions/inventory_live.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table').html(data);    
            }  
       });  
  }

  function fetch_data2()
  {
    $.ajax({  
            url:"functions/inventory_live2.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table2').html(data);    
            }  
       });  
  }

  function fetch_data3()
  {
   $.ajax({  
            url:"functions/inventory_live3.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table3').html(data);    
            }  
       });  
  }

  function fetch_data4()
  {
   $.ajax({  
            url:"functions/inventory_live4.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table4').html(data);    
            }  
       });  
  }

  function fetch_data5()
  {
   $.ajax({  
            url:"functions/inventory_live5.php",  
            method:"post",   
            success:function(data)
            {  
              $('#fetch_data_5').html(data);    
            }  
       });  
  }

  fetch_data();
  fetch_data2();
  fetch_data3();
  fetch_data4();

  //in-stock items commands ------------------------------------------------------>
  $(document).on('click','#add_confirm_general',function(e)
  {
    e.preventDefault();
    checkitemname();
    checkdescription();
    if(checkitemname() != false && checkdescription() != false)
    {
      if(confirm("Are you sure you want to add item?"))
      {
        var myform = document.getElementById("add_form");
        var fd = new FormData(myform );
        $.ajax({  
         url:"functions/inventory_general_item_add.php",  
         type:"POST",
         data:fd,
         cache: false,
         processData: false,
         contentType: false,  
         success:function(data)
         {  
          $('#add_form')[0].reset();  
          $('#itemname').removeClass(" is-invalid");
          $('#description').removeClass(" is-invalid");
          alert("Item Added!");
          $('#addItemModal').modal('hide');  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
         }  
      });
      }
    }
  });

  $(document).on('click', '.edit_data_general', function()
  {
    var itemid = $(this).attr("id");  

    $.ajax({  
        url:"functions/inventory_general_item_getdata.php",  
        method:"post",  
        data:{itemid:itemid},  
        success:function(data){  
          $('#edit_item_general').html(data);  
          $('#editItemGeneral').modal("show");  
        }  
    });  
  });

  $(document).on('click','#save_confirm_general',function(e)
  {
    e.preventDefault();
    checkgeneralitemname();
    checkgeneraldescription();
    if( checkgeneralitemname() != false && checkgeneraldescription() != false ) 
    {
      var itemid = $('#itemidgeneral').val();
      var itemname = $('#editgeneralitemname').val();
      var description = $('#editgeneraldescription').val();
      if(confirm("Are you sure you want to save changes?"))
      {
        $.ajax({  
         url:"functions/inventory_general_item_edit.php",  
         type:"POST",
         data:{itemid:itemid,itemname:itemname,description:description},
         success:function(data)
         {  
          $('#editgeneralitemname').removeClass(" is-invalid");
          $('#editgeneraldescription').removeClass(" is-invalid");
          alert("Item Details Updated!");
          $('#editItemGeneral').modal('hide');  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
         }  
      });
      }
    }
  });

  $(document).on('click', '.delete_data_general', function(){
    var itemid = $(this).attr("id");  
    $('#deleteItemIDGeneral').val(itemid);
    $.ajax({  
        success:function(data)
        {  
          $('#deleteItemGeneral').modal("show");  
        }  
    });  
  });

  $(document).on('click', '#delete_confirm_general', function(){
    var itemid = $('#deleteItemIDGeneral').val();
    $.ajax({  
        url:'functions/inventory_general_item_delete.php',
        data:{itemid:itemid},
        method:'post',
        success:function(data)
        {  
          alert("Item Deleted!");
          $('#deleteItemGeneral').modal("hide");  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
        }  
    });  
  });
  //in-stock items commands ------------------------------------------------------>

  //all items commands ------------------------------------------------------>
  $(document).on('click','#add_confirm_specific',function(e)
  {
    e.preventDefault();
    checkitem();
    checkcondition();
    checkunitprice();
    if(checkitem() != false && checkcondition() != false && checkunitprice() != false)
    {
      if(confirm("Are you sure you want to add item?"))
      {
        var myform = document.getElementById("add_form_specific");
        var fd = new FormData(myform );
        $.ajax({  
         url:"functions/inventory_specific_item_add.php",  
         type:"POST",
         data:fd,
         cache: false,
         processData: false,
         contentType: false,  
         success:function(data)
         {  
          $('#add_form_specific')[0].reset();  
          $('#selectItemId').removeClass(" is-invalid");
          $('#condition').removeClass(" is-invalid");
          alert("Item Added!");
          $('#addItemSpecificModal').modal('hide');  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
         }  
      });
      }
    }
  });

  $(document).on('click', '.edit_data_specific', function()
  {
    var iteminfoid = $(this).attr("id");  
    $.ajax({  
        url:"functions/inventory_specific_item_getdata.php",  
        method:"post",  
        data:{iteminfoid:iteminfoid},  
        success:function(data){  
          $('#edit_item_specific').html(data);  
          $('#editItemSpecific').modal("show");  
        }  
    });  
  });

  $(document).on('click','#save_confirm_specific',function(e)
  {
    e.preventDefault();
    checkconditionEdit();
    if(checkconditionEdit() != false && checkacquisitionedit() != false)
    {
      if(confirm("Are you sure you want to save changes?"))
      {
        var myform = document.getElementById("edit_specific_form");
        var fd = new FormData(myform );
        $.ajax({  
         url:"functions/inventory_specific_item_edit.php",  
         type:"POST",
         data:fd,
         cache: false,
         processData: false,
         contentType: false,  
         success:function(data)
         {   
          // alert(data);
          // $('#editgeneralitemname').removeClass(" is-invalid");
          // $('#editgeneraldescription').removeClass(" is-invalid");
          alert("Item Details Updated!");
          $('#editItemSpecific').modal('hide');  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
         }  
      });
      }
    }
  });

  $(document).on('click', '.delete_data_specific', function(){
    var itemid = $(this).attr("id");  
    $('#deleteItemIDSpecific').val(itemid);
    $.ajax({  
        success:function(data)
        {  
          $('#deleteItemSpecific').modal("show");  
        }  
    });  
  });

  $(document).on('click', '#delete_confirm_specific', function(){
    var iteminfoid = $('#deleteItemIDSpecific').val();
    $.ajax({  
        url:'functions/inventory_specific_item_delete.php',
        data:{iteminfoid:iteminfoid},
        method:'post',
        success:function(data)
        {  
          alert("Item Deleted!");
          $('#deleteItemSpecific').modal("hide");  
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
        }  
    });  
  });

  $(document).on('click','.add_item_specfic_button',function(e)
  {
  	e.preventDefault();
  	fetch_data5();
  });

  function checkitem()
  {
    if($('#selectItemId').val() == null)
    { 
      $('#selectItemId').removeClass(" is-valid");
      $('#selectItemId').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#selectItemId').removeClass(" is-invalid");
    }
  }

  function checkcondition()
  {
    if($('#condition').val().trim().length == 0)
    { 
      $('#condition').removeClass(" is-valid");
      $('#condition').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#condition').removeClass(" is-invalid");
    }
  }

  function checkconditionEdit()
  {
    if($('#conditionEdit').val().trim().length == 0)
    { 
      $('#conditionEdit').removeClass(" is-valid");
      $('#conditionEdit').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#conditionEdit').removeClass(" is-invalid");
    }
  }

  function checkunitprice()
  {
    if(Number($('#unitprice').val()) > 999999)
    { 
      $('#unitprice').removeClass(" is-valid");
      $('#unitprice').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#unitprice').removeClass(" is-invalid");
    }
  }

  function checkserialnumber()
  {
    if($('#serialnumber').val().trim().length == 0)
    { 
      $('#serialnumber').removeClass(" is-valid");
      $('#serialnumber').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#serialnumber').removeClass(" is-invalid");
    }
  }

  function checkwhereabouts()
  {
    if($('#whereabouts').val().trim().length == 0)
    { 
      $('#whereabouts').removeClass(" is-valid");
      $('#whereabouts').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#whereabouts').removeClass(" is-invalid");
    }
  }
  //all items commands ------------------------------------------------------>


  function checkitemname()
  {
    var itemname = $('#itemname').val();
    if(itemname.trim().length == 0)
    {
      $('#itemname').removeClass(" is-valid");
      $('#itemname').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#itemname').removeClass(" is-invalid");
    }
  }

  function checkdescription()
  {
    var description = $('#description').val();
    if(description.trim().length == 0)
    {
      $('#description').removeClass(" is-valid");
      $('#description').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#description').removeClass(" is-invalid");
    }
  }

  function checkgeneralitemname()
  {
    var itemname = $('#editgeneralitemname').val();
    if(itemname.trim().length == 0)
    {
      $('#editgeneralitemname').removeClass(" is-valid");
      $('#editgeneralitemname').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#editgeneralitemname').removeClass(" is-invalid");
    }
  }

  function checkgeneraldescription()
  {
    var description = $('#editgeneraldescription').val();
    if(description.trim().length == 0)
    {
      $('#editgeneraldescription').removeClass(" is-valid");
      $('#editgeneraldescription').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#editgeneraldescription').removeClass(" is-invalid");
    }
  }

  function checkacquisitionedit()
  {
    var date = $('#acquisitionEdit').val();
    if(date == "" || Date.parse(date) > Date.parse(new Date()))
    {
      $('#acquisitionEdit').removeClass(" is-valid");
      $('#acquisitionEdit').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#acquisitionEdit').removeClass(" is-invalid");
    }
  }
    
});
 
  

</script>