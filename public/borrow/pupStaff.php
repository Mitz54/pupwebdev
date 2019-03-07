<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/public/header.php'; ?>

<div class="col main-content" style="margin-left: 9.5%; width: 80%;" >
      <div class="module-container">
        <div class="card" >
          <div class="card-header">
          <!-- <div class="col-8"> -->
                <div class="form-group row">
                  <input type="hidden" id="borrowertype" name="borrowertype" value="PUP Staff" class="form-control">
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
            <!-- </div> -->
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
              <div class="tab-pane fade" id="inventorymodules-donated" role="tabpanel" aria-labelledby="inventorymodules-donated-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor">Print list</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Donator's Name</th>
                      <th scope="col">Item</th>
                      <th scope="col">Date</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Anthony</td>
                      <td>100" OLED Flatscreen TV</td>
                      <td>07.18.2018</td>
                      <td>3000</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Bryan</td>
                      <td>ASUS Gaming Laptops</td>
                      <td>06.10.2018</td>
                      <td>100</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Cherly</td>
                      <td>Water Dispenser</td>
                      <td>05.18.2018</td>
                      <td>10</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Dean</td>
                      <td>Monoblock Chair</td>
                      <td>07.02.2018</td>
                      <td>64</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Ezreal</td>
                      <td>Infinity Edge</td>
                      <td>09.14.2018</td>
                      <td>1</td>
                    </tr>
                  </tbody>
                </table>
                <div class="float-right">
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
                </div>
              </div>
              <div class="tab-pane fade" id="inventorymodules-condemned" role="tabpanel" aria-labelledby="inventorymodules-condemned-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>

                    <div class="col">
                      <button type="button" class="btn btn-pupcustomcolor">Print list</button>
                    </div>
                  </div>
                </div>
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Item Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Date</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Toilet Paper</td>
                      <td>Empty</td>
                      <td>07.18.2018</td>
                      <td>10</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>CRT Monitors</td>
                      <td>Broken Capacitors</td>
                      <td>09.14.2018</td>
                      <td>32</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Door</td>
                      <td>Broken Handle</td>
                      <td>09.14.2018</td>
                      <td>9</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Clock</td>
                      <td>No hour hand?</td>
                      <td>09.14.2018</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>Hotdog</td>
                      <td>Not hot</td>
                      <td>09.14.2018</td>
                      <td>9999</td>
                    </tr>
                  </tbody>
                </table>
                <div class="float-right">
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

  fetch_data();

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
      if( checkfullname() != false && checkcontact() != false && checkduedate() != false && checkinitialdate() != false)
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
                var item = favorite[k];
                var borrowerid =$('#borrowerid').val();    
                var borrowertype =$('#borrowertype').val(); 
                var issuedate =$('#initialdate').val();
                var duedates =$('#duedate').val();  
                var borrowingdetailsid =$('#borrowingdetailsid').val();  

                $.ajax({  
                    url:"functions/classRep_insert.php",
                    data:{quantityvalue:quantityvalue,contactnumber:contactnumber,fullname:fullname,item:item,borrowerid:borrowerid,borrowertype:borrowertype,issuedate:issuedate,duedates:duedates,borrowingdetailsid:borrowingdetailsid},  
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
    if(Number($('#quantity').val()) > Number(quantity) || quantityvalue.trim().length == 0)
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
    var initialdate = $('#initialdate').val();
    var duedate = $('#duedate').val();
    if(initialdate == "" || Date.parse(duedate) < Date.parse(initialdate))
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
    var initialdate = $('#initialdate').val();
    var duedate = $('#duedate').val();
    if(duedate == "" || Date.parse(duedate) < Date.parse(initialdate))
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
});
</script>