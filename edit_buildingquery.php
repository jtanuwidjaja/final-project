<?php
if(isset($_POST['save'])){
    
    $branchid=$_POST['branchid'];
    $buildingid=$_POST['buildingid'];
    $buildingname=$_POST['buildingname'];
    $buildingaddress=$_POST['address'];
    $nlevel=$_POST['nlevel'];
            
    
        include "./includes/DB_connection.php";
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `building` SET `buildingname`='$buildingname', `address`='$buildingaddress', `nlevel`='$nlevel' WHERE `buildingid`='$buildingid'");


        
        if(! $query ) {
            $error = "Can't update it. Try again";   
            }
        else
        {
            header("Location: building.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}


?>