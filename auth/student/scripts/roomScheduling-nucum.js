$(function() {
  $('#room-calendarview').fullCalendar({
    themeSystem: 'bootstrap4',
    contentHeight: 'auto',
    defaultView: 'agendaWeek',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month, agendaWeek, agendaDay, listMonth'
    },
    hiddenDays: [ 0 ],
    columnHeaderFormat: 'dddd',
    minTime: '07:00:00',
    maxTime: '22:00:00',
    editable: true,
    selectable: true,
    selectHelper:true,
    allDaySlot: false,
    events: [{
        title: 'ELECTIVES',
        start: '2018-10-12T07:30:00',
        end: '2018-10-12T09:30:00',
        allDay: false // will make the time show
      },
      {
        title: 'N/A',
        start: '2018-09-18T07:30:00',
        end: '2018-09-18T10:30:00',
        allDay: false // will make the time show
      },
      {
        title: 'N/A',
        start: '2018-09-22T12:30:00',
        end: '2018-09-22T20:30:00',
        allDay: false // will make the time show
      },
      {
        title: 'N/A',
        start: '2018-09-25T10:30:00',
        end: '2018-09-25T16:30:00',
        allDay: false // will make the time show
      }
    ],
    eventColor: '#8f0400',
    eventClick: function(event, jsEvent, view) {
      endtime = $.fullCalendar.moment(event.end).format('h:mm');
      starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
      var mywhen = starttime + ' - ' + endtime;
      $('#modalTitle').html(event.title);
      $('#modalWhen').text(mywhen);
      $('#eventID').val(event.id);
      $('#roomScheduleModal').modal();
    },
    select: function(start, end, jsEvent) {
      endtime = $.fullCalendar.moment(end).format('h:mm');
      starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
      var mywhen = starttime + ' - ' + endtime;
      start = moment(start).format();
      end = moment(end).format();
      $('#create-roomSchedule #startTime').val(start);
      $('#create-roomSchedule #endTime').val(end);
      $('#create-roomSchedule #selectedRoomSched').text(mywhen);
      $('#create-roomSchedule ').modal('toggle');
    },
    eventDrop: function(event, delta) {
      $.ajax({
        url: '',
        data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
        type: "POST",
        success: function(json) {}
      });
    },
    eventResize: function(event) {
      $.ajax({
        url: '',
        data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
        type: "POST",
        success: function(json) {}
      });
    }
  });
  $('#submitButton').on('click', function(e) {
    e.preventDefault();
    doSubmit();
  });
  $('#deleteButton').on('click', function(e) {
    e.preventDefault();
    doDelete();
  });

  function doDelete() {
    $("#roomScheduleModal").modal('hide');
    var eventID = $('#eventID').val();
    $.ajax({
      url: '',
      data: 'action=delete&id=' + eventID,
      type: "POST",
      success: function(json) {
        if (json == 1)
          $("#room-calendarview").fullCalendar('removeEvents', eventID);
        else
          return false;
      }
    });
  }

  function doSubmit() {
    $("#roomScheduleModal").modal('hide');
    var title = $('#title').val();
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();

    $.ajax({
      url: '',
      data: 'action=add&title=' + title + '&start=' + startTime + '&end=' + endTime,
      type: "POST",
      success: function(json) {
        $("#room-calendarview").fullCalendar('renderEvent', {
            id: json.id,
            title: title,
            start: startTime,
            end: endTime,
          },
          true);
      }
    });
  }
});
