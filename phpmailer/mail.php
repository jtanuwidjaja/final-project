<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'lavishmakeupsalon@gmail.com';                 // SMTP username
$mail->Password = 'Lavi$hPASS';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('info@Lavish.com', 'Lavish');

//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$book_id=$_GET["ID"];

$conn = mysqli_connect("localhost", "root", "root");
                //Selecting Database
                $db = mysqli_select_db($conn, "MRBS");
                //sql query to fetch information of registerd user and finds user match.
                $query = mysqli_query($conn, "SELECT * FROM bookingrecord JOIN slot ON bookingrecord.slotid=slot.slotid JOIN meeting ON bookingrecord.meetingid=meeting.meetingid JOIN room ON bookingrecord.roomid=room.roomid JOIN user ON bookingrecord.userid=user.userid WHERE bookingid='$book_id'");
            $rows = mysqli_num_rows($query);

            if($rows == 1){   
                
                $row = $query->fetch_assoc();
                
                $mail->addAddress($row['email'], $row['username']);     // Add a recipient
                $mail->Subject = 'MRBS Booking confirmation';
                $mail->Body    = 'Hi '.$row['username'].'! <br><br> We received your booking for <b>'.$row['date'].'</b> at <b>'.$row['slotdesc'].'</b>. Your booking ID is <b>'.$book_id.'</b><br> You can cancel your booking through our <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >website</a><br><br> Thank you for trusting us and we are looking forward to seeing you soon.<br><br>Thanks,<br> Lavish Makeup salon,<br>0080 0090 00';
                $mail->AltBody = '';

//if(!$mail->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}

                $mail->send();
                header("location: ../confirmation.php?book=".$book_id);
//header("location: ../index.html");
                
                
            }
            
            mysqli_close($conn); // Closing connection



?>