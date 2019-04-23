$(document).ready(function() 
{

  var selDay;
  var selDate;
  var startTime;
  var endTime;
  var room_='';
  var holdroom='';
  var roomIsSelected= false;
  var deleteRoomSelect = false;


  $('#Room').change (function() 
  {
    roomIsSelected = true;
    var e = document.getElementById("Room");
    var strUser = e.options[e.selectedIndex].text;
    room_=strUser;
    $('#room_calendarview').fullCalendar( 'removeEventSource', url ="/pupwebdev/auth/acadservice/acadService_loadEvent.php?room=" + holdroom)
    $('#room_calendarview').fullCalendar( 'addEventSource', url ="/pupwebdev/auth/acadservice/acadService_loadEvent.php?room=" + room_)
    holdroom=room_;
  });

  $('#RoomDelete').change (function() 
  {
    deleteRoomSelect = true;

  });
   
  var calendar = $('#room_calendarview').fullCalendar
  ({
 
    header: false,
    contentHeight: 'auto',
    defaultView: 'agendaWeek',
    hiddenDays: [ 0 ],
    columnHeaderFormat: 'ddd',
    minTime: '07:00:00',
    maxTime: '22:00:00',
    editable: true,
    selectable: true,
    selectHelper: true,
    selectOverlap :false,
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
    allDaySlot: false,
    events: url ="/pupwebdev/auth/acadservice/acadService_loadEvent.php?room=" + room_,
    eventOverlap: false,
    eventColor: '#8f0400',


    select: function(start, end, day, date, jsEvent) 
    {   
      if(roomIsSelected)
      {
        var endtime = $.fullCalendar.moment(end).format('h:mm');
        var starttime = $.fullCalendar.moment(start).format('h:mm');
        var daySched = $.fullCalendar.moment(start).format('ddd');
        var dateSched = $.fullCalendar.moment(start).format('YYYY-MM-DD');
        var schedule = daySched + ', ' + dateSched + ', ' + starttime + ' - ' + endtime;
      
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
        
        // validate();
      
      }
      else
      {
       alert("Please select a room.");
      }
   
    },

    eventClick: function(event) 
    {
      if(roomIsSelected)
      {
        if(confirm("Are you sure you want to remove it?"))
        {    
          var id = event.id;
          // alert(id);
           $.ajax
           ({
             url:"acadService_deleteEvent.php",
             type:"POST",
             data:{id:id},
             success:function()
            {
              calendar.fullCalendar('refetchEvents');
              alert("Event Removed");
            }
          }); 
          alert("Deleted Successfully");
          // window.location.href = "http://localhost:1234/pupwebdev-iya/auth/admin/delete.php?id="+ id;
        }

       
      }
      else
      {
         alert("Please select a room.");
      }
    
    },

    eventDrop: function(event) 
    {

      var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
      var day = $.fullCalendar.formatDate(event.start, "ddd");
      var id = event.id;

       $.ajax({
          url:"acadService_updateEvent.php",
          type:"POST",
          data:{startTime:start, endTime:end, scheduleID:id, scheduleDay:day},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
          }
        });
      
      // alert("Updated Successfully");
      // window.location.href = "http://localhost:1234/pupwebdev-iya/auth/admin/update.php?startTime="+ start +"&endTime=" + end + "&scheduleID="+ id + "&scheduleDay=" + day ; 
        
      
    },

    eventResize: function(event) 
    {

     
      var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
      var day = $.fullCalendar.formatDate(event.start, "ddd");
      var id = event.id;

        $.ajax({
          url:"acadService_updateEvent.php",
          type:"POST",
          data:{startTime:start, endTime:end, scheduleID:id, scheduleDay:day, reservationDate:null},
          success:function()
          {
            calendar.fullCalendar('refetchEvents');
            alert("Event Updated");
          }
        });
      // alert("Updated Successfully ");
      // window.location.href = "http://localhost:1234/pupwebdev-iya/auth/admin/update.php?startTime="+ start +"&endTime=" + end + "&scheduleID="+ id + "&scheduleDay=" + day; 
      
    }

  
  });

  function doSubmit() 
  {



   $('#create-roomSchedule').modal('hide');
    var subject = $("#SubjectTitle").val();
    var section = $("#Section").val();
    var professor = $("#Professor").val();
    var room = $("#Room").val();
  
    $.ajax({
     url:"acadService_insertEvent.php",
     type:"POST",
     data:{section:section, 
            subject:subject, 
            startTime:startTime,
            endTime:endTime, 
            selDay:selDay,
            room:room, 
            professor:professor},
    
     success:function()
     {

      calendar.fullCalendar('refetchEvents');
      alert("Added Successfully");
      $("#addSchedModal")[0].reset();
      $('#Section').empty();
      $('#Section').append(' <option disabled selected hidden>Select Section..</option>');

     }

    });



  // alert("Added Successfully");
  // window.location.href = "http://localhost:1234/pupwebdev-iya/auth/admin/add.php?section="+ section + "&subject="+ subject +"&startTime=" + startTime + "&endTime=" + endTime +"&selDay=" + selDay + "&room=" + room + "&professor=" + professor;

  }

 
  
 
  
  $('#submitButton').click(function() 
  {
   
      if ($("#SubjectTitle").val()==null || $("#Course").val()==null || $("#Professor").val()==null || $("#Section").val()==null)
      {
           // validate();
        alert("Please complete all fields!");
      }
      else
      {
   
        doSubmit();
      }

  });

  $('#cancelButton').click(function() 
  {
   
    deleteRoomSelect = false;
    $("#deleteSchedModal")[0].reset();

  });


  $('#deletebtn').click(function() 
  {
   if(deleteRoomSelect)
   {
     var del = $("#RoomDelete").val();

        $.ajax({
        url:"deleteSchedule.php",
        type:"POST",
        data:{del:del},
        
          success:function()
          { 
            if (confirm("Are you sure you want to delete?")==true)
            {
           
              alert("Deleted Successfully");
              $('#deleteModal').modal('hide');
              $("#deleteSchedModal")[0].reset();
              calendar.fullCalendar('refetchEvents');
              deleteRoomSelect = false;
             // location.reload();
             window.location.href = "acadService_Scheduler.php";
            }

            else
            {
            
            }
       

          }
        });   

   }
   else
   {
    alert("Please select a room first.");
    deleteRoomSelect = false;
   }

  });
  


})