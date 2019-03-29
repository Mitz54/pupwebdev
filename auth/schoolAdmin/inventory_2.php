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
                <a class="nav-link active" id="inventorymodules-stock-tab" data-toggle="pill" href="#inventorymodules-stock" role="tab" aria-controls="inventorymodules-stock" aria-selected="true">Summary</a>
              </li>
  <!--             <li class="nav-item">
                <a class="nav-link" id="inventorymodules-allitem-tab" data-toggle="pill" href="#inventorymodules-allitem" role="tab" aria-controls="inventorymodules-allitem" aria-selected="false">All Items</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="inventorymodules-donated-tab" data-toggle="pill" href="#inventorymodules-donated" role="tab" aria-controls="inventorymodules-donated" aria-selected="false">Donated Items</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="inventorymodules-condemned-tab" data-toggle="pill" href="#inventorymodules-condemned" role="tab" aria-controls="inventorymodules-condemned" aria-selected="false">Condemned Items</a>
              </li> -->
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <form method="POST" enctype="multipart/form-data" id="docuform" action="documents/admin_inventory.php" target="_blank">
                  <div class="row">
                    <div class="col">
                      <label for="date_1">Start Date</label>
                      <div class="input-group">
                        <input type="date" class="form-control" id="date_1"  name="date_1">
                      </div>
                    </div>
                    <div class="col">
                      <label for="date_2">End Date</label>
                      <div class="input-group">
                        <input type="date" class="form-control" id="date_2" name="date_2">
                      </div>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor" name="generate" id="generate" style="margin-top: 9.5%;">Generate</button>
                      <input type="submit" class="btn btn-pupcustomcolor" name="print_pending" id='print_pending' value ="Print list" style="margin-left: 5%; margin-top: 9%;">
                    </div>
                  </div>
                  </form>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table"></div> 
                <div class="float-right">
              <!--     <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                      </li>
                    </ul>
                  </nav> -->
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
                      <button type="button" class="btn btn-pupcustomcolor" data-toggle="modal"  data-target="#addItemSpecificModal">Add Item</button>
                      <form method="POST" enctype="multipart/form-data" id="docuform" action="documents/admin_allitem.php" target="_blank">
                        <input type="submit" class="btn btn-pupcustomcolor" name="print_specific" value ="Print list" style="margin-left: 20%; margin-top: -12%;">
                      </form>
                    </div>
                  </div>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table2"></div> 
                <!-- <div class="float-right">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                      </li>
                    </ul>
                  </nav>
                </div> -->
              </div>
              <div class="tab-pane fade" id="inventorymodules-donated" role="tabpanel" aria-labelledby="inventorymodules-donated-tab">
                <div class="search-etc">
                  <div class="row">
                    <!-- <div class="col">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div> -->
                    <div class="col">
                      <!-- <button type="button" class="btn btn-pupcustomcolor">Print list</button> -->
                    </div>
                  </div>
                </div>
                  <!-- For Live Table Data -->
                  <div id="live_table3"></div> 
                <!-- <div class="float-right">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                      </li>
                    </ul>
                  </nav>
                </div> -->
              </div>
              <div class="tab-pane fade" id="inventorymodules-condemned" role="tabpanel" aria-labelledby="inventorymodules-condemned-tab">
                <div class="search-etc">
                  <div class="row">
                    <!-- <div class="col">
                      <div class="input-group">
                         <input type="text" class="form-control" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div> -->

                    <div class="col">
                      <!-- <button type="button" class="btn btn-pupcustomcolor">Print list</button> -->
                    </div>
                  </div>
                </div>
               <!-- For Live Table Data -->
                  <div id="live_table4"></div> 
                <!-- <div class="float-right">
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                      <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
                      </li>
                    </ul>
                  </nav>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<script>  
$(document).ready(function()
{  

  // $('#search_general').keyup(function()
  // {
  //   var text = $(this).val();
  //   if(text != '')
  //   {
  //      $.ajax({
  //       url:"functions/inventory_search_general.php",
  //       method:"post",
  //       data:{search:text},
  //       dataType:"text",
  //       success:function(data)
  //       {
  //         $('#live_table').html(data);
  //       }
  //     });
  //   }
  //   else
  //   {
  //     fetch_data();
  //     fetch_data2();
  //     fetch_data3();
  //     fetch_data4();
  //   }
  // });

  $(document).on('click','#generate',function(e)
  {
    e.preventDefault();
    fetch_data();
  });

  $(document).on('click','#print_pending',function(e)
  {
    checkdate();
    if(checkdate() != false)
    {

    }
    else
    {
      e.preventDefault();
    }
  });

  function fetch_data()
  {
    var date_1 = $('#date_1').val();
    var date_2 = $('#date_2').val();
    checkdate();
    if(checkdate() != false)
    { 
      $.ajax({  
            url:"functions/inventory_2_live.php", 
            data:{date_1:date_1,date_2:date_2}, 
            method:"post",   
            success:function(data)
            {  
              $('#live_table').html(data);    
            }  
       }); 
    }
  }

  function checkdate()
  {
    var date_1 = $('#date_1').val();
    var date_2 = $('#date_2').val();
    if(Date.parse(date_1) > Date.parse(date_2) || date_1 == "" || date_2 == "")
    {
      $('#date_1').addClass(' is-invalid');
      $('#date_2').addClass(' is-invalid');
      return false;
    }
  }

  // fetch_data();
  // fetch_data2();
  // fetch_data3();
  // fetch_data4();

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
    if( checkgeneralitemname() != false && checkgeneraldescription() != false)
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
          alert(data);
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
    if(checkconditionEdit != false)
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
    
});
 
  

</script>