<?php
if(isset($_POST['create'])){
    
    
    
    $branchname=$_POST["branchname"];
    $level = $_POST["nlevel"];
    $roomid =$_POST["roomid"];
    $buildingname = $_POST["buildingname"];
    $fullname = $_POST["fullname"];
    $faculty = $_POST["faculty"];
    
        include("includes/DB_connection.php");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `building`.`tclass` (`branchname`, `level`, `fullname`, `faculty`, `roomid`) VALUES ('" . mysql_real_escape_string($branchname) . "','" . mysql_real_escape_string($level) . "','" . mysql_real_escape_string($fullname) . "','" . mysql_real_escape_string($faculty) . "', '". mysql_real_escape_string($roomid). "')");
        
        if(! $query ) {
            $error = "User name is already existed. Please, enter another User name";   
            }
        else
        {
            header("Location: login.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection
   
}
?>