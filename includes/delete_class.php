<?php


    $ID=$_GET["ID"]; 

    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match
    $query = mysqli_query($conn, "DELETE FROM tclass WHERE roomid='$ID'");
        
    
            header("Location: ../class_list.php"); // Redirecting to other page

    mysqli_close($conn); // Closing connection
   
    
?>