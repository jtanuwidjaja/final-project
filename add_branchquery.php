<?php
if(isset($_POST['register'])){
    
    $branchname=$_POST['branchname'];

    
        include "./includes/DB_connection.php";
                //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `branch`(`branchname`) VALUES ('$branchname')");
        
        if(! $query ) {
            $error = "User name is already existed. Please, enter another User name";   
            }
        else
        {
            header("Location: branch.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection
   
}
?>