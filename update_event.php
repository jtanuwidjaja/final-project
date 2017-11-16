<?php
    /* Values received via ajax */
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $roomid = $_POST['roomid'];
    
    //Connection to the database
    include("./includes/DB_connection.php");

    $query = mysqli_query($conn, "UPDATE bookingrecord SET bookingdate = '$date', time_start = '$start', time_end = '$end', roomid = '$roomid' WHERE bookingid = '$id'");
?>