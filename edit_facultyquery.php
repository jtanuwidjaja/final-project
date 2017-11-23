<?php
if(isset($_POST['save'])){
    
    $facultyid=$_POST['facultyid'];
    $facultyname=$_POST['facultyname'];
    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `faculty` SET `facultyname`='$facultyname' WHERE `facultyid`='$facultyid'");
        
        if(! $query ) {
            $error = "Can't update user profile. Try again";   
            }
        else
        {
            header("Location: faculty.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}


?>