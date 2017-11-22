<?php
    /* Values received via ajax */
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time_start = $_POST['start'];
    $time_end = $_POST['end'];
    $roomid = $_POST['roomid'];
    
    //Connection to the database
    //include("./includes/DB_connection.php");
    include("./includes/DB_queries.php");

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
    if (($roomid_old != $roomid)||($date_old != $date)||($time_start_old != $time_start)||($time_end_old != $time_end)) {
        $query = mysqli_query($conn, "UPDATE bookingrecord SET bookingdate = '$date', time_start = '$time_start', time_end = '$time_end', roomid = '$roomid' WHERE bookingid = '$id'");
        
        header("Location: phpmailer/mail.php?ID=".$id.'&room='.$roomid_old.'&class='.$classname_old.'&date='.$date_old.'&time_start='.$time_start_old.'&time_end='.$time_end_old.'&repeat='.$repeat_old.'&end_repeat='.$end_repeat_old.'&capacity='.$capacity_old.'&tutor='.$tutor_old.'&faculty='.$faculty_old.'&type=update'); 
        
    }
   
?>