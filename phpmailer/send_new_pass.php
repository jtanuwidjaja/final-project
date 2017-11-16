<?php
require 'PHPMailerAutoload.php';

if (isset($_POST['sendpass'])) {
    $email = $_POST['email'];
    $conn = mysqli_connect("localhost", "root", "root");
    //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $rows = mysqli_num_rows($query);

    if($rows == 1){
        $new_password = date('dmYHis');
        $row = $query->fetch_assoc();
        $userid = $row["userid"];
        
        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'lavishmakeupsalon@gmail.com';                 // SMTP username
        $mail->Password = 'Lavi$hPASS';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('info@Lavish.com', 'MRBS');

        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
                
        $mail->addAddress($row['email'], $row['username']);     // Add a recipient
        $mail->Subject = 'Forgot password';
        $mail->Body    = 'Hi '.$row['username'].'! <br><br> We received your request for setting new password for user account <b>'.$userid.'</b>. Your new password is <b>'.$new_password.'</b><br> You can login to Meeting Room Booking System with your new password through our <a href="http://localhost:8888/php/IP_project/index.php" >website</a><br><br> Thank you for trusting us and we are looking forward to seeing you soon.<br><br>Thanks,<br> Meeting Room Booking System support crew,<br>0080 0090 00';
        $mail->AltBody = '';


        $mail->send();
        
        $query = mysqli_query($conn, "UPDATE `user` SET `password`='$new_password' WHERE `userid`='$userid'");
        
        header("location: ./sendpass_confirm.php");
        
                             

    }
    else {
        $error = "There is no user with entered email";
    }
    
    mysqli_close($conn); // Closing connection
    
    
}



?>