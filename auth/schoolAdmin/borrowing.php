<?php session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/header.php'; ?>

<link href="/pupwebdev/assets/stylesheet/fullcalendar390.min.css" rel="stylesheet">

<div class="container-fluid">
  <div class="row">
    <div class="side-navigation">
      <?php include 'navigation.php' ?>
    </div>
    <div class="col main-content">
      <div class="module-container">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-pills" id="borrowingmodules-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="borrowingmodules-queued-tab" data-toggle="pill" href="#borrowingmodules-queued" role="tab" aria-controls="borrowingmodules-queued" aria-selected="true">On Queue</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="borrowingmodules-approved-tab" data-toggle="pill" href="#borrowingmodules-approved" role="tab" aria-controls="borrowingmodules-approved" aria-selected="false">Approved</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="borrowingmodules-history-tab" data-toggle="pill" href="#borrowingmodules-history" role="tab" aria-controls="borrowingmodules-history" aria-selected="false">History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="borrowingmodules-calendar-tab" data-toggle="pill" href="#borrowingmodules-calendar" role="tab" aria-controls="borrowingmodules-calendar" aria-selected="false">Calendar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="borrowingmodules-printletter-tab" data-toggle="pill" href="#borrowingmodules-printletter" role="tab" aria-controls="borrowingmodules-printletter" aria-selected="false">Print Letter</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="borrowingmodules-queued" role="tabpanel" aria-labelledby="borrowingmodules-queued-tab">
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
                <div id="live_table"></div>

              </div>
              <div class="tab-pane fade" id="borrowingmodules-approved" role="tabpanel" aria-labelledby="borrowingmodules-approved-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <input type="text" class="form-control" id="search_approve" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="live_table2"></div>
              </div>
              <div class="tab-pane fade" id="borrowingmodules-history" role="tabpanel" aria-labelledby="borrowingmodules-history-tab">
                <div class="search-etc">
                  <div class="row">
                    <div class="col-6">
                      <div class="input-group">
                        <input type="text" class="form-control" id="search_history" placeholder="Search by name.." aria-label="Search by name.." aria-describedby="button-search">
                        <div class="input-group-append">
                          <button class="btn btn-pupcustomcolor" type="button" id="button-search"><i class="fas fa-search "></i></button>

                          <button class="btn btn-pupcustomcolor ml-1" type="button" id="button-clear">Clear History</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="live_table3"></div>
              </div>
              <div class="tab-pane fade" id="borrowingmodules-calendar" role="tabpanel" aria-labelledby="borrowingmodules-calendar-tab">
                <div id="room_calendarview"></div>
              </div>
              <div class="tab-pane fade" id="borrowingmodules-printletter" role="tabpanel" aria-labelledby="borrowingmodules-printletter-tab">
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
                  <div id="live_table4"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewCalendar" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Disapprove</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div id="room_calendarview"></div> -->
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pendingDeleteModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Disapprove</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="delete_pending_request_id" id="delete_pending_request_id">
        <h3>Are you sure?</h3> <small>This action is irreversible.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor delete_pending">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="pendingApproveModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Approve</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="approve_pending_request_id" id="approve_pending_request_id">
        <h3>Are you sure?</h3> <small>This action is irreversible.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor approve_pending">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="viewPendingModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Remove</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id='viewPendingItemModalData'>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewApproveModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Return Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id='viewApproveItemModalData'>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor approve_pending_item_return">Return</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="approvedRemoveModal" tabindex="-1" role="dialog" aria-labelledby="actionDeleteItemModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actionDeleteItemModalTitle">Return</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="remove_approved_request_id" id="remove_approved_request_id">
        <h3>Are you sure?</h3> <small>This action is irreversible.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pupcustomcolor remove_approved_pending">Confirm</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div> -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/pupwebdev/auth/footer.php' ?>

