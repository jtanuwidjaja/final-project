<?php
    $ID=$_GET["ID"]; 

    //Connection to the database
    include("./includes/DB_connection.php");

    $query = mysqli_query($conn, "DELETE FROM user WHERE login='$ID'");
    header ("Location: user.php");
       
    mysqli_close($conn); // Closing connection  
?>