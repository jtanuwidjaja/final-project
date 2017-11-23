<?php
    
    include("./includes/DB_queries.php");
    
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

    //check, if some changes were made
    //fetch old values for current booking id
    $query = select_booking($id);
    $rows = mysqli_fetch_array($query);
    $roomid_old = $rows['roomid'];
    $date_old = $rows['bookingdate'];
    $capacity_old = $rows['capacity'];
    $time_start_old = $rows['time_start'];
    $time_end_old = $rows['time_end'];
    $faculty_old = $rows['facultyid'];
    $repeat_old = $rows['bookingrepeat'];
    $end_repeat_old = $rows['end_repeat'];
    $classname_old = $rows['classname'];
    $tutor_old = $rows['tutor'];
    //compare old values with new values. If there are some differences, continue
    if (($roomid_old != $roomid)||($date_old != $dateDB)||($capacity_old != $capacity)||($time_start_old != $time_start)||($time_end_old != $time_end)||($repeat != $repeat_old)||($end_repeatDB != $end_repeat_old)||($classname != $classname_old)||($tutor != $tutor_old)||($faculty != $faculty_old)) {
    //            echo $id.'#'.$roomid_old.'-'.$roomid.'   '.
    //                 $date_old.'-'.$date.'   '.
    //                 $capacity_old.'-'.$capacity.'   '.
    //                 $time_start_old.'-'.$time_start.'   '.
    //                 $time_end_old.'-'.$time_end.'   '.
    //                 $repeat.'-'.$roomid.'   '.
    //                 $end_repeatDB.'-'.$end_repeat_old.'   '.
    //                 $classname.'-'.$classname_old.'   '.
    //                 $tutor_old.'-'.$tutor.'   '
    //                ;
        //check, that room with selected criteria is available 
       $query = check_room_availability($id,$roomid,$capacity,$branch,$faculty,$dateDB,$repeat,$last_repeat,$time_start,$time_end);

        $rows = mysqli_num_rows($query);

        //If classroom is available, then create booking record.
        if($rows == 1){

            $query = update_booking($dateDB,$time_start,$time_end,$roomid,$userid,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor,$id);

            if ($tutor != $tutor_old) {
                header("Location: ./phpmailer/mail.php?ID=".$id.'&type=new');  
            }
            else {
                header("Location: phpmailer/mail.php?ID=".$id.'&room='.$roomid_old.'&class='.$classname_old.'&date='.$date_old.'&time_start='.$time_start_old.'&time_end='.$time_end_old.'&repeat='.$repeat_old.'&end_repeat='.$end_repeat_old.'&capacity='.$capacity_old.'&tutor='.$tutor_old.'&faculty='.$faculty_old.'&type=update');  
            }

        }
        else {
            $error = "Classroom can't be booked. Please, change booking parameters.";

        }

    }
    else {
        header("Location: calendar.php");
    }

?>