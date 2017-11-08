<?php
if(isset($_POST['save'])){
    
    $roomid=$_POST['roomid'];
    $fullname=$_POST['fullname'];
    $tower=$_POST['tower'];
    $level=$_POST['level'];
    $room=$_POST['room'];
    $capacity=$_POST['capacity'];
 
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `tclass` SET `fullname`='$fullname',`fullname`='$fullname',`tower`='$tower',`level`='$level',`room`='$room',`capacity`='$capacity' WHERE `roomid`='$roomid'");
        
        if(! $query ) {
            $error = "Can't update user profile. Try again";   
            }
        else
        {
            header("Location: class_list.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}



?>