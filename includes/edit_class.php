<?php
if(isset($_POST['save'])){
    
    $roomid=$_POST['roomid'];
    $fullname=$_POST['roomname'];
    $tower=$_POST['towerdd'];
    $level=$_POST['leveldd'];
    $capacity=$_POST['capacity'];
 
    
        include ("includes/DB_connection.php");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `room` SET `roomname`='$fullname',`buildingid`='$tower',`level`='$level',`capacity`='$capacity' WHERE roomid='$roomid'");

        $some = "UPDATE `room` SET `roomname`='$fullname',`buildingid`='$tower',`level`='$level',`capacity`='$capacity' WHERE roomid='$roomid'";
     
        
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