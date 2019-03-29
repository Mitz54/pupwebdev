<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/public/header.php'; ?>

<!-- <div class="col main-content" style="margin-left: 9.5%; width: 80%;" >
      <div class="module-container">
        <div class="card" >
          <div class="card-header">
 
                <div class="form-group row">
                  <input type="hidden" id="borrowertype" name="borrowertype" value="Class Rep" class="form-control">
                  <input type="hidden" id="borrowerid" name="borrowerid" class="form-control">
                  <input type="hidden" id="borrowingdetailsid" name="borrowingdetailsid" class="form-control">

                  <div class="col-3">
                    <label>Initial Date:</label>
                    <input type="date" name="initialdate" id="initialdate" class="form-control">
                  </div>
                  
                  <div class="col-3">
                    <label>Due Date:</label>
                    <input type="date" name="duedate" id="duedate" class="form-control">
                  </div>

                  <div class="col-3">
                    <label>Full Name:</label>
                    <input type="text" id="fullname" name="fullname" class="form-control" id="borrower-name" placeholder="Full Name" required>
                  </div>  

                  <div class="col-3">
                    <label>Contact Number:</label>
                    <input type="text" id="contactnumber" name="contactnumber"class="form-control" id="borrower-no" maxlength="11" placeholder="Contact No#" required>
                  </div> 

                  <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor request_item">Request</button>
                  </div> 
                </div> 
  
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                <div class="search-etc">
                  <div class="row">
                  
                    <div class="col-7" style="margin-left: 2.2rem;">
                      <div class="input-group" style="margin-left: -6%; ">
                        <input type="text" class="form-control" id="search" placeholder="Search by name.." aria-label="Search Iem.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="live_table"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 -->
<div class="container-fluid">
  <div class="row">
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills" id="borrowingmodules-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="borrowingmodules-queued-tab" data-toggle="pill" href="#borrowingmodules-queued" role="tab" aria-controls="borrowingmodules-queued" aria-selected="true">Request</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="borrowingmodules-approved-tab" data-toggle="pill" href="#borrowingmodules-approved" role="tab" aria-controls="borrowingmodules-approved" aria-selected="false">Print Letter</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="borrowingmodules-queued" role="tabpanel" aria-labelledby="borrowingmodules-queued-tab">
                  
                <!-- <div class="col main-content"> -->
                  <div class="module-container">
                    <div class="card" >
                      <div class="card-header">
             
                            <div class="form-group row">
                              <input type="hidden" id="borrowertype" name="borrowertype" value="Org Rep" class="form-control">
                              <input type="hidden" id="borrowerid" name="borrowerid" class="form-control">
                              <input type="hidden" id="borrowingdetailsid" name="borrowingdetailsid" class="form-control">

                              <div class="col-2">
                                <label>Initial Date:</label>
                                <input type="date" name="initialdate" id="initialdate" class="form-control">
                              </div>
                              
                              <div class="col-2">
                                <label>Due Date:</label>
                                <input type="date" name="duedate" id="duedate" class="form-control">
                              </div>

                              <div class="col-2">
                                <label>Start Time:</label>
                                <input type="time" name="stime" id="stime" class="form-control">
                              </div>
                              
                              <div class="col-2">
                                <label>End Time:</label>
                                <input type="time" name="etime" id="etime" class="form-control">
                              </div>

                              <div class="col-3">
                                <label>Full Name:</label>
                                <input type="text" id="fullname" name="fullname" class="form-control" id="borrower-name" placeholder="Full Name" required>
                              </div>  

                              <div class="col-1 mt-4">
                                  <button type="button" class="btn btn-pupcustomcolor request_item">Request</button>
                              </div> 

                              <div class="col-2">
                                <label>Contact Number:</label>
                                <input type="text" id="contactnumber" name="contactnumber"class="form-control" id="borrower-no" maxlength="11" placeholder="Contact No#" required>
                              </div> 

                              <div class="col-7">
                                <label>Reason for Borrowing:</label>
                                <input type="text" id="reason" name="reason" class="form-control" placeholder="Seminar" required>
                              </div> 

                              <div class="col-3">
                                <label>Organization:</label>
                                <select name="organization" id="organization" class="form-control">
                                  <option selected value="" disabled>Select Organization</option>
                                  <option value="Association of Competent and Aspiring Psychologists">ACAP</option>
                                  <option value="Association of Electronics and Communication Engineering Students">AECES</option>
                                  <option value=" Eligible League of Information Technology Enthusiasts">ELITE</option>
                                   <option value="Guild of Imporous and Valuable Educator">GIVE</option>
                                  <option value="Junior Marketing Association of the Philippines">JMAP</option>
                                  <option value="Junior Executive of Human Resource Association">JPIA</option>                       
                                  <option value="Philippine Institute of Industrial Engineers">PIIE</option>
                                </select>
                              </div> 
                            </div> 
              
                      </div>
                      <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="inventorymodules-stock" role="tabpanel" aria-labelledby="inventorymodules-stock-tab">
                            <div class="search-etc">
                              <div class="row">
                              
                                <div class="col-7" style="margin-left: 2.2rem;">
                                  <div class="input-group" style="margin-left: -6%; ">
                                    <input type="text" class="form-control" id="search" placeholder="Search by name.." aria-label="Search Iem.." aria-describedby="button-search">
                                    <div class="input-group-append">
                                      <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div id="live_table"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- </div> -->
              
              </div>
              <div class="tab-pane fade" id="borrowingmodules-approved" role="tabpanel" aria-labelledby="borrowingmodules-approved-tab">
                   <div class="search-etc">
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <input type="text" class="form-control" id="search_pending" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <form method="POST" enctype="multipart/form-data" id="docuform" action="../borrow/documents/admin_classlist.php" target="_blank">
                    <div id="live_table2"></div> 
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div> -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/public/footer.php'; ?>

