<?php
if(isset($_POST['save'])){
    
    $userid=$_POST['userid'];
    $password=$_POST['password'];
    $username=$_POST['username'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    
    $status= $_POST['status']; 
    $role = $_POST['role'];
    
    
        include("includes/DB_connection.php");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "UPDATE `user` SET `password`='$password',`username`='$username',`role`='$role',`age`='$age',`phone`='$phone',`email`='$email',`gender`='$gender',`status`='$status' WHERE `userid`='$userid'");
        
        if(! $query ) {
            $error = "Can't update user profile. Try again";   
            }
        else
        {
            header("Location: index.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection  
}

if(isset($_POST['updatepass'])){
    $userid=$_POST['userid'];
    $old_password=$_POST['old_password'];
    $password=$_POST['password'];
    
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    
    $query = mysqli_query($conn, "SELECT * FROM user WHERE `userid`='$userid'");
    $row = $query->fetch_assoc();
    if ($row["password"] == $old_password) {
        $query = mysqli_query($conn, "UPDATE `user` SET `password`='$password' WHERE `userid`='$userid'");
        header("Location: userinfo.php");
    }
    else {
        $error = "Your old password is incorrect";
    }

}
?>