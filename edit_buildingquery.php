<?php
if(isset($_POST['save'])){
    
    $branchid=$_POST['branchid'];
    $buildingid=$_POST['buildingid'];
    $buildingname=$_POST['buildingname'];
    $buildingaddress=$_POST['buildingaddress'];
    $nlevel=$_POST['nlevel'];
    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `building` SET `buildingname`='$buildingname', `buildingaddress`='$buildingaddress', `nlevel`='$nlevel' WHERE `buildingid`='$buildingid'");
        
        if(! $query ) {
            $error = "Can't update user profile. Try again";   
            }
        else
        {
            header("Location: building.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}


?>