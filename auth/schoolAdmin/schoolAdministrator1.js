
$(document).ready(function() 
{

  var selDay;
  var selDate;
  var startTime;
  var endTime;
  var startdate = ""; //For room.change
  var endDate= "";//For room.change
  var room_="''";
  var holdroom="''";
  var selectedval=false;

  var holdstart="";

  var holdend="";
  var roomIsSelected=false;
  var remarks="";

  var sel_sched_ID = null;
 
 function refreshData()
 {
    var e = document.getElementById("Room");
    var strUser = e.options[e.selectedIndex].text;
    room_="'"+ strUser+ "'";
    var view = $('#room_calendarview').fullCalendar('getView');
    var fulldate= view.title.split('-');
    var startday= fulldate[2];
    var daysa = startday.substring(0,2);

    startdate=  fulldate[0] + "-" + fulldate[1] + "-" + daysa ;
    var endday= fulldate[3];
    var dayss = endday.substring(1,3);

    var endDate=  fulldate[0] + "-" + fulldate[1] + "-" + dayss;


    selectedval=true;

  // alert(holdstart  + "|" + holdend + "|" + holdroom );


    $('#room_calendarview').fullCalendar( 'removeEventSource', url ="./schoolAdministrator_loadEvents.php?room=" +
    holdroom + "&startdate=" +holdstart + "&enddate=" +holdend);

    $('#room_calendarview').fullCalendar( 'addEventSource', url ="./schoolAdministrator_loadEvents.php?room=" + room_
    + "&startdate=" +startdate + "&enddate=" +endDate);

    holdroom=room_;
    holdstart=startdate;
    holdend=endDate;
 }

    $('#Room').change (function() 
    {
      roomIsSelected=true;
      refreshData(); 
    });

 
  
    var calendar = $('#room_calendarview').fullCalendar(
      {
       
   
    header: {
      left: 'prev next',
  
      right: ' agendaWeek, listMonth'
    },
    viewRender: function(currentView){
      var myDate = new Date();
      var minDate = moment();

      if((myDate.getDay() ==0))
      {
          minDate = moment().add(1,'days');
      }

      if (minDate >= currentView.start && minDate <= currentView.end) {
        $(".fc-prev-button").prop('disabled', true); 
        $(".fc-prev-button").addClass('fc-state-disabled'); 
      }
      else {
        $(".fc-prev-button").removeClass('fc-state-disabled'); 
        $(".fc-prev-button").prop('disabled', false); 
      }

  
  },
        contentHeight: 'auto',
        defaultView: 'agendaWeek',
        hiddenDays: [ 0 ],
        columnHeaderFormat: ' MM-DD ddd',
        minTime: '07:00:00',
        maxTime: '22:00:00',
        editable: true,
        selectable: true,
        selectHelper: true,
        allDaySlot: false,
           views: {
    week: {
    titleFormat: 'YYYY-MM-DD-MM-YYYY'

  }
},
        events: url ="./schoolAdministrator_loadEvents.php?room=" + room_ +
         "&startdate=" + startdate + "&enddate=" +  endDate,
       
        // [{"id":"28","title":"GEED 10053IT 1-1Claros,Anthony",
        // "start":"2018-10-16 07:30:00","end":"2018-10-16 10:30:00"},
        // {"id":"30","title":"GEED 10063IT 1-1Pastolero,Jesellie",
        // "start":"2018-10-16 10:30:00","end":"2018-10-16 13:30:00"}
        // ,{"id":"23","title":"ACCO 20213IT 1-1Balbarino,Melinda",
        // "start":"2018-10-17 14:00:00","end":"2018-10-17 17:00:00"},
        // {"id":"26","title":"GEED 10103IT 1-1Rodriguez,Diomedes",
        // "start":"2018-10-18 14:00:00","end":"2018-10-18 17:00:00"}],
        selectOverlap :false,
        eventOverlap: false,
         selectConstraint:
    {
      start: '00:01', 
      end: '23:59', 
    },
    eventConstraint:
    {
      start: '00:00', 
      end: '24:00', 
    },
     
    
        select: function(start, end, day, date, jsEvent) 
        {
         
if(roomIsSelected)
{
  var endtime = $.fullCalendar.moment(end).format('HH:mm:ss');
          var starttime = $.fullCalendar.moment(start).format('HH:mm:ss');
          var daySched = $.fullCalendar.moment(start).format('ddd');
          var dateSched = $.fullCalendar.moment(start).format('YYYY-MM-DD');
          var schedule = daySched + ', ' + dateSched + ', ' + starttime + ' - ' + endtime;
        
           //day_ = $.fullCalendar.moment(start).format('ddd');
          selDay = daySched;
          selDate = dateSched;
          startTime = starttime;
          endTime = endtime;
    
          day = moment(day).format();
          date = moment(date).format();
          start = moment(start).format();
          end = moment(end).format(); 
          
          $('#create-roomSchedule #startTime').val(start);
          $('#create-roomSchedule #endTime').val(end);
          $('#create-roomSchedule #Day').val(day);
          $('#create-roomSchedule #Date').val(date);
          $('#create-roomSchedule #selectedRoomSched').text(schedule);
          $('#create-roomSchedule').modal('toggle');
          
       
}
else
{
   alert("Please select a room.");
}
        
         },
         eventClick: function(event) {


            if(roomIsSelected)
            {
              if(event.editable)
              {
                
                    var id = event.id;
                    sel_sched_ID = event.id;
                    $('#edit-sched-modal').modal('show');
                    $.ajax({
                      url:'Queries/readSelectedReservation.php',
                      type:"POST",
                      dataType: 'json',
                      async:false,
                      data:{ID:id},
                      success:function(data){
                        $('#lbl-sched-id').val(id);
                        $('#inp-edit-name').val(data[0]);
                        $('#sel-edit-course').val(data[1]).trigger("change");
                        $('#sel-edit-sect').val(data[2]);
                        $('#sel-edit-prof').val(data[3]);
                        $('#sel-edit-purp').val(data[4]);
                        $('#inp-edit-rem').val(data[5]);
                      }
                    });
                    //    if(confirm("Are you sure you want to remove?"))
                    // { }
                    //alert(id);
                    //  $.ajax({
                    //  url:"schoolAdministrator_deleteEvent.php",
                    //  type:"POST",
                    //  data:{id:id},
                    //  success:function()
                    //  {
                    //   calendar.fullCalendar('refetchEvents');
                    //   alert("Event Removed");
                    //  }
                    // })
                         //   window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_deleteEvent.php?id="+ id;
                
              }
            }
            else
            {
               alert("Please select a room.");
            }



         
   
         },
          // endtime = $.fullCalendar.moment(event.end).format('h:mm');
          // starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
          // var mywhen = starttime + ' - ' + endtime;
          // $('#modalTitle').html(event.title);
          // $('#modalWhen').text(mywhen);
          // $('#eventID').val(event.id);
          // $('#roomScheduleModal').modal();
        //}
        eventDrop: function(event) {
        var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
        var day = $.fullCalendar.formatDate(event.start, "ddd");
        var id = event.id;

        $.ajax({
          url:"schoolAdministrator_updateEvent.php",
          type:"POST",
          data:{scheduleDay:day, startTime:start, endTime:end, scheduleID:id},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
          }
        });
        //  alert(start+ "\n "+ end + "\n "+ id  + "\n "+ day );
        //window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_updateEvent.php?startTime="+ start +"&endTime=" + end + "&scheduleID="+ id + 
        //"&scheduleDay=" + day; 
        },

        eventResize: function(event) {
       
        var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
        var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
        var day = $.fullCalendar.formatDate(event.start, "ddd");
        var id = event.id;
          $.ajax({
          url:"schoolAdministrator_updateEvent.php",
          type:"POST",
          data:{scheduleDay:day, startTime:start, endTime:end, scheduleID:id},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
          }
        });
        // alert(start+ "\n "+ end + "\n "+ id  + "\n "+ day );
        //window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_updateEvent.php?startTime="+ start +"&endTime=" + end + "&scheduleID="+ id + 
        //"&scheduleDay=" + day; 

        }
      });

    
      // $('#deleteButton').click(function(e) {
      //   // e.preventDefault();
      //   doDelete();
      // });
    
    
  
 $('.fc-prev-button').click(function(){
refreshData();
   //alert('prev is clicked, do something');
});

