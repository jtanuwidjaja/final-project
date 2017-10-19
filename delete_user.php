<?php


    $ID=$_GET["ID"]; 

    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    $conn = mysqli_connect("localhost", "root", "root");
    //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
    //sql query to fetch information of registerd user and finds user match
    $query = mysqli_query($conn, "DELETE FROM user WHERE userid='$ID'");
        header ("Location: user.php");
       
    mysqli_close($conn); // Closing connection
   
    
?>