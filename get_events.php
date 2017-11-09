<?php
    //Connection to the database
    include("./includes/DB_connection.php");

    $query = mysqli_query($conn, "SELECT bookingid, roomid, classname, bookingdate, time_start, time_end FROM bookingrecord");

    $events = array();

    while($row = mysqli_fetch_array($query)){
        $e = array();
        $e['id'] = $row['bookingid'];
        $e['resourceId'] = $row['roomid'];
        $e['title'] = $row['classname'];
        $e['start'] = $row['bookingdate'].'T'.$row['time_start'];
        $e['end'] = $row['bookingdate'].'T'.$row['time_end'];
        
        
        // Merge the event array into the return array
        array_push($events, $e);
    }
    
    // Output json for our calendar
    echo json_encode($events);
//    function events() {
//        echo "  { id: '1', resourceId: 'b', start: '2017-10-07T02:00:00', end: '2017-10-07T07:00:00', title: 'event 1' },
//				{ id: '2', resourceId: 'c', start: '2017-10-07T05:00:00', end: '2017-10-07T22:00:00', title: 'event 2' },
//				{ id: '3', resourceId: 'd', start: '2017-10-06', end: '2017-10-08', title: 'event 3' },
//				{ id: '4', resourceId: 'e', start: '2017-10-07T03:00:00', end: '2017-10-07T08:00:00', title: 'event 4' },
//				{ id: '5', resourceId: 'f', start: '2017-10-07T00:30:00', end: '2017-10-07T02:30:00', title: 'event 5' }";
//    }
?>