<script>
  $(document).ready(function() {
    $('#search_pending').keyup(function() {
      var text = $(this).val();
      if (text != '') {
        $.ajax({
          url: "functions/borrowing_search_pending.php",
          method: "post",
          data: {
            search: text
          },
          dataType: "text",
          success: function(data) {
            $('#live_table').html(data);
          }
        });
      } else {
        fetch_data();
      }
    });

    $('#search_approve').keyup(function() {
      var text = $(this).val();
      if (text != '') {
        $.ajax({
          url: "functions/borrowing_search_approve.php",
          method: "post",
          data: {
            search: text
          },
          dataType: "text",
          success: function(data) {
            $('#live_table2').html(data);
          }
        });
      } else {
        fetch_data2();
      }
    });

    $('#search_history').keyup(function() {
      var text = $(this).val();
      if (text != '') {
        $.ajax({
          url: "functions/borrowing_search_history.php",
          method: "post",
          data: {
            search: text
          },
          dataType: "text",
          success: function(data) {
            $('#live_table3').html(data);
          }
        });
      } else {
        fetch_data3();
      }
    });

    function fetch_data() {
      $.ajax({
        url: "functions/borrowing_live.php",
        method: "post",
        success: function(data) {
          // alert(data);
          $('#live_table').html(data);
        }
      });
    }

    function fetch_data2() {
      $.ajax({
        url: "functions/borrowing_live2.php",
        method: "post",
        success: function(data) {
          $('#live_table2').html(data);
        }
      });
    }

    function fetch_data3() {
      $.ajax({
        url: "functions/borrowing_live3.php",
        method: "post",
        success: function(data) {
          $('#live_table3').html(data);
        }
      });
    }

    fetch_data();
    fetch_data2();
    fetch_data3();

    $(document).on('click', '.delete_pending_item', function() {
      var requestid = $(this).attr("id");
      $('#delete_pending_request_id').val(requestid);
      $.ajax({
        success: function(data) {
          $('#pendingDeleteModal').modal("show");
        }
      });
    });

    $(document).on('click', '#button-clear', function(e) {
      e.preventDefault();
      if (confirm("Do you really want to clear your history?")) {
        $.ajax({
          url: "functions/borrowing_clear_history.php",
          success: function(data) {
            alert('History Cleared!');
            fetch_data();
            fetch_data2();
            fetch_data3();
          }
        });
      }
    });

    $(document).on('click', '.approve_pending_item_return', function() {
      var favorite = [];
      var ids = [];
      var numberchecked = 0;
      $.each($(".checkboxid:checked"), function() {
        favorite.push($(this).val());
        ids.push($(this).attr('id'));
        numberchecked = numberchecked + 1;
      });

      if (numberchecked == 0) {
        alert('Select from the item/s first before returning');
      } else {
        for (var k = 0; k < numberchecked; k++) {
          var iteminfoid = favorite[k];
          var borrowingid = ids[k];
          $.ajax({
            url: "functions/borrowing_view_return_item.php",
            data: {
              iteminfoid: iteminfoid,
              borrowingid: borrowingid
            },
            method: "post",
            success: function(data) {
              alert('Item/s Returned');
              $('#viewApproveModal').modal('hide');
              fetch_data();
              fetch_data2();
              fetch_data3();
            }
          });
        }
      }
    });

    $(document).on('click', '.delete_pending', function() {
      var borrowingdetailsid = $('#delete_pending_request_id').val();
      $.ajax({
        url: 'functions/borrowing_pending_delete_request.php',
        data: {
          borrowingdetailsid: borrowingdetailsid
        },
        method: 'post',
        success: function(data) {
          alert("Request Disapproved!");
          $('#pendingDeleteModal').modal("hide");
          fetch_data();
          fetch_data2();
          fetch_data3();
        }
      });
    });

    $(document).on('click', '.approve_pending_item', function() {
      $('#approve_pending_request_id').val($(this).attr('id'));
      $.ajax({
        success: function(data) {
          $('#pendingApproveModal').modal("show");
        }
      });
    });

    $(document).on('click', '.approve_pending', function() {
      var borrowingdetailsid = $('#approve_pending_request_id').val();
      $.ajax({
        url: 'functions/borrowing_pending_approve_request.php',
        data: {
          borrowingdetailsid: borrowingdetailsid
        },
        method: 'post',
        success: function(data) {
          alert("Request Approved!");
          $('#pendingApproveModal').modal("hide");
          fetch_data();
          fetch_data2();
          fetch_data3();
        }
      });
    });

    $(document).on('click', '.remove_approve_item', function() {
      var requestid = $(this).attr("id");
      $.ajax({
        url: 'functions/borrowing_view_approved_item.php',
        data: {
          borrowid: requestid
        },
        method: 'post',
        success: function(data) {
          $('#viewApproveItemModalData').html(data);
          $('#viewApproveModal').modal('show');
        }
      });
    });

    $(document).on('click', '.view_pending_item', function(e) {
      var borrowid = $(this).attr('id');

      $.ajax({
        url: 'functions/borrowing_view_pending_item.php',
        data: {
          borrowid: borrowid
        },
        method: 'post',
        success: function(data) {
          $('#viewPendingItemModalData').html(data);
          $('#viewPendingModal').modal('show');
        }
      });
    });

  });
