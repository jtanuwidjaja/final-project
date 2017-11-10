<?php
//Connection to the database
include("./includes/DB_connection.php");

if(isset($_POST['save'])){
    
    $userid=$_POST['userid'];
    $password=md5($_POST['password']);
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $branch=$_POST["campus"];
    $faculty=$_POST["faculty"];
    $return=$_POST["return"];
    
    $status= $_POST['status']; 
    $role = $_POST['role'];
    
    $query = mysqli_query($conn, "UPDATE `user` SET `password`='$password',`first_name`='$first_name',`last_name`='$last_name',`role`='$role',`phone`='$phone',`email`='$email',`gender`='$gender',`status`='$status',`facultyid`='$faculty',`branchid`='$branch' WHERE `login`='$userid'");
        
    if(! $query ) {
            $error = "Can't update user profile. Try again"; 
            }
    else
    {   
        if($return){
            header("Location: user.php");
        }
        else {
            header("Location: index.php"); // Redirecting to other page
        }        
            
    }
        
        
    mysqli_close($conn); // Closing connection  
}

if(isset($_POST['updatepass'])){
    $userid=$_POST['userid'];
    $old_password=md5($_POST['old_password']);
    $password=md5($_POST['password']);
    
    $query = mysqli_query($conn, "SELECT * FROM user WHERE `login`='$userid'");
    $row = $query->fetch_assoc();
    if ($row["password"] == $old_password) {
        $query = mysqli_query($conn, "UPDATE `user` SET `password`='$password' WHERE `login`='$userid'");
        header("Location: userinfo.php");
    }
    else {
        $error = "Your old password is incorrect";
    }

}
?>