<?php


    $ID=$_GET["ID"]; 

    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query1 = mysqli_query($conn, "SELECT * FROM room WHERE roomid='$ID'");
    $row = $query1->fetch_assoc();
    if (unlink($row["roompic"])) {
        $query = mysqli_query($conn, "DELETE FROM room WHERE roomid='$ID'");
        header ("Location: gallery.php");
    }
    else {
        echo "Can't delete room photo";
    }
    
            
    


       
    mysqli_close($conn); // Closing connection
   
    
?>