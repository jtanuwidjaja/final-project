<?php 
    //Connection to the database
    include("./includes/DB_connection.php");
        
    $date = $_POST["date"];
    $dateDB = $date[6].$date[7].$date[8].$date[9].'-'.$date[3].$date[4].'-'.$date[0].$date[1];
    $time_start = date('H:i:s',strtotime($_POST['time_start']));
    $time_end = date('H:i:s',strtotime($_POST['time_end'])); 
    $branch = $_POST['campus'];
    $faculty = $_POST['faculty'];
    $capacity = $_POST['capacity'];
    $repeat = $_POST['repeat'];
    $end_repeat = $_POST['end_repeat'];
    $end_repeatDB =  $end_repeat[6].$end_repeat[7].$end_repeat[8].$end_repeat[9].'-'.$end_repeat[3].$end_repeat[4].'-'.$end_repeat[0].$end_repeat[1];
    
    if ($repeat > 0) {
        //Defining last repeat date for query
        $formated_date = date_create($dateDB);
        $formated_end_repeat = date_create($end_repeatDB);
        $interval = date_diff($formated_end_repeat, $formated_date); //end_date - date
        $days = $interval->format('%d'); //number of days between end_date and date
        $remainder = $days % $repeat;
        date_sub($formated_end_repeat, date_interval_create_from_date_string($remainder.' days')); //last date = end_date - remainder of (days/repeat)
        $last_repeat = $formated_end_repeat->format('Y-m-d');
    }
    else $last_repeat = $dateDB;
       
    $query = mysqli_query($conn, 
        "SELECT room.roomid, room.roomname, building.buildingname, room.level, room.capacity FROM room 
        JOIN building ON room.buildingid=building.buildingid
        LEFT JOIN restriction ON room.roomid=restriction.roomid
        WHERE 
        room.capacity >= '$capacity' AND
        building.branchid = '$branch' AND
        (restriction.facultyid = '$faculty' OR restriction.facultyid IS NULL) AND
        room.roomid NOT IN 
        (
            SELECT DISTINCT roomid FROM bookingrecord 
			WHERE
            (
                DATEDIFF(bookingdate, '$last_repeat') <= 0 AND
                DATEDIFF(DATE_SUB(end_repeat, INTERVAL (MOD(DATEDIFF(end_repeat, bookingdate),GREATEST(bookingrepeat,1))) DAY), '$dateDB') >= 0
    		) AND
            (
        		MOD(DATEDIFF(bookingdate, '$dateDB'),LEAST(bookingrepeat,$repeat)) = 0 OR MOD(DATEDIFF('$dateDB', bookingdate),LEAST(bookingrepeat,$repeat)) is NULL
    		) AND  
    		time_start < '$time_end' AND time_end > '$time_start'
        )"); 


//    echo '
//        <form>
//            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Building</th>
                        <th>Level</th>
                        <th>Capacity</th>
                        <th>Acessibility</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query)){          
            $roomid = $row["roomid"];
            $query2 = mysqli_query($conn,
            "SELECT faculty.facultyname FROM restriction JOIN faculty ON restriction.facultyid = faculty.facultyid WHERE restriction.roomid = '$roomid'");
        
        echo '
                <tr onclick="selectroom('.$row["roomid"].')">
                    <td>
                    '.$row["roomname"].'
                    </td>
                    <td>
                    '.$row["buildingname"].'
                    </td>
                    <td>
                    '.$row["level"].'
                    </td>
                    <td>
                    '.$row["capacity"].'
                    </td>
                    <td>';
        while($faculty = mysqli_fetch_array($query2)) {
            
                echo    $faculty["facultyname"].' ';
        }
                    
            echo   '</td>
                    </tr>';
            
        }
    echo "</tbody>"; //Close the table in HTML
    mysqli_close($conn); // Closing connection



?>