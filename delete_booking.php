<?php
    include("loginserv.php");
    if(!isset($_SESSION["role"])) {
        header ("Location: index.php");
    }
    else
    {
       $ID=$_GET["ID"]; 

    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "DELETE FROM bookingrecord WHERE bookingid='$ID'");

    if ($_SESSION["role"] == "customer") {
        header ("Location: cancel_booking.php");
    }
    else {
        header ("Location: booking_list.php");
    }
    mysqli_close($conn); // Closing connection 
        
        
    }

    
   
    
?>