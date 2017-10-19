<?php
if(isset($_POST['register'])){
    
    $userid=$_POST['userid'];
    $password=$_POST['password'];
    $username=$_POST['username'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    
    $status= $_POST['status']; 
    $role = $_POST['role'];
    
    
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO `user`(`userid`, `password`, `username`, `role`, `age`, `phone`, `email`, `gender`, `status`) VALUES ('$userid','$password','$username','$role','$age','$phone','$email','$gender','$status')");
        
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