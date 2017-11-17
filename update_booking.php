<?php
    //Waiting when book but will be clicked
    if(isset($_POST['save'])){
        $userid = $_SESSION['login'];
        //Receiving parameters from bookinginfo.php page
        $id = $_POST['bookingid'];
        $roomid = $_POST['room'];
        $date = $_POST['date'];
        $dateDB = $date[6].$date[7].$date[8].$date[9].'-'.$date[3].$date[4].'-'.$date[0].$date[1];
        $time_start = date('H:i:s',strtotime($_POST['time_start']));
        $time_end = date('H:i:s',strtotime($_POST['time_end'])); 
        $branch = $_POST['campus'];
        $faculty = $_POST['faculty'];
        $capacity = $_POST['capacity'];
        $classname = $_POST['classname'];
        $repeat = $_POST['repeat'];
        $end_repeat = $_POST['end_repeat'];
        $end_repeatDB = $end_repeat[6].$end_repeat[7].$end_repeat[8].$end_repeat[9].'-'.$end_repeat[3].$end_repeat[4].'-'.$end_repeat[0].$end_repeat[1];
        $tutor = $_POST['tutor'];

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
        else {
            $last_repeat = $dateDB;
            $end_repeatDB = $dateDB;
        }

        //check, that room with selected criteria is available 
       $query = check_room_availability($id,$roomid,$capacity,$branch,$faculty,$dateDB,$repeat,$last_repeat,$time_start,$time_end);

        $rows = mysqli_num_rows($query);

        //If classroom is available, then create booking record.
        if($rows == 1){

            $query = update_booking($dateDB,$time_start,$time_end,$roomid,$userid,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor,$id);
            
            header("Location: calendar.php");
        }
        else {
            $error = "Classroom can't be booked. Please, change booking parameters.";

        }

    }
?>