<?php
require 'PHPMailerAutoload.php';

//Connection to the database
include("../includes/DB_connection.php");

$mail = new PHPMailer;

//$mail->SMTPDebug = 2;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'lavishmakeupsalon@gmail.com';                 // SMTP username
$mail->Password = 'Lavi$hPASS';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('info@Lavish.com', 'Aspire2 Classroom Allocation System');

//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$book_id=$_GET["ID"];

$type = $_GET["type"];

//get info about previous information, if type = update
if ($type == 'update' || $type == 'delete') {
    $roomid_old=$_GET["room"];
    //fetching room name
    $query = mysqli_query($conn, "SELECT roomname FROM room WHERE roomid='$roomid_old'");
    $row = mysqli_fetch_array($query);
    $roomname_old=$row['roomname'];

    $classname_old=$_GET["class"];
    $date_old=$_GET["date"];
    $time_start_old=$_GET["time_start"];
    $time_end_old=$_GET["time_end"];
    $repeat_old=$_GET["repeat"];
    $end_repeat_old=$_GET["end_repeat"];
    $capacity_old=$_GET["capacity"];

    $tutor_old=$_GET["tutor"];
    //fetching tutor name and email. Email need to send message about canceled class(type = Delete)
    $query = mysqli_query($conn, "SELECT first_name, last_name, email FROM user WHERE login='$tutor_old'");
    $row = mysqli_fetch_array($query);
    $first_name_old=$row['first_name'];
    $last_name_old=$row['last_name'];
    
    $email_old = $row['email'];
    


    $facultyid_old=$_GET["faculty"];
    //fetching faculty name
    $query = mysqli_query($conn, "SELECT facultyname FROM faculty WHERE facultyid='$facultyid_old'");
    $row = mysqli_fetch_array($query);
    $faculty_old=$row['facultyname'];
}

