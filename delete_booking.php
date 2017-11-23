<?php
    include("loginserv.php");
    include("./includes/DB_queries.php");
    if(!isset($_SESSION["role"])) {
        header ("Location: index.php");
    }
    else
    {
    
    $ID=$_GET["ID"]; 
    
    //fetch old values for current booking id
    $query = select_booking($ID);
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

        
    $query = mysqli_query($conn, "DELETE FROM bookingrecord WHERE bookingid='$ID'");
    
    mysqli_close($conn); // Closing connection 
    
    header("location: ./phpmailer/mail.php?ID=".$ID.'&room='.$roomid_old.'&class='.$classname_old.'&date='.$date_old.'&time_start='.$time_start_old.'&time_end='.$time_end_old.'&repeat='.$repeat_old.'&end_repeat='.$end_repeat_old.'&capacity='.$capacity_old.'&tutor='.$tutor_old.'&faculty='.$faculty_old.'&type=delete');
    
   
           
    //header ("Location: calendar.php");
       
    }
    
?>