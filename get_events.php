<?php
    include("loginserv.php");
    
    //Connection to the database
    include("./includes/DB_connection.php");

    $branch = $_POST['branch'];
    //$tutor = 'tutor1';
    $tutor = $_POST['tutor'];

    //$branch = 1;
    //echo 'event'.$ubranch.' ';
    

    //defining the faculty for registered user (faculty will need define editable events)
    $userid = $_SESSION['login'];
    
    $query = mysqli_query($conn, "SELECT branchid, facultyid, role FROM user WHERE login = '$userid'");
    $row = mysqli_fetch_array($query);
    $userfaculty = $row['facultyid'];
    $role = $row['role'];
    if (isset($_POST['tutor'])) {
        $query = mysqli_query($conn, "
            SELECT * FROM bookingrecord
            JOIN room ON bookingrecord.roomid = room.roomid 
            JOIN building ON room.buildingid = building.buildingid
            WHERE building.branchid = $branch AND bookingrecord.tutor ='$tutor' ");

    }
    else {
        $query = mysqli_query($conn, "
            SELECT * FROM bookingrecord
            JOIN room ON bookingrecord.roomid = room.roomid 
            JOIN building ON room.buildingid = building.buildingid
            WHERE building.branchid = $branch");
    }
    
    
    $events = array();
    
        
        

    while($row = mysqli_fetch_array($query)){
        $e = array();
        $e['id'] = $row['bookingid'];
        $e['resourceId'] = $row['roomid'];
        $e['title'] = $row['classname'];
        $e['start'] = $row['bookingdate'].'T'.$row['time_start'];
        $e['end'] = $row['bookingdate'].'T'.$row['time_end'];
        if ($role !=0 && $row['facultyid'] != $userfaculty) {
            $e['editable'] = false;
            $e['className'] = "readonly";   
        }
        
        $rooms = array(); //avauoilable rooms
        $capacity = $row['capacity'];
        $faculty = $row['facultyid'];
        
        $roomsquery = mysqli_query($conn, 
        "SELECT room.roomid FROM room 
        JOIN building ON room.buildingid=building.buildingid
        LEFT JOIN restriction ON room.roomid=restriction.roomid
        WHERE
        room.capacity >= '$capacity' AND
        building.branchid = '$branch' AND
        (restriction.facultyid = '$faculty' OR restriction.facultyid IS NULL)");
        
        $i = 0;
        while ($r = mysqli_fetch_array($roomsquery)){
            $rooms['resourceIds'][$i] =$r['roomid'];
            $i++;     
        }
        
        $e['constraint'] = $rooms;
        // Merge the event array into the return array
        array_push($events, $e);
        
        //creat recurring events
        //check that event should be repeated
        if ($row['bookingrepeat'] > 0) {
            $repeat_date = date_create($row['bookingdate']);
            $formated_end_repeat = date_create($row['end_repeat']);
            date_add($repeat_date,date_interval_create_from_date_string( $row['bookingrepeat'].' days')); //repeat date = booking date + "repeat" days
            $interval = date_diff($repeat_date,$formated_end_repeat); //end_repeat date - repeat date
            $days = $interval->format('%R%d'); 
            while ($days >= 0)
            { 
                $re = array();
                $repeat_dateDB = $repeat_date->format('Y-m-d');
                $re['id'] = $row['bookingid'];
                $re['resourceId'] = $row['roomid'];
                $re['title'] = $row['classname'];
                $re['start'] = $repeat_dateDB.'T'.$row['time_start'];     $re['end'] = $repeat_dateDB.'T'.$row['time_end'];
                if ($role !=0 && $row['facultyid'] != $userfaculty) {
                    $re['editable'] = false;
                    $re['className'] = "readonly";   
                }
                $re['constraint'] = $rooms;
                
              // Merge the event array into the return array
                array_push($events, $re); 
                
               //$repeat_date + "repeat" days for next loop step
                date_add($repeat_date,date_interval_create_from_date_string( $row['bookingrepeat'].' days'));
                $interval = date_diff($repeat_date, $formated_end_repeat);
                $days = $interval->format('%R%d');
            } 
        }
    }
    
    // Output json for our calendar
    echo json_encode($events);
