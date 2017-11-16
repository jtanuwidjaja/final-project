<?php
if(isset($_POST['create'])){
    
    
    $level = $_POST['leveldd'];
    $tower = $_POST['towerdd'];
    $capacity = $_POST['capacity'];
    $fullname = $_POST['fullname'];
    $roomid = $_POST['roomid'];



        include ("includes/DB_connection.php");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO room (roomname, buildingid, level, capacity) VALUES ('$fullname','$tower','$level','$capacity')");
        
        $error1 =  "INSERT INTO room ('roomname', 'buildingid', 'level', 'capacity') VALUES ('$fullname','$tower','$level','$capacity')";

        if(! $query ) {
            $error = "something wrong";   
            }
        else
        {
            header("Location: room_list.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection

}
?>