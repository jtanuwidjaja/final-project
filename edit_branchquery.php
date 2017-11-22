<?php
if(isset($_POST['save'])){
    
    $branchid=$_POST['branchid'];
    $branchname=$_POST['branchname'];
    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `branch` SET `branchname`='$branchname' WHERE `branchid`='$branchid'");
        
        if(! $query ) {
            $error = "Can't update user profile. Try again";   
            }
        else
        {
            header("Location: branch.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}


?>