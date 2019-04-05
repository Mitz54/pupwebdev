<?php session_start(); include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php'; ?>

<?php include 'functions/stafffunction.php' ?>

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills" id="staffmodules-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="staffmodules-list-tab" data-toggle="pill" href="#staffmodules-list" role="tab" aria-controls="staffmodules-list" aria-selected="true">List of Staff</a>
              </li>
              <li class="nav-item">
               <a class="nav-link" id="deletedstaffmodules-list-tab" data-toggle="pill" href="#deletedstaffmodules-list" role="tab" aria-controls="deletedstaffmodules-list" aria-selected="true">List of Deleted Staff</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="staffmodules-list" role="tabpanel" aria-labelledby="staffmodules-list-tab">
                <div class="search-etc">

                </div>
                <div id="live_table"></div>
              </div>

              <div class="tab-pane fade show" id="deletedstaffmodules-list" role="tabpanel" aria-labelledby="deletedstaffmodules-list-tab">
                <div class="search-etc">
                </div>
                <div id="live_table_2"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStaffModalTitle">Add Staff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="add_form" action ="createstaff.php">
          <div class="form-group">
            <!-- for new id -->
            <input type="hidden" name="newid" id="newid">
            <label for="staffLastName">Last Name</label>
            <input class="form-control" type="text" name="staffLastName" id="staffLastName"  maxlength="35" placeholder="Smith, etc." required >
            <label for="staffFirstName">First Name</label>
            <input class="form-control" type="text" name="staffFirstName" id="staffFirstName" maxlength="35" placeholder="John, etc." required>
            <label for="staffMiddleName">Middle Name</label>
            <input class="form-control" type="text" name="staffMiddleName" id="staffMiddleName" maxlength="35" placeholder="Thomas, etc." required>

            <br>

            <label for="staffUsername">Username</label>
            <input class="form-control" type="text" name="staffUsername" id="staffUsername" maxlength='30' placeholder="admin3, etc." required >
            <div class="invalid-feedback" id="username-feedback"></div>
            <label for="staffPassword">Password</label>
            <input class="form-control" type="password" name="staffPassword" id="staffPassword_first" maxlength='30' placeholder="********" required>
            <label for="staffConfirmPassword">Confirm Password</label>
            <input class="form-control" type="password" name="staffConfirmPassword" id="staffPassword_second" maxlength='30' placeholder="********" required>

            <label for="staffAccounType">Account Type</label>
            <select class="custom-select" name="accountType" id="accountType">
              <option value="admin">Head Amdministrator</option>
              <option value="admin">Administrator</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="add_confirm">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="actionAddConfirmModal" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionAddConfirmModalTitle">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <h3>Are you sure?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor" id="add_account">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="actionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteModalTitle">Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="staff_id_delete" id="staff_id_delete">
        <h3>Are you sure?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor confirm_delete">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

 z<small>This action is irreversible.</small>

<div class="modal fade" id="actionRestoreModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteModalTitle">Restore Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="staff_id_restore" id="staff_id_restore">
        <h3>Are you sure?</h3> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor confirm_restore">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="actionPermanentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteModalTitle">Permanent Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="staff_id_permanent" id="staff_id_permanent">
        <h3>Are you sure?</h3> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor confirm_permanent">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteMultipleStaffGeneral" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_multiple_staff">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteMultipleStaffGeneralDeleted" tabindex="-1" role="dialog" aria-labelledby="actionAddConfirmModalTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-pupcustomcolor" id="delete_confirm_multiple_staff_deleted">Confirm</button>
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
  setInterval(function()
  {
     getnextid(); 
  }, 200);

  $('#search_name').keyup(function()
  {
    var text = $(this).val();
    if(text != '')
    {
       $.ajax({
        url:"functions/staff_search.php",
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
    }
  });

  $('#search_deleted_name').keyup(function()
  {
    var text = $(this).val();
    if(text != '')
    {
       $.ajax({
        url:"functions/staff_search_2.php",
        method:"post",
        data:{search:text},
        dataType:"text",
        success:function(data)
        {
          $('#live_table_2').html(data);
        }
      });
    }
    else
    {
      fetch_data2();
    }
  });


  function fetch_data()
  {
    $.ajax({  
            url:"functions/staff_live.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table').html(data);    
              var table = $('#table_1').DataTable({
               pageLength: 5,
               "bLengthChange": false,
               dom: 'l<"toolbar1">frtip',
               initComplete: function(){
                $("div.toolbar1").html(' <button type="button" class="btn btn-pupcustomcolor" data-toggle="modal"  data-target="#addStaffModal">Add staff</button> <input type="submit" class="btn btn-pupcustomcolor delete_multiple_staff_button" value="Multiple Delete"> <input type="submit" class="btn btn-pupcustomcolor confirm_delete_multiple_staff_button ml-3 d-none" value="Confirm"> <input type="submit" class="btn btn-pupcustomcolor cancel_delete_multiple_staff_button d-none" value="Cancel">');           
              }       
              });    
              var column = table.column(0);
              column.visible(!column.visible());
            }  
       });  
  }

  function fetch_data2()
  {
    $.ajax({  
            url:"functions/staff_live_2.php",  
            method:"post",   
            success:function(data)
            {  
              $('#live_table_2').html(data);    
              var table = $('#table_2').DataTable({
               pageLength: 5,
               "bLengthChange": false,
               dom: 'l<"toolbar2">frtip',
               initComplete: function(){
                $("div.toolbar2").html(' <input type="submit" class="btn btn-pupcustomcolor delete_multiple_staff_deleted_button" value="Multiple Delete"> <input type="submit" class="btn btn-pupcustomcolor confirm_delete_multiple_staff_deleted_button ml-3 d-none" value="Confirm"> <input type="submit" class="btn btn-pupcustomcolor cancel_delete_multiple_staff_deleted_button d-none" value="Cancel">');           
              }       
              });    
              var column = table.column(0);
              column.visible(!column.visible());
            }  
       });  
  }

  fetch_data();
  fetch_data2();

  function getnextid()
  {
    $.ajax({  
            url:"functions/staff_getid.php",  
            method:"post",   
            success:function(data)
            {  
              $('#newid').val(data);    
            }  
       });
  }

  $(document).on('click','.permanent_staff_button',function(e)
  {
    e.preventDefault();
    $('#staff_id_permanent').val($(this).attr('id'));
    $('#actionPermanentDeleteModal').modal('show');
  });

  $(document).on('click','.confirm_permanent',function(e)
  {
    e.preventDefault();
    var profid = $('#staff_id_permanent').val();
    $.ajax({
      url:'functions/staff_permanent.php',
      data:{profid,profid},
      method:'post',
      success:function(data)
      {
        alert('Staff Deleted');
        $('#actionPermanentDeleteModal').trigger('click');

        fetch_data2();
      }
    });
  });

  $(document).on('click','.delete_staff_button',function(e)
  {
    e.preventDefault();
    $('#staff_id_delete').val($(this).attr('id'));
    $('#actionDeleteModal').modal('show');
  });

  $(document).on('click','.confirm_delete',function(e)
  {
    e.preventDefault();
    var profid = $('#staff_id_delete').val();
    $.ajax({
      url:'functions/staff_delete.php',
      data:{profid,profid},
      method:'post',
      success:function(data)
      {
        alert('Staff Deleted');
        $('#actionDeleteModal').trigger('click');;
        fetch_data();
      }
    });
  });

  $(document).on('click','.restore_staff_button',function(e)
  {
    e.preventDefault();
    $('#staff_id_restore').val($(this).attr('id'));
    $('#actionRestoreModal').modal('show');
  });

  $(document).on('click','.confirm_restore',function(e)
  {
    e.preventDefault();
    var profid = $('#staff_id_delete').val();
    $.ajax({
      url:'functions/staff_delete.php',
      data:{profid,profid},
      method:'post',
      success:function(data)
      {
        alert('Staff Deleted');
        fetch_data();
      }
    });
  });

  $(document).on('click','#add_confirm',function(e)
  {
  	e.preventDefault();
    checklast();
    checkfirst();
    checkmiddle();
    checkusername();
    checkpassword1();
    checkpassword2();
    if(checklast() != false && checkfirst() != false && checkmiddle() != false && checkusername() != false && checkpassword1() != false && checkpassword2() != false)
    {
    	checkpassword();
    	if(checkpassword() != false)
    	{
    		var myform = document.getElementById("add_form");
			var fd = new FormData(myform);
			$.ajax({  
			     url:"functions/staff_createstaff.php",  
			     type:"POST",
			     data:fd,
			     cache: false,
			     processData: false,
			     contentType: false,
			     beforeSend:function()
			     {
			      
			     },
			     success:function(data)
			     {  
			      fetch_data();
			      alert("Staff Created!!");
			      $('#add_form')[0].reset();  
			      $('#addStaffModal').trigger('click');
			     }  
			});
    	}
    	else
    	{
    		alert("Password do not match");
    	}
    }
    
  });

  $(document).on('click','.delete_multiple_staff_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_multiple_staff_button').removeClass(' d-none');
    $('.cancel_delete_multiple_staff_button').removeClass(' d-none');
    $('.delete_multiple_staff_button').addClass(' d-none');

    var userTable = $('#table_1').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());

  });

  $(document).on('click','.cancel_delete_multiple_staff_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_multiple_staff_button').addClass(' d-none');
    $('.cancel_delete_multiple_staff_button').addClass(' d-none');
    $('.delete_multiple_staff_button').removeClass(' d-none');

    var userTable = $('#table_1').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
  });

  $(document).on('click','.confirm_delete_multiple_staff_button',function(e)
   {
    e.preventDefault();

    if ($('input[id=prof_checkbox]').is(":checked")) 
    {
      $('#deleteMultipleStaffGeneral').modal('show');

      $("#delete_confirm_multiple_staff").click(function()
      {
        $('input[id=prof_checkbox]').each(function () {
        {
          if(this.checked)
          {
            var profid = $(this).val();
            $.ajax({  
                url:'functions/staff_delete.php',
                data:{profid:profid},
                method:'post',
                success:function(data)
                {  
                  $('#deleteMultipleStaffGeneral').trigger('click');
                  fetch_data();
                  fetch_data2();
                }  
            }); 
          }
        }
        });
      });
    }
    else 
    {
      alert('Please select a Staff to delete');
    }
  });


  $(document).on('click','.delete_multiple_staff_deleted_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_multiple_staff_deleted_button').removeClass(' d-none');
    $('.cancel_delete_multiple_staff_deleted_button').removeClass(' d-none');
    $('.delete_multiple_staff_deleted_button').addClass(' d-none');

    var userTable = $('#table_2').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
  });

  $(document).on('click','.cancel_delete_multiple_staff_deleted_button',function(e)
  {
    e.preventDefault();

    $('.confirm_delete_multiple_staff_deleted_button').addClass(' d-none');
    $('.cancel_delete_multiple_staff_deleted_button').addClass(' d-none');
    $('.delete_multiple_staff_deleted_button').removeClass(' d-none');

    var userTable = $('#table_2').DataTable();
    var column = userTable.column(0);
    column.visible(!column.visible());
  });

  $(document).on('click','.confirm_delete_multiple_staff_deleted_button',function(e)
   {
    e.preventDefault();

    if ($('input[id=prof_checkbox_deleted]').is(":checked")) 
    {
      $('#deleteMultipleStaffGeneralDeleted').modal('show');

      $("#delete_confirm_multiple_staff_deleted").click(function()
      {
        $('input[id=prof_checkbox_deleted]').each(function () {
        {
          if(this.checked)
          {
            var profid = $(this).val();
            $.ajax({  
                url:'functions/staff_permanent.php',
                data:{profid:profid},
                method:'post',
                success:function(data)
                {  
                  $('#deleteMultipleStaffGeneralDeleted').trigger('click');
                  fetch_data();
                  fetch_data2();
                }  
            }); 
          }
        }
        });
      });
    }
    else 
    {
      alert('Please select a Staff to permanently delete');
    }
  });

  function checklast()
  {
    var last_length = $('#staffLastName').val().length;
    var last = $('#staffLastName').val();
    if( last.trim().length == 0)
    {
      $('#staffLastName').removeClass(" is-valid");
      $('#staffLastName').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#staffLastName').removeClass(" is-invalid");
    }
  }

  function checkfirst()
  {
    var last_length = $('#staffFirstName').val().length;
    var last = $('#staffFirstName').val();
    if(last.trim().length == 0)
    {
      $('#staffFirstName').removeClass(" is-valid");
      $('#staffFirstName').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#staffFirstName').removeClass(" is-invalid");
    }
  }

  function checkmiddle()
  {
    var last_length = $('#staffMiddleName').val().length;
    var last = $('#staffMiddleName').val();
    if(last.trim().length == 0)
    {
      $('#staffMiddleName').removeClass(" is-valid");
      $('#staffMiddleName').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#staffMiddleName').removeClass(" is-invalid");
    }
  }

  function checkusername()
  {
    var last_length = $('#staffUsername').val().length;
    var last = $('#staffUsername').val();
    if(last.trim().length == 0)
    {
      $('#username-feedback').html(''); 
      $('#staffUsername').removeClass(" is-valid");
      $('#staffUsername').addClass(" is-invalid");
      return false;
    }
    else
    {
      var return_first = function () {
         var tmp = null;
         var username = last;  
             $.ajax({
                async:false,  
                  url:"functions/check_username.php",  
                  method:"POST",  
                  data:{username:username},  
                  dataType:"text",  
                  success:function(data)
                  {  
                    
                     tmp = data;
                  }  
             }); 
           return tmp;
      }();
      //alert(return_first);

      if(return_first == 1)
      {
        $('#username-feedback').html('Username already Exists'); 
        $('#staffUsername').addClass(" is-invalid");
      }
      else
      {
        $('#username-feedback').html(''); 
        $('#staffUsername').removeClass(" is-invalid");
      }

      
    }
  }

  function checkpassword1()
  {
    var last_length = $('#staffPassword_first').val().length;
    var last = $('#staffPassword_first').val();
    if(last.trim().length == 0)
    {
      $('#staffPassword_first').removeClass(" is-valid");
      $('#staffPassword_first').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#staffPassword_first').removeClass(" is-invalid");
    }
  }

  function checkpassword2()
  {
    var last_length = $('#staffPassword_second').val().length;
    var last = $('#staffPassword_second').val();
    if(last.trim().length == 0)
    {
      $('#staffPassword_second').removeClass(" is-valid");
      $('#staffPassword_second').addClass(" is-invalid");
      return false;
    }
    else
    {
      $('#staffPassword_second').removeClass(" is-invalid");
    }
  }

  function checkpassword()
  {
  	var last_length = $('#staffPassword_first').val().length;
    var last_length2 = $('#staffPassword_second').val().length;
    if(last_length != last_length2)
    {
      $('#staffPassword_first').removeClass(" is-valid");
      $('#staffPassword_first').addClass(" is-invalid");
      $('#staffPassword_second').removeClass(" is-valid");
      $('#staffPassword_second').addClass(" is-invalid");
      return false;
    }
    else
    {
		$('#staffPassword_second').removeClass(" is-invalid");
    	$('#staffPassword_first').removeClass(" is-invalid");
    }
  }

});
</script>
