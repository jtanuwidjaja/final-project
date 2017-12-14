<?php
if(isset($_POST['register'])){
    
    $facultyname=$_POST['facultyname'];

    
        include "./includes/DB_connection.php";
                //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `faculty`(`facultyname`) VALUES ('$facultyname')");
        
        if(! $query ) {
            $error = "User name is already existed. Please, enter another User name";   
            }
        else
        {
            header("Location: faculty.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection
   
}
?>