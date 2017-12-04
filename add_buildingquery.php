<?php
if(isset($_POST['register'])){
    
    $branchid=$_POST['branchdd'];
    $buildingname=$_POST['buildingname'];
    if(isset($_POST['buildingid'])){$buildingid=$_POST['buildingid'];}
    $buildingaddress=$_POST['buildingaddress'];
    $nlevel=$_POST['nlevel'];

    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        include "./includes/DB_connection.php";
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `building`(`branchid`, `buildingname`, `address`, `nlevel`) VALUES ('$branchid', '$buildingname', '$buildingaddress', '$nlevel')");
    

        if(! $query ) {
            $error = "Test";   
            }
        else
        {
            header("Location: building.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection
   
}
?>