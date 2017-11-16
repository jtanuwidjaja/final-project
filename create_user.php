<?php
//Connection to the database
include("./includes/DB_connection.php");

if(isset($_POST['register'])){
    
    $userid=$_POST['userid'];
    $password=md5($_POST['password']);
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $branch=$_POST["campus"];
    $faculty=$_POST["faculty"];
    
    $status= $_POST['status']; 
    $role = $_POST['role'];
    
    $query = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
    
    $rows = mysqli_num_rows($query);

    if($rows == 0){

        $query = mysqli_query($conn, "INSERT INTO `user`(`login`, `password`, `first_name`,`last_name`, `role`, `gender`, `phone`, `email`, `branchid`,`facultyid`, `status`) VALUES ('$userid','$password','$first_name','$last_name','$role','$gender','$phone','$email','$branch','$faculty','$status')");
        
        if(! $query ) {
            $error = "User name is already existed. Please, enter another User name";   
        }
        else{
            header("Location: user.php"); // Redirecting to other page
        }
    }
    else
        $error = "User with entered email already existed. Please change email address";
        
        
    mysqli_close($conn); // Closing connection
   
}
?>