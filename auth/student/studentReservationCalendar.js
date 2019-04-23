var roomIsSelected=false;
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

  var remarks="";

 function refreshData()
 {
    var e = document.getElementById("Room");
    var strUser = e.options[e.selectedIndex].text;
    room_="'"+ strUser+ "'";
    var view = $("#student-calendar").fullCalendar('getView');
    
    var fulldate= view.title.split('-');
    //alert(fulldate);
    var startday= fulldate[2];
    var daysa = startday.substring(0,2);

    startdate=  fulldate[0] + "-" + fulldate[1] + "-" + daysa ;
    var endday= fulldate[3];
    var dayss = endday.substring(1,3);

    var endDate=  fulldate[0] + "-" + fulldate[1] + "-" + dayss;
    selectedval=true;

  //alert(holdstart  + "|" + holdend + "|" + holdroom );
  //alert(room_ + "  | " + startdate + "  | "  + endDate);
 
    $('#student-calendar').fullCalendar( 'removeEventSource', url ="php/readRoomSchedule.php?room=" +
    holdroom + "&startdate=" +holdstart + "&enddate=" +holdend);

    $('#student-calendar').fullCalendar( 'addEventSource', url ="php/readRoomSchedule.php?room=" + room_
    + "&startdate=" +startdate + "&enddate=" +endDate);


    holdroom=room_;
    holdstart=startdate;
    holdend=endDate;
 }

  $('#Room').change (function() 
    {
      if($("#Room").val != "")
      {
        roomIsSelected=true;
      }
      else{
        roomIsSelected=false;
      }
      refreshData(); 
  });

var calendar= $("#student-calendar").fullCalendar({
  header:{
    left:'prev next',
     
    right:'agendaWeek listMonth'
  },
   height: 510,
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
  
  
  defaultView:'agendaWeek',
  hiddenDays: [ 0 ],


        columnHeaderFormat: 'MM-DD ddd',
        minTime: '07:00:00',
        maxTime: '22:00:00',
        editable: false,
        selectable: true,
        selectHelper: true,
        allDaySlot: false,
        views: 
        {
            week: 
                {
                titleFormat: 'YYYY-MM-DD-MM-YYYY' 
                }
        },

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
         if(roomIsSelected && $("#reserve-type").val()!="")
          {
            var dateSched = $.fullCalendar.moment(start).format('YYYY-MM-DD')+' '+$.fullCalendar.moment(start).format('HH:mm:ss');
            var starttime = $.fullCalendar.moment(start).format('HH:mm:ss');
            var today = new Date();
            var currdate =  $.fullCalendar.moment(today).format('YYYY-MM-DD')+' '+$.fullCalendar.moment(today).format('HH:mm:ss');
            // var currtime =  $.fullCalendar.moment(today).format('HH:mm:ss');

            if(dateSched>=currdate){
            var endtime = $.fullCalendar.moment(end).format('HH:mm:ss');        
            var daySched = $.fullCalendar.moment(start).format('ddd');
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
            if($("#reserve-type").val()=='student')
            {
               $('#course-div').prop('hidden',false);
               $('#org-div').prop('hidden',true);
            }

            if($("#reserve-type").val()=='organization')
            {
              $('#org-div').prop('hidden',false);
              $('#course-div').prop('hidden',true);
            }
           
          }

          else{
              alert("Invalid Schedule");
            }
           
            
          }
          else
          {
             alert("Please select a reservation type and room.");
          }
       
         }
       
         

});

$('#student-cal').on('shown.bs.modal', function () {
  $("#student-calendar").fullCalendar('render');
});

$("#reservationButton").click(function(){

 $("#student-cal").modal(open).show();
});


$('#submitButton').click (function()
  {
    var reserve_type = $("#reserve-type").val();
    if(reserve_type=="student")
    {
      if($("#inpt-fname").val()==""
        || $("#inpt-lname").val()==""
        || $("#Course").val()==null
        || $("#Section").val()==null 
        || $("#Professor").val() ==null
        || $("#scheduleReservationPurpose").val()=="")
        {
          alert("Please complete all necessary fields!");
        }
      else
      {
        $('#myModal').modal('toggle');
        $('#create-roomSchedule').modal('hide');
        $('#student-cal').modal('hide');
      }
    }
      
    if(reserve_type=="organization")
    {
       if($("#inpt-fname").val()==""
        || $("#inpt-lname").val()==""
        || $("#Organization").val()==null
        || $("#Professor").val() ==null
        || $("#scheduleReservationPurpose").val()==""
        )
      {
        alert("Please complete all necessary fields!");
      }
      else
      {
        $('#myModal').modal('toggle');
        $('#create-roomSchedule').modal('hide');
        $('#student-cal').modal('hide');
      }
    } 
    // alert("Hello");
   
  });

$('#printButton').click (function(e)
  {
    //  e.preventDefault();
     var offcode = $("#offcode").text();
     var offnum = $("#offnum").text();
     var code = offcode+offnum;

     //PRINT FUNCTION
     $.ajax({
      url:'../../escpos/example/interface/windows-usb.php',
      type:'POST',
      data:{code:code},
      success:function(data){
        // alert(data);
      }
     });
    $("#create-roomSchedule").modal('hide');
    $("#myModal").modal('hide');
    
    
    var section= document.getElementById('Section').value;
    var purpose = document.getElementById('roomPurpose').selectedIndex;
    var name =document.getElementById('inpt-fname').value+' '+document.getElementById('inpt-lname').value;
    var room=document.getElementById('Room').value;
    var prof =document.getElementById('Professor').value;
    var remarks = document.getElementById('Remarks').value;
    // remarks = document.getElementById('remarks-txtArea').value;
    if(purpose!= "")
    {
       // INSERT SCHEDULE

    if($('#reserve-type').val()=='student')
    {
       $.ajax({
       url:"../schoolAdmin/schoolAdministrator_insertEvent.php",
       type:"POST",
       data:{
             code:code,
             name:name, 
             purpose:purpose,
             prof:prof, 
             remarks:remarks, 
             section:section,
             room:room, 
             date:selDate, 
             day:selDay, 
             startTime:startTime,
             endTime:endTime},
             reservetype:$('#reserve-type').val(),
       success:function()
        {
        calendar.fullCalendar('refetchEvents');
        // alert("Added Successfully");
       }
      });
    }
   
    if($('#reserve-type').val()=='organization')
    {
      var organization = $('#Organization').val();
       $.ajax({
       url:"../schoolAdmin/schoolAdministrator_insertEvent.php",
       type:"POST",
       data:{
             code:code,
             name:name, 
             purpose:purpose,
             prof:prof, 
             remarks:remarks, 
             section:organization,
             room:room, 
             date:selDate, 
             day:selDay, 
             startTime:startTime,
             endTime:endTime,
             reservetype:$('#reserve-type').val()},
       success:function()
        {
        calendar.fullCalendar('refetchEvents');
        // alert("Added Successfully");
       }
      });
    }
    

    }


   
   


      $("#addSchedModal")[0].reset();
      $('#Section').empty();
      $('#Section').append(' <option disabled selected hidden>Select Section..</option>');
      // $("#remarks-txtArea").remove();
  // alert("name="+name + "&purpose=" + purpose +"remarks:"+remarks+ "&section="+ section +"&startTime=" + startTime + "&endTime=" + endTime + "&room=" + room +"&day=" + selDay+ "&date=" + selDate);
  //   window.location.href = "http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_insertEvent.php?name="+ name + "&purpose=" + purpose +
  //   "&date="+ selDate + "&section="+ section +"&startTime=" + startTime + "&endTime=" + endTime + "&room=" + room +"&day=" + selDay;

     location.reload();

  });


 $("#roomPurpose").change(function(){
    var roomPurpose = document.getElementById("roomPurpose");
    var selected = roomPurpose.options[roomPurpose.selectedIndex].text;
    // alert(selected);

    if(selected == "Others")
      {
        $("#remarks-div").prop('hidden',false);
        // var txtpurpose = "<textarea id='remarks-txtArea'></textarea>";       
        // $("#remarks-div").append(txtpurpose);
        // remarks =document.getElementById('remarks-txtArea').value
        // alert("hi");
      }

    else
    {
       $("#remarks-div").prop('hidden',true);
       $("#Remarks").val("");
    }


   
   //alert('prev is clicked, do something');
});

 $('.fc-prev-button').click(function(){

refreshData();
   //alert('prev is clicked, do something');
});

$('.fc-next-button').click(function(){
  refreshData();
   //alert('nextis clicked, do something');
});

});

$('#myModal').on('hidden.bs.modal', function () {
   $("#inpt-fname").val("");
   $("#inpt-lname").val("");
   $("#Course").val("").trigger("change");
   $("#Professor").val("").trigger("change");
   $("roomPurpose").val("").trigger("change");
})

$("#stud-cal-close").click(function(){
  $("#Room").val("").trigger("change");
  roomIsSelected = false;
});

$('input').keydown(function(){
var word = $(this).val();
            if ( word.match("^[a-zA-Z  ]*$") == null ) {
                word = word.slice(0,-1) + '';
                $(this).val(word);
            }
});
$('input').keyup(function(){
var word = $(this).val();
            if ( word.match("^[a-zA-Z  ]*$") == null ) {
                word = word.slice(0,-1) + '';
                $(this).val(word);
            }
});

$('textarea').keydown(function(){
var word = $(this).val();
            if ( word.match("^[a-zA-Z,  ]*$") == null ) {
                word = word.slice(0,-1) + '';
                $(this).val(word);
            }
});
$('textarea').keyup(function(){
var word = $(this).val();
            if ( word.match("^[a-zA-Z,  ]*$") == null ) {
                word = word.slice(0,-1) + '';
                $(this).val(word);
            }
});

