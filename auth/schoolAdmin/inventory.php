<?php session_start(); include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php'; ?>
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
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table"></div> 
                <div class="float-right">
                </div>
              </div>
              <div class="tab-pane fade" id="inventorymodules-allitem" role="tabpanel" aria-labelledby="inventorymodules-allitem-tab">
                <div class="search-etc">
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

<div class="modal fade" id="deleteMultipleItemSpecific" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_multiple_specific">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteMultipleItemGeneral" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_multiple_general">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<style>
.toolbar1 {
    float:left;
}
.toolbar2 {
    float:left;
}
</style>

<script>  
$(document).ready(function()
{  
  $(document).on('click','.delete_all_item_general_button',function(e){
    e.preventDefault();
    if(confirm('are you sure you want to delete all items?'))
    {
      $.ajax({
        url:"functions/delete_all_general.php",
        method:"post",

        dataType:"text",
        success:function(data)
        {
          alert('Item(s) Deleted');
          fetch_data();
          fetch_data2();
          fetch_data3();
          fetch_data4();
        }
      });
    }
  });

  $(document).on('click','.delete_all_item_specfic_button',function(e){
    e.preventDefault();
    if(confirm('are you sure you want to delete all specific items?'))
    {
      $.ajax({
        url:"functions/delete_all_specific.php",
        method:"post",
        dataType:"text",
        success:function(data)
        {
          alert('Item(s) Deleted');
          fetch_data();
          fetch_data2();
          fetch_data3();
          fetch_data4();
        }
      });
    }
  });

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
              var table = $('#table_1').DataTable({
               pageLength: 5,
               "bLengthChange": false,
               dom: 'l<"toolbar1">frtip',
               initComplete: function(){
                $("div.toolbar1").html(' <button type="button" class="btn btn-pupcustomcolor ml-2" data-toggle="modal"  data-target="#addItemModal">Add Item</button> <input type="submit" class="btn btn-pupcustomcolor delete_item_general_button" value="Multiple Delete"> <input type="submit" class="btn btn-pupcustomcolor" name="print_pending" id="print_pending" value ="Print list" > <input type="submit" class="btn btn-pupcustomcolor confirm_delete_item_general_button ml-3 d-none" value="Confirm"> <input type="submit" class="btn btn-pupcustomcolor cancel_delete_item_general_button d-none" value="Cancel"> <input type="submit" class="btn btn-pupcustomcolor delete_all_item_general_button d-none" value="Delete All">');           
              }       
              });    
              var column = table.column(0);
              column.visible(!column.visible());
              //$('table#table_1 td:nth-child(1),th:nth-child(1)').hide();


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
              var table = $('#table_2').DataTable({
               pageLength: 5,
               "bLengthChange": false,

               dom: 'r<"toolbar2">frtip',
               initComplete: function(){
                $("div.toolbar2").html(' <input type="submit" class="btn btn-pupcustomcolor ml-2 add_item_specfic_button" data-toggle="modal"  data-target="#addItemSpecificModal" value="Add Item"> <input type="submit" class="btn btn-pupcustomcolor delete_item_specfic_button" value="Multiple Delete"> <input type="submit" class="btn btn-pupcustomcolor" name="print_specific" id="print_specific" value ="Print list"> <input type="submit" class="btn btn-pupcustomcolor confirm_delete_item_specfic_button ml-3 d-none" value="Confirm"> <input type="submit" class="btn btn-pupcustomcolor cancel_delete_item_specfic_button d-none" value="Cancel"> <input type="submit" class="btn btn-pupcustomcolor delete_all_item_specfic_button d-none" value="Delete All">');           
              }       
              });   
              var column = table.column(0);
              column.visible(!column.visible());
              // $('table#table_2 td:nth-child(1),th:nth-child(1)').hide();
              
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

   //document.getElementById("itemNumber").style.display="none";
   //$('#itemNumber').style.display = "none";
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
          $('#addItemModal').trigger('click');
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
          $('#editItemGeneral').trigger('click');
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
          $('#deleteItemGeneral').trigger('click');
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
    checkserialnumber();
    if(checkitem() != false && checkcondition() != false && checkunitprice() != false && checkserialnumber() != false)
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
          // alert(data);
          $('#add_form_specific')[0].reset();  
          $('#selectItemId').removeClass(" is-invalid");
          $('#condition').removeClass(" is-invalid");
          alert("Item Added!");
          $('#addItemSpecificModal').trigger('click');
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
    alert();
    checkconditionEdit();
    checkacquisitionedit();
    checkserialnumberedit();

    if(checkconditionEdit() != false && checkacquisitionedit() != false && checkserialnumberedit() != false)
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
            alert("Item Details Updated!");
            $('#editItemSpecific').trigger('click');
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
          $('#deleteItemSpecific').trigger('click');
          fetch_data();
          fetch_data2();
          fetch_data3();
           fetch_data4();
        }  
    });  
  });

  $(document).on('change','#radioitem',function(e)
  {
    if($('input[id="radioitem"]:checked').val() == "multipleItem")
    {
      $('#itemNumber').removeClass(' d-none');
      $('#numberItemLabel').removeClass(' d-none');
    }
    else
    {
      $('#itemNumber').val('');
      $('#itemNumber').addClass(' d-none');
      $('#numberItemLabel').addClass(' d-none');
    }
  });



  $(document).on('click','#print_pending',function(e)
  {
    e.preventDefault();
    window.open('documents/admin_generalitem.php', '_blank');
  });

  $(document).on('click','#print_specific',function(e)
  {
    e.preventDefault();
    window.open('documents/admin_allitem.php', '_blank');
  });

  $(document).on('click','.delete_item_specfic_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_item_specfic_button').removeClass(' d-none');
    $('.cancel_delete_item_specfic_button').removeClass(' d-none');
    $('.delete_all_item_specfic_button').removeClass(' d-none');
    $('.delete_item_specfic_button').addClass(' d-none');

    var userTable = $('#table_2').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());

  });

  $(document).on('click','.cancel_delete_item_specfic_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_item_specfic_button').addClass(' d-none');
    $('.cancel_delete_item_specfic_button').addClass(' d-none');
    $('.delete_all_item_specfic_button').addClass(' d-none');
    $('.delete_item_specfic_button').removeClass(' d-none');

    var userTable = $('#table_2').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
  });

  $(document).on('click','.confirm_delete_item_specfic_button',function(e)
   {
    e.preventDefault();

    if ($('input[id=item_specific_checkbox]').is(":checked")) 
    {
      $('#deleteMultipleItemSpecific').modal('show');

      $("#delete_confirm_multiple_specific").click(function()
      {
        $('input[id=item_specific_checkbox]').each(function () {
        var sThisVal = (this.checked ? "1" : "0");
        if(this.checked)
        {
          var iteminfoid = $(this).val();
          $.ajax({  
            url:'functions/inventory_specific_item_delete.php',
            data:{iteminfoid:iteminfoid},
            method:'post',
            success:function(data)
            {  
              $('#deleteMultipleItemSpecific').trigger('click');
              fetch_data();
              fetch_data2();
              fetch_data3();
              fetch_data4();
            }  
          });  
        }
        });
      });
    }
    else 
    {
      alert('Please select a Specific Item to delete');
    }
  
  });

  $(document).on('click','.confirm_delete_item_general_button',function(e)
   {
    e.preventDefault();

    if ($('input[id=item_general_checkbox]').is(":checked")) 
    {
      $('#deleteMultipleItemGeneral').modal('show');

      $("#delete_confirm_multiple_general").click(function()
      {
        $('input[id=item_general_checkbox]').each(function () {
        var sThisVal = (this.checked ? "1" : "0");
        if(this.checked)
        {
          var itemid = $(this).val();
          $.ajax({  
              url:'functions/inventory_general_item_delete.php',
              data:{itemid:itemid},
              method:'post',
              success:function(data)
              {  
                $('#deleteMultipleItemGeneral').trigger('click');
                fetch_data();
                fetch_data2();
                fetch_data3();
                fetch_data4();
              }  
          }); 
        }
        });
      });
    }
    else 
    {
      alert('Please select a General Item to delete');
    }
  
  });

  $(document).on('click','.delete_item_general_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_item_general_button').removeClass(' d-none');
    $('.cancel_delete_item_general_button').removeClass(' d-none');
    $('.delete_all_item_general_button').removeClass(' d-none');
    $('.delete_item_general_button').addClass(' d-none');

    var userTable = $('#table_1').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
  });

  $(document).on('click','.cancel_delete_item_general_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_item_general_button').addClass(' d-none');
    $('.cancel_delete_item_general_button').addClass(' d-none');
    $('.delete_all_item_general_button').addClass(' d-none');
    $('.delete_item_general_button').removeClass(' d-none');

    var userTable = $('#table_1').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
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
    if($('#serialnumber').val()  != "" && $('#serialnumber').val() != null)
    {
      var return_first = function () {
         var tmp = null;
         var serialnumber = $('#serialnumber').val();  
             $.ajax({
                async:false,  
                  url:"functions/check_serial_number.php",  
                  method:"POST",  
                  data:{serialnumber:serialnumber},  
                  dataType:"text",  
                  success:function(data)
                  {  
                    tmp = data;
                  }  
             }); 
           return tmp;
      }();

      if(return_first == 1)
      {
        $('#serialnumber').addClass(" is-invalid");
        $('#serialnumber-feedback').html('Serial Number already Exists'); 
        return false;
      }
      else
      {
        $('#serialnumber-feedback').html(''); 
        $('#serialnumber').removeClass(" is-invalid");
      }
    }
    else
    {
      $('#serialnumber').addClass(" is-invalid");
      $('#serialnumber-feedback').html('Please enter a Serial number'); 
      return false;
    }
    //$('#serialnumber').removeClass(" is-invalid");    
  }

  function checkserialnumberedit()
  {
    //alert($('#iteminfoidspecific').val());
    //$('#serialnumber').addClass(" is-invalid");
    var return_first = function () {
       var tmp = null;
       var serialnumber = $('#serialnumberEdit').val();
       var itemid = $('#iteminfoidspecific').val();   
           $.ajax({
              async:false,  
                url:"functions/check_serial_number.php",  
                method:"POST",  
                data:{serialnumber:serialnumber,itemid:itemid},  
                dataType:"text",  
                success:function(data)
                {  
                  //alert(data);
                   tmp = data;
                }  
           }); 
         return tmp;
    }();

    if(return_first == 1)
    {
      $('#serialnumberEdit').addClass(" is-invalid");
      $('#serialnumberEdit-feedback').html('Serial Number already Exists'); 
      return false;
    }
    else
    {
      $('#serialnumberEdit-feedback').html(''); 
      $('#serialnumberEdit').removeClass(" is-invalid");
    }
    //$('#serialnumber').removeClass(" is-invalid");
    
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