</script>



<script>
  $(document).ready(function() {

    function refreshData() {

      // alert(

      $('#room_calendarview').fullCalendar('removeEventSource', url = "functions/borrowing_load_calendar.php");

      $('#room_calendarview').fullCalendar('addEventSource', url = "functions/borrowing_load_calendar.php");

    }


    var calendar = $('#room_calendarview').fullCalendar({
      header: {
        left: 'prev next',
        right: ' agendaWeek, listMonth'
      },
      events: url = "functions/borrowing_load_calendar.php",
      viewRender: function(currentView) {
        var myDate = new Date();
        var minDate = moment();

        if ((myDate.getDay() == 0)) {
          minDate = moment().add(1, 'days');
        }

        if (minDate >= currentView.start && minDate <= currentView.end) {
          $(".fc-prev-button").prop('disabled', true);
          $(".fc-prev-button").addClass('fc-state-disabled');
        } else {
          $(".fc-prev-button").removeClass('fc-state-disabled');
          $(".fc-prev-button").prop('disabled', false);
        }
      },
      contentHeight: 'auto',
      defaultView: 'agendaWeek',
      hiddenDays: [0],
      columnHeaderFormat: ' MM-DD ddd',
      minTime: '07:00:00',
      maxTime: '22:00:00',
      selectHelper: true,
      allDaySlot: false,
      views: {
        week: {
          titleFormat: 'YYYY-MM-DD-MM-YYYY'

        }
      },

      selectConstraint: {
        start: '00:01',
        end: '23:59',
      },
      eventConstraint: {
        start: '00:00',
        end: '24:00',
      },
      // eventClick: function(event) {

      //    if(roomIsSelected)
      //    {
      //      if(event.editable)
      //      {
      //        if(confirm("Are you sure you want to remove it?"))
      //         {
      //            var id = event.id;
      //            //alert(id);
      //             $.ajax({
      //             url:"schoolAdministrator_deleteEvent.php",
      //             type:"POST",
      //             data:{id:id},
      //             success:function()
      //             {
      //              calendar.fullCalendar('refetchEvents');
      //              alert("Event Removed");
      //             }
      //            })
      //                 //   window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_deleteEvent.php?id="+ id;
      //         }
      //      }
      //    }
      //    else
      //    {
      //       alert("Please select a room.");
      //    }
      // }
    });

    //  $('.fc-prev-button').click(function(){
    // // refreshData();
    //    //alert('prev is clicked, do something');
    // });

    // $('.fc-next-button').click(function(){
    //    //alert('nextis clicked, do something');
    // });

    // $(".fc-next-button")[0].click();
    // $(".fc-prev-button")[0].click();
    $(document).on('shown.bs.tab', 'a[data-toggle="pill"]', function(e) {
      calendar.fullCalendar('rerenderEvents');
    });

  });
</script>

<script>
  $(document).ready(function() {

    function fetch_data4() {
      $.ajax({
        url: "../../public/borrow/functions/display_letter_print.php",
        method: "post",
        success: function(data) {
          // alert(data);
          $('#live_table4').html(data);
        }
      });
    }

    fetch_data4();

    $(document).on('click', '.print_letter_btn', function(e) {
      e.preventDefault();
      window.open('../../public/borrow/documents/admin_classlist.php?borrowid=' + this.id, '_blank');
    });
  });
</script>


<script src="/pupwebdev/assets/javascript/moment.min.js " type="text/javascript"></script>
<script src="/pupwebdev/assets/javascript/fullcalendar390.min.js" type="text/javascript"></script>

<link href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.css' rel='stylesheet' />