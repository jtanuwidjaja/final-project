<?php
session_start();
$error=''; //Variable to Store error message;
$conf=''; //Variable for confirmation of registration
if(isset($_POST['submit'])){
//    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
//{
//     //your site secret key
//    $secret = '6Lc8jy8UAAAAAE9BiMpCt-v1kXv-ZZ3Yxq2KGLH1';
//    
//    //get verify response data
//    $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
//    
//    //getting JSON
//    $response = json_decode($verify);
//    
//    
//    if($response->success)
//    {
        if(empty($_POST['user']) || empty($_POST['pass'])){
        $error = "Username or Password is Invalid";
        }
        else
        {
            //Define $user and $pass
            $user=$_POST['user'];
            $pass=md5($_POST['pass']);
            
            
            //Connection to the database
            include("./includes/DB_connection.php");
            
            $query = mysqli_query($conn, "SELECT * FROM user WHERE password='$pass' AND login='$user' AND status = 1");
            $rows = mysqli_num_rows($query);

            if($rows == 1){   
                
                $row = $query->fetch_assoc();
                $_SESSION["name"] = $row["first_name"].' '.$row["last_name"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["login"] = $row["login"];
                header("Location: calendar.php"); 
                   
            }
            else
            {
                $error = "Username or Password is Invalid. Or your user account is disabled.";
            }
            mysqli_close($conn); // Closing connection
    }
 
 
//    }
//    else
//    {
//        $error = "Google reCAPTCHA verification failed. please try again";
//    }
//}
//else
//{
//    $error ="Please check recaptcha box";
//}
    
    
}
