<?php


    $ID=$_GET["ID"]; 

    include ("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match
    $query = mysqli_query($conn, "DELETE FROM room WHERE roomid='$ID'");
        
    
    header("Location: ../room_list.php"); // Redirecting to other page

    mysqli_close($conn); // Closing connection
   
    
?>