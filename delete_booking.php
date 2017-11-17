<?php
    include("loginserv.php");
    if(!isset($_SESSION["role"])) {
        header ("Location: index.php");
    }
    else
    {
       $ID=$_GET["ID"]; 

    //Connection to the database
    include("./includes/DB_connection.php");
        
    $query = mysqli_query($conn, "DELETE FROM bookingrecord WHERE bookingid='$ID'");
    
    mysqli_close($conn); // Closing connection 
           
    header ("Location: calendar.php");
       
    }
    
?>