if ($type == 'update' || $type == 'new') {
    $query = mysqli_query($conn, "
        SELECT  user.email,
                user.first_name,
                user.last_name,
                room.roomname,
                faculty.facultyname,
                bookingrecord.classname,
                bookingrecord.bookingdate,
                bookingrecord.time_start,
                bookingrecord.time_end,
                bookingrecord.bookingrepeat,
                bookingrecord.end_repeat,
                bookingrecord.capacity
         FROM bookingrecord 
        JOIN room ON bookingrecord.roomid=room.roomid 
        JOIN user ON bookingrecord.tutor=user.login 
        JOIN faculty ON bookingrecord.facultyid=faculty.facultyid
        WHERE bookingid='$book_id'");
    $rows = mysqli_num_rows($query);
    if($rows == 1){ 
        $row = mysqli_fetch_array($query);
        $email = $row['email'];
        
    }
}
else { //type = Delete
    $email = $email_old;
}




 

    $mail->addAddress($email);     // Add a recipient
    $mail->Subject = 'Aspire2 - Changes in your timetable';
    switch ($type) {
        case 'update': {
            $mail->Body    = 
            '  <style>
                table {
                    border-collapse: collapse;
                        }

                table, th, td {
                    border: 1px solid black;
                    }
                </style>'.
            'Hi '.$row['first_name'].'!
            <br><br>
            Your class infromation has been updated<br><br>
            <table>
            <thead>
                <tr>
                    <th>Old/New</th>
                    <th>Room</th>
                    <th>Faculty</th>
                    <th>Class name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Repeat</th>
                    <th>End repeat</th>
                    <th>Tutor</th>
                    <th>Enrolments</th>
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td> Old information </td>
                    <td>'.$roomname_old.'</td>
                    <td>'.$faculty_old.'</td>
                    <td>'.$classname_old.'</td>
                    <td>'.$date_old.'</td>
                    <td>'.$time_start_old.'</td>
                    <td>'.$time_end_old.'</td>
                    <td>'.$repeat_old.'</td>
                    <td>'.$end_repeat_old.'</td>
                    <td>'.$first_name_old.' '.$last_name_old.'</td>
                    <td>'.$capacity_old.'</td>
                </tr>
                <tr>
                    <td> Updated information </td>
                    <td>'.$row['roomname'].'</td>
                    <td>'.$row['facultyname'].'</td>
                    <td>'.$row['classname'].'</td>
                    <td>'.$row['bookingdate'].'</td>
                    <td>'.$row['time_start'].'</td>
                    <td>'.$row['time_end'].'</td>
                    <td>'.$row['bookingrepeat'].'</td>
                    <td>'.$row['end_repeat'].'</td>
                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                    <td>'.$row['capacity'].'</td>
                </tr>
            </tbody>
            </table>
            <br> 
            You can check your timetable through the <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >system website</a>
            <br><br> 
            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
//            $mail->AltBody = 'Hi '.$row['first_name'].'!
//            <br><br>
//            Your class: <br>
//            Room: <b>'.$roomname_old.'</b> Faculty: <b>'.$faculty_old.'</b> Class: <b>'.$classname_old.'</b> at <b>'.$date_old.'</b> from <b>'.$time_start_old.'</b> till <b>'.$time_end_old.'</b> Repeat every <b>'.$repeat_old.'</b> day(s) until <b>'.$end_repeat_old.'</b> Tutor:<b>'.$first_name_old.' '.$last_name_old.'</b> Enrolments: <b>'.$capacity_old.'</b>
//            <br>
//            Has been changed on<br>
//            Room <b>'.$row['roomname'].'</b> Faculty: <b>'.$row['facultyname'].'</b> Class: <b>"'.$row['classname'].'"</b> at <b>'.$row['bookingdate'].'</b> from <b>'.$row['time_start'].'</b> till <b>'.$row['time_end'].'</b> Repeat every <b>'.$row['bookingrepeat'].'</b> day(s) until <b>'.$row['end_repeat'].'</b> Tutor:<b>'.$row['first_name'].' '.$row['last_name'].'</b> Enrolments: <b>'.$row['capacity'].'</b>
//            <br> 
//            You can check your timetable through the system <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >website</a>
//            <br><br> 
//            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
            break;
            }
        case 'new': {
            $mail->Body    = 
            '  <style>
                table {
                    border-collapse: collapse;
                        }

                table, th, td {
                    border: 1px solid black;
                    }
                </style>'.
            'Hi '.$row['first_name'].'!
            <br><br>
            You have the new class<br><br>
            <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Faculty</th>
                    <th>Class name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Repeat</th>
                    <th>End repeat</th>
                    <th>Tutor</th>
                    <th>Enrolments</th>
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td>'.$row['roomname'].'</td>
                    <td>'.$row['facultyname'].'</td>
                    <td>'.$row['classname'].'</td>
                    <td>'.$row['bookingdate'].'</td>
                    <td>'.$row['time_start'].'</td>
                    <td>'.$row['time_end'].'</td>
                    <td>'.$row['bookingrepeat'].'</td>
                    <td>'.$row['end_repeat'].'</td>
                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                    <td>'.$row['capacity'].'</td>
                </tr>
            </tbody>
            </table>
            <br> 
            You can check your timetable through the <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >system website</a>
            <br><br> 
            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
//        $mail->AltBody = 'Hi '.$row['first_name'].'!
//            <br><br>
//            You have the new class: <br>
//            Room <b>'.$row['roomname'].'</b> Faculty: <b>'.$row['facultyname'].'</b> Class: <b>"'.$row['classname'].'"</b> at <b>'.$row['bookingdate'].'</b> from <b>'.$row['time_start'].'</b> till <b>'.$row['time_end'].'</b> Repeat every <b>'.$row['bookingrepeat'].'</b> day(s) until <b>'.$row['end_repeat'].'</b> Tutor:<b>'.$row['first_name'].' '.$row['last_name'].'</b> Enrolments: <b>'.$row['capacity'].'</b>
//            <br> 
//            You can check your timetable through the system <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >website</a>
//            <br><br> 
//            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
            break;
            }
        case 'delete': {
            $mail->Body    = 
            '  <style>
                table {
                    border-collapse: collapse;
                        }

                table, th, td {
                    border: 1px solid black;
                    }
                </style>'.
            'Hi '.$first_name_old.'!
            <br><br>
            Your class has been canceled<br><br>
            <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Faculty</th>
                    <th>Class name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Repeat</th>
                    <th>End repeat</th>
                    <th>Tutor</th>
                    <th>Enrolments</th>
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td>'.$roomname_old.'</td>
                    <td>'.$faculty_old.'</td>
                    <td>'.$classname_old.'</td>
                    <td>'.$date_old.'</td>
                    <td>'.$time_start_old.'</td>
                    <td>'.$time_end_old.'</td>
                    <td>'.$repeat_old.'</td>
                    <td>'.$end_repeat_old.'</td>
                    <td>'.$first_name_old.' '.$last_name_old.'</td>
                    <td>'.$capacity_old.'</td>
                </tr>
            </tbody>
            </table>
            <br> 
            You can check your timetable through the <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >system website</a>
            <br><br> 
            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
//            $mail->AltBody = 'Hi '.$row['first_name'].'!
//            <br><br>
//            Your class has been canceled: <br>
//            Room: <b>'.$roomname_old.'</b> Faculty: <b>'.$faculty_old.'</b> Class: <b>'.$classname_old.'</b> at <b>'.$date_old.'</b> from <b>'.$time_start_old.'</b> till <b>'.$time_end_old.'</b> Repeat every <b>'.$repeat_old.'</b> day(s) until <b>'.$end_repeat_old.'</b> Tutor:<b>'.$first_name_old.' '.$last_name_old.'</b> Enrolments: <b>'.$capacity_old.'</b>
//            <br> 
//            You can check your timetable through the system <a href="http://localhost:8888/php/IP_project/cancel_booking.php" >website</a>
//            <br><br> 
//            Thanks,<br> Aspire2 Classroom Allocation System,<br>0080 0090 00';
            break;
            }
    }
        
    

//if(!$mail->send()) {
//    echo 'Message could not be sent.';
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'Message has been sent';
//}

    $mail->send();
    header("location: ../calendar.php");
                
//header("location: ../index.html");
                
                

            
mysqli_close($conn); // Closing connection



?>