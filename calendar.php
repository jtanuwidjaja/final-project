<?php
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")) {
        header("location: index.php");
    }
    include("./includes/DB_queries.php");
    
    $campusquery = get_branch_list();

    //searching branch for administrators of faculties
    if ($_SESSION["role"] == 1) {
        $userid = $_SESSION['login'];
        $userbrachquery = mysqli_query($conn, 
       "SELECT branchid, facultyid FROM user WHERE login = '$userid'");
        $rows = mysqli_fetch_array($userbrachquery);
        $userbranch = $rows["branchid"];
        //$faculty = $rows["facultyid"];

    }
?>

<!DOCTYPE HTML5>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking calendar</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/scheduler.min.css' rel='stylesheet' />
    
    
    <link href="css/calendar.css" rel="stylesheet" />
    
</head>
<body>
    <!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>	
<!--    <?php include("get_events.php")?>-->
<!--<?php include("get_rooms.php")?>-->
    <div class="container">
        <div class="row">
            <div class="form-group col-lg-4">
                <label >Campus</label>
                <select class="form-control" name="campus" id="campus"<?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
                <?php 
                    while($row = mysqli_fetch_array($campusquery)){        
                        echo '<option value="'.$row["branchid"].'"';
                        if(isset($userbranch)){
                            if ($row["branchid"] == $userbranch) {
                                echo ' selected';
                            }
                        }
                        echo '>'.$row["branchname"].'</option>';
                    }
                ?>
                </select>
                </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
        
    

<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src='js/scheduler.min.js'></script> 

    
<!--Bootstrap main -->
<script src="js/bootstrap.min.js"></script>
    
<script type="text/javascript" src="js/js.cookie.js"></script>
    
    
<script type="application/javascript">

$(document).ready(function calendar() {
    create_calendar();
});

$('#campus').change(function(){
    $('#calendar').fullCalendar( 'destroy' );
    create_calendar();
});
 
function create_calendar() {
    $('#calendar').fullCalendar({
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        editable: true,
        aspectRatio: 1.8,
        scrollTime: '00:00',
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'timelineDay,agendaWeek,month'
        },
        defaultView: Cookies.get('fullCalendarCurrentView') || 'timelineDay',
        defaultDate: Cookies.get('fullCalendarCurrentDate') || null,
        viewRender: function(view) {
            Cookies.set('fullCalendarCurrentView', view.name, {path: ''});
            Cookies.set('fullCalendarCurrentDate', view.intervalStart.format(), {path: ''});
        },
//			views: {
//				timelineThreeDays: {
//					type: 'timeline',
//					duration: { days: 3 }
//				}
//			},
        eventOverlap: false, // will cause the event to take up entire resource height
        resourceAreaWidth: '15%',
        resourceLabelText: 'Rooms',
        resources: {
            url: 'get_rooms.php',
            type: 'POST',
            data: {
                    branch: $('#campus option:selected').val()
                }
        },

        events: {
            url: 'get_events.php',
            type: 'POST',
            data: {
                    branch: $('#campus option:selected').val()
                }
        },

        eventDrop: function (event, delta, revertFunc) {       
            update_event(event, delta, revertFunc);
        },

        eventResize: function(event, delta, revertFunc) {
            update_event(event, delta, revertFunc);
        },
        eventClick: function(calEvent, jsEvent, view) {
            window.location = "show_event_info.php?id=" + calEvent.id;
            var method = 'POST';
            var path = 'show_event_info.php';
            var params = new Array();
            params['id'] = calEvent.id;
    //        params['event_start'] = calEvent.start;
    //        params['event_end'] = calEvent.end;
    //        params['event_user_id'] = calEvent.user_id;
            post_to_url(path, params, method);
        },
        selectable: true,
        select: function(start, end, allDay) {
            insert_event(start, end, allDay);
        },
        allDaySlot: false
            
    });
}
function update_event(event, delta, revertFunc) {
    var start = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
    var date = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD");
    var end = $.fullCalendar.formatDate(event.end, "HH:mm:ss");
    $.ajax({
            url: 'update_event.php',
            data: '&date='+ date+'&start='+ start +'&end='+ end +'&id='+ event.id + '&roomid='+ event.resourceId,
            type: "POST",
            success: function(json) {
                    alert("Update successfully");
            },
            error: function(json) {
                    alert("There is some connection problems. Please contact to your system administrator.");
                    revertFunc();
            },
    }); 
}
function insert_event(start, end, allDay) {
    var time_start = $.fullCalendar.formatDate(start, "HH:mm:ss");
    var date = $.fullCalendar.formatDate(start, "DD/MM/YYYY");
    var time_end = $.fullCalendar.formatDate(end, "HH:mm:ss");
    
    window.location = "booking.php";
    var method = 'POST';
    var path = 'booking.php';
    var params = new Array();
    params['date'] = date;
    params['time_start'] = time_start;
    params['time_end'] = time_end;
            
//            params['date'] = date;
//            params['date'] = date;
    //        params['event_start'] = calEvent.start;
    //        params['event_end'] = calEvent.end;
    //        params['event_user_id'] = calEvent.user_id;
    post_to_url(path, params, method);
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
    
<script>
        <?php if ($_SESSION["role"] != "0") echo "
        $('#campus option:not(:selected)').prop('disabled', true);
        ";?>
</script>
       
</body>
</html>