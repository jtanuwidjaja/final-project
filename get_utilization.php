<?php
    //Connection to the database
    include("./includes/DB_connection.php");

    
    function calc_time_difference($interval_start, $interval_end, $event_start, $event_end){
        
        
        
        //define the borders
        if (strtotime($interval_start) > strtotime($event_start) ) {
            $t_start = $interval_start;
        }
        else {
            $t_start = $event_start;
        }
        if (strtotime($interval_end) > strtotime($event_end) ) {
            $t_end = $event_end;
        }
        else {
            $t_end = $interval_end;
        }
        
//        //define the time difference in min
//        $datetime1 = new DateTime($t_start);
//        $datetime2 = new DateTime($t_end);
//        $interval = date_diff($datetime1,$datetime2); 
//        $minutes= $interval->format('%i');
        
        $diff = strtotime($t_end) - strtotime($t_start);
        $minutes = floor($diff / 60);
        
//        if ($event_start == '01:30:00'&& $event_end == '06:00:00') {
//            echo $minutes.' '.$interval_start.' '.$interval_end.' '.$event_start.' '.$event_end.' '.$t_start.' '.$t_end;
//        }
        
        return $minutes;
    }
    
    $date_from = $_POST['date_from'];
    $time_from = $_POST['time_from'];
    $date_to = $_POST['date_to'];
    $time_to = $_POST['time_to'];
    $branch = $_POST['branch'];


    

//    $date_from = '2017-11-23';
//    $time_from = '09:00:00';
//    $date_to = '2017-12-01';
//    $time_to = '18:00:00';
//    $branch = '1';
    
    $roomquery = mysqli_query($conn, "SELECT room.roomid, room.roomname, building.buildingname, room.level   FROM room JOIN building ON room.buildingid = building.buildingid 
    WHERE building.branchid = $branch");



//echo "SELECT room.roomid, room.roomname, building.buildingname, room.level   FROM room JOIN building ON room.buildingid = building.buildingid 
//    WHERE building.branchid = $branch";
    
    $utilization = array();

    while($roomrow = mysqli_fetch_array($roomquery)){
        
        $roomutil = array();
        $roomid = $roomrow['roomid'];
        $roomutil ['roomid'] = $roomrow['roomid'];
        $roomutil ['roomname'] = $roomrow['roomname'];
        $roomutil ['buildingname'] =  $roomrow['buildingname'];
        $roomutil ['level'] =  $roomrow['level'];
        
        $bookingquery = mysqli_query($conn, 
                "SELECT * 
                FROM `bookingrecord` 
                WHERE 
                roomid = '$roomid' AND
                time_start <= '$time_to' AND
                time_end >= '$time_from' AND
                (
                    (
                        bookingrepeat = 0 AND
                        bookingdate >= '$date_from' AND
                        bookingdate <= '$date_to'
                    )
                    OR
                    (
                        bookingrepeat > 0 AND
                        bookingdate <= '$date_to' AND 
                        end_repeat >= '$date_from'
                    )
                )
                ");
        
        
        $roomutil['duration'] = 0;
        while($bookingrow = mysqli_fetch_array($bookingquery)){
                
            if ($bookingrow['bookingrepeat'] == 0) {
                
                $roomutil['duration'] += calc_time_difference($time_from, $time_to, $bookingrow['time_start'], $bookingrow['time_end']);
            }       
            if ($bookingrow['bookingrepeat'] > 0) {
                
                $event_date = date_create($bookingrow['bookingdate']);
                $end_repeat = date_create($bookingrow['end_repeat']);
                $date_from_format = date_create ($date_from);
                $date_to_format = date_create ($date_to);
                $interval = date_diff($event_date,$end_repeat); //end_repeat date - $event_date
                $flag = $interval->format('%R%a');
                
                $days = 0;
                //generating repeated events
                while ($flag >= 0) {
                    
                    $interval = date_diff($date_from_format,$event_date);
                    $fl1 = $interval->format('%R%a'); 
                    $interval = date_diff($event_date,$date_to_format);
                    $fl2 = $interval->format('%R%a'); 
                    
                    if ($fl1 >=0 && $fl2 >=0){
                        //if ($roomutil ['roomid'] == 6) {echo "Ddffdfdf";}
                        $days ++;
                    }
                    date_add($event_date,date_interval_create_from_date_string( $bookingrow['bookingrepeat'].' days'));
                    $interval = date_diff($event_date, $end_repeat);
                    $flag = $interval->format('%R%a');  
                    
                }
//                if ($roomutil ['roomid'] == 6) {
//                    echo $days;
//                }
                $roomutil['duration'] += $days*calc_time_difference($time_from, $time_to, $bookingrow['time_start'], $bookingrow['time_end']);
                
                
            }
            
//            if ($roomutil['duration'] >0 ) 
            //echo $roomid.' '.$roomutil['duration'].'||';
       }
        array_push($utilization, $roomutil);
        
    }

     //Output json for our calendar
    echo json_encode($utilization);
    
    
?>