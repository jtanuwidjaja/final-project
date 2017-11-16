<?php
    include("loginserv.php") ;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking calendar</title>
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/scheduler.min.css' rel='stylesheet' />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>	
    <div class="container">
        <div class="row">
        <div id='calendar'></div>
        <div class="modal fade" id="editevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src='js/scheduler.min.js'></script> 
    
<!--Bootstrap main -->
<script src="js/bootstrap.min.js"></script>
    
    
<script type="application/javascript">
$(document).ready(function() {
    $('#calendar').fullCalendar({
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
			editable: true,
			aspectRatio: 1.8,
			scrollTime: '00:00',
			header: {
				left: 'today prev,next',
				center: 'title',
				right: 'timelineDay,timelineThreeDays,agendaWeek,month'
			},
			defaultView: 'timelineDay',
			views: {
				timelineThreeDays: {
					type: 'timeline',
					duration: { days: 3 }
				}
			},
			eventOverlap: false, // will cause the event to take up entire resource height
			resourceAreaWidth: '7%',
			resourceLabelText: 'Rooms',
    resources: {
        url: 'get_rooms.php',
        type: 'POST'
    },
        
    events: {
        url: 'get_events.php',
        type: 'POST'
    },
        
    eventDrop: function (event, delta, revertFunc) {       
        update_event(event, delta, revertFunc);
    },
        
    eventResize: function(event, delta, revertFunc) {
        update_event(event, delta, revertFunc);
    },
    eventClick: function(calEvent, jsEvent, view) {
        
//        alert('Event: ' + calEvent.id);
//        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
//        alert('View: ' + view.name);
        
        window.location = "show_event_info.php?id=" + calEvent.id;
        var method = 'POST';
        var path = 'show_event_info.php';
        var params = new Array();
        params['id'] = calEvent.id;
//        params['event_start'] = calEvent.start;
//        params['event_end'] = calEvent.end;
//        params['event_user_id'] = calEvent.user_id;
        post_to_url(path, params, method);

//        // change the border color just for fun
//        $(this).css('border-color', 'red');

    }    
    });
});

function update_event(event, delta, revertFunc) {
    var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
    var date = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
    var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
    $.ajax({
            url: 'update_event.php',
            data: 'title='+ event.title+'&date='+ date+'&start='+ start +'&end='+ end +'&id='+ event.id + '&roomid='+ event.resourceId,
            type: "POST",
            success: function(json) {
                    alert("Updated Successfully");
            },
            error: function(json) {
                    alert("There is some connection problems. Please contact to your system administrator.");
                    revertFunc();
            },
    }); 
}
function post_to_url(path, params, method) {
  method = method || "post"; // Set method to post by default, if not specified.

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  var form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", path);

  for(var key in params) {
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", key);
    hiddenField.setAttribute("value", params[key]);

    form.appendChild(hiddenField);
  }

  document.body.appendChild(form);    // Not entirely sure if this is necessary
  form.submit();
}
</script>

    
    

    
    
</body>
</html>