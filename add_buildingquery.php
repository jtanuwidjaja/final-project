<?php
if(isset($_POST['register'])){
    
    $branchid=$_POST['branchid'];
    $buildingname=$_POST['buildingname'];
    $buildingid=$_POST['buildingid'];
    $buildingaddress=$_POST['buildingaddress'];
    $nlevel=$_POST['nlevel'];

    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        include "./includes/DB_connection.php";
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `building`(`branchid`, `buildingid`, `buildingname`, `address`, `nlevel`) VALUES ('$branchid', '$buildingid', '$buildingname', '$buildingaddress', '$nlevel')");
    

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