<script>  
$(document).ready(function()
{  
  $('#search').keyup(function()
      {
        var text = $(this).val();
        if(text != '')
        {
           $.ajax({
            url:"functions/classRep_search.php",
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

  setInterval(function()
  {
     getnextid(); 
     getdetailsid();
  }, 200);

  function getnextid()
  {
    $.ajax({  
            url:"functions/classRep_getborrowerid.php",  
            method:"post",   
            success:function(data)
            {  
              $('#borrowerid').val(data);    
            }  
       });
  }

  function getdetailsid()
  {
    $.ajax({  
            url:"functions/classRep_getdetailsid.php",  
            method:"post",   
            success:function(data)
            {  
              $('#borrowingdetailsid').val(data);    
            }  
       });
  }

  function forceNumeric(){
          var $input = $(this);
          $input.val($input.val().replace(/[^\d]+/g,''));
      }
  $('body').on('propertychange input', '#contactnumber', forceNumeric);
  $('body').on('propertychange input', '#quantity', forceNumeric);
  $('body').on('propertychange input', '.quantity', forceNumeric);


  function fetch_data()
  {
    $.ajax({  
            url:"functions/classRep_live.php",  
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
            url:"functions/display_letter_print.php",  
            method:"post",   
            success:function(data)
            {  
             // alert(data);
              $('#live_table2').html(data);    
            }  
       });  
  }

  fetch_data();
  fetch_data2();

  $(document).on('click','.print_letter_btn',function(e)
  {
    e.preventDefault();
    //window.location.href = "../borrow/documents/admin_classlist.php";


    window.open('../borrow/documents/admin_classlist.php?borrowid='+this.id, '_blank');
  });

  $(document).on('click','.request_item',function(e)
  {
    e.preventDefault();
    var value = $('.checkboxid:checked').val();
    if(value == undefined )
    {
      alert("Select an Item first before requesting!");
    } 
    else
    {
      checkfullname();
      checkcontact();
      checkinitialdate();
      checkduedate();
      checkreason();
      checkorganization();
      checkstime();
      checketime();
      if( checkfullname() != false && checkcontact() != false && checkduedate() != false && checkinitialdate() != false &&checkreason() != false && checkorganization() != false && checkstime() != false && checketime() != false)
      {
          var favorite = [];
          var ids = [];
          var numberchecked = 0;
            $.each($("input[type='checkbox']:checked"), function(){            
                favorite.push($(this).val());
                numberchecked = numberchecked + 1;
            });

            $.each($("input[type='checkbox']:checked"), function(){            
                var id = ($(this).attr('id'));
                ids.push(id);
            });

            var chklength = favorite.length; 
            var error = 0;
            for(var k=0;k< chklength;k++)
            {

              $('#'+favorite[k]).removeClass(' is-invalid');
              if(ids[k] < $('#quanti'+favorite[k]).val() || $('#quanti'+favorite[k]).val() == 0)
              {
                error = error + 1;
                $('#quanti'+favorite[k]).addClass(' is-invalid');
              }
            } 

            if(error == 0)
            {
              for(var k=0;k< numberchecked;k++)
              {
                var quantityvalue = $('#quanti'+favorite[k]).val();
                var contactnumber = $('#contactnumber').val();
                var fullname = $('#fullname').val();
                var reason = $('#reason').val();
                var organization = $('#organization').val();
                var item = favorite[k];
                var borrowerid =$('#borrowerid').val();    
                var borrowertype =$('#borrowertype').val(); 
                var issuedate =$('#initialdate').val();
                var duedates =$('#duedate').val();  
                var borrowingdetailsid =$('#borrowingdetailsid').val();  
                var stime = $('#stime').val();
                var etime = $('#etime').val();

                $.ajax({  
                    url:"functions/classRep_insert.php",
                    data:{quantityvalue:quantityvalue,contactnumber:contactnumber,fullname:fullname,item:item,borrowerid:borrowerid,borrowertype:borrowertype,issuedate:issuedate,duedates:duedates,borrowingdetailsid:borrowingdetailsid,reason:reason,organization:organization,stime:stime,etime:etime},  
                    method:"post",   
                    success:function(data)
                    {
                      fetch_data();  
                    }  
               });
              } 
              alert('Item successfully requested!');
            }
     }
    }
  });

  function checkquantity()
  {
    var quantity = $('.checkboxid:checked').attr("id"); 
    var quantityvalue = $('#quantity').val();
    if(Number($('#quantity').val()) > Number(quantity) || quantityvalue.trim().length == 0 || Number($('#quantity').val()) == 0)
    {
      $('#quantity').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#quantity').removeClass(' is-invalid');
    }
  }

  function checkinitialdate()
  {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    var initialdate = $('#initialdate').val();
    var duedate = $('#duedate').val();

    if(initialdate == "" || Date.parse(duedate) < Date.parse(initialdate) || Date.parse(today) > Date.parse(initialdate))
    {
      $('#initialdate').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#initialdate').removeClass(' is-invalid');
    }
  }

  function checkduedate()
  {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    var initialdate = $('#initialdate').val();
    var duedate = $('#duedate').val();

    if(duedate == "" || Date.parse(duedate) < Date.parse(initialdate) || Date.parse(today) > Date.parse(duedate))
    {
      $('#duedate').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#duedate').removeClass(' is-invalid');
    }
  }

  function checkfullname()
  {
    var fullname = $('#fullname').val(); 
    if(fullname.trim().length == 0)
    {
      $('#fullname').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#fullname').removeClass(' is-invalid');
    }
  }

  function checkreason()
  {
    var reason = $('#reason').val(); 
    if(reason.trim().length == 0)
    {
      $('#reason').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#reason').removeClass(' is-invalid');
    }
  }

  function checkorganization()
  {

    var organization = $('#organization').val(); 
    if(organization == null)
    {
      $('#organization').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#organization').removeClass(' is-invalid');
    }
  }

  function checkcontact()
  {
    var contactnumber = $('#contactnumber').val(); 
    if(contactnumber.trim().length == 0 || contactnumber.length != 11)
    {
      $('#contactnumber').addClass(' is-invalid');
      return false;
    }
    else
    {
      $('#contactnumber').removeClass(' is-invalid');
    }
  }

  function checkstime()
  {
    var sdate = $('#sdate').val();
    var edate = $('#edate').val();

    var stime = $('#stime').val();
    var etime = $('#etime').val();
    
    if(stime == "")
    {
      $('#stime').removeClass(' is-valid');
      $('#stime').addClass(' is-invalid');
      return false;
    }
    else
    {
      if(stime > etime)
      {
        $('#stime').removeClass(' is-valid');
        $('#stime').addClass(' is-invalid');
        return false;
      }
      else
      {
        $('#stime').removeClass(' is-invalid');
      }
    }
  }

  function checketime()
  {
    var stime = $('#stime').val();
    var etime = $('#etime').val();
    str = etime.replace(":", '');
    if(etime == "")
    {
      $('#etime').removeClass(' is-valid');
      $('#etime').addClass(' is-invalid');
      return false;
    }
    else
    {
      if(etime < stime)
      {
        $('#etime').removeClass(' is-valid');
        $('#etime').addClass(' is-invalid');
        return false;
      }
      else
      {
        $('#etime').removeClass(' is-invalid');
      }
    }
  }
});
</script>