$('.fc-next-button').click(function(){
  refreshData();
   //alert('nextis clicked, do something');
});


  $('#submitButton').click (function()
  {
     if($("#scheduleReservationUser").val()=="" || $("#Course").val()==null
      || $("#Section").val()==null || $("#scheduleReservationPurpose").val()=="")
     {
     alert("Please complete all fields!");
     }
     else
     {

    $("#create-roomSchedule").modal('hide');
    //var section= document.getElementById('scheduleSection').value;
    var section= document.getElementById('Section').value;
    var purpose = document.getElementById('roomPurpose').selectedIndex;
    var name = document.getElementById('scheduleReservationUser').value;
    var remarks = $('#inp-remarks').val();
    var prof = $('#add-sel-prof').val(); ;
    var room=document.getElementById('Room').value;

    //alert(name + "&purpose=" + purpose + "&section="+ section +"&startTssime=" + startTime + "&endTime=" + endTime + "&room=" + room +"&day=" + selDay+ "&date=" + selDate);
    // alert(prof);
    $.ajax({
       url:"schoolAdministrator_insertEvent.php",
       type:"POST",
       data:{name:name, purpose:purpose, remarks:remarks, section:section,
             room:room, date:selDate,day:selDay, startTime:startTime,
              endTime:endTime,prof:prof},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       
       }

      })

    $("#addSchedModal")[0].reset();
    $('#Section').empty();
    $('#Section').append(' <option disabled selected hidden>Select Section..</option>');
    $("#remarks-txtArea").remove();
     }
 
   // window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_insertEvent.php?name="+ name + "&purpose=" + purpose +
   //  "&date="+ selDate + "&section="+ section +"&startTime=" + startTime + "&zendTime=" + endTime + "&room=" + room +"&day=" + selDay;
     
  });

   $("#roomPurpose").change(function(){
    var roomPurpose = document.getElementById("roomPurpose");
    var selected = roomPurpose.options[roomPurpose.selectedIndex].text;
    // alert(selected);

    if(selected == "Others (Please Specify)")
      {
        var txtpurpose = "<textarea rows='5' id='remarks-txtArea'></textarea>";       
        $("#remarks-div").append(txtpurpose);
        remarks =document.getElementById('remarks-txtArea').value
        //alert("hi");
      }

    else
    {
       $("#remarks-txtArea").remove();
    }
});

 //DELETE RESERVATION
$("#delete-schedule-btn").click(function(){
  if(confirm("Are you sur you want to delete this reservation?"))
  {
    var id = $('#lbl-sched-id').val();

      $.ajax({
                     url:"schoolAdministrator_deleteEvent.php",
                     type:"POST",
                     data:{id:id},
                     success:function()
                     {
                      calendar.fullCalendar('refetchEvents');
                      alert("Event Removed");
                     }
                    })
  }
});

$("#update-schedule-btn").click(function(){
  if(confirm("Are you sur you want to update this reservation?"))
  {
    var id = $('#lbl-sched-id').val();
    var name = $('#inp-edit-name').val();
    var section = $('#sel-edit-sect').val();
    var prof = $('#sel-edit-prof').val();
    var purpose = $('#sel-edit-purp').val();
    var remarks = $('#inp-edit-rem').val();

    alert(id+ name + section + prof+ purpose + remarks);
      $.ajax({
                     url:"schoolAdministrator_UpdateEventsInfo.php",
                     type:"POST",
                     data:{id:id,name:name,section:section,prof:prof,purpose:purpose,remarks:remarks},
                     success:function()
                     {
                      calendar.fullCalendar('refetchEvents');
                      alert("Updated Succesfully");
                     }
                    })
  }
});



});

//UPDATE RESERVATION INFO

function getSection(val){
  $.ajax({
    url:'Queries/readSections.php',
    type:'POST',
    data:{course:val},
    success:function(response){
      $("#sel-edit-sect").html(response);
      $("#sel-edit-sect").prop('disabled',false);
    }
  });
}


