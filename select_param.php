<?php
include("loginserv.php");
session_start();
//$_SESSION['hide_step2'] = true;
//$_SESSION['hide_step3'] = true;
$hide_step2 = true;
$hide_step3 = true;
    
if(isset($_POST['step1'])){
    //$_SESSION['hide_step2'] = false;
    $hide_step2 = false;
    $date=$_POST['adate'];
    $_SESSION['date'] = $date;
    $service=$_POST['service'];
    $_SESSION['serv']=$service;
    $artist = array();
    
        
        //Establishing Connection with server by passing server_name, user_id and pass as a parameter
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "SELECT room.roomid FROM room LEFT JOIN bookingrecord ON room.roomid=bookingrecord.roomid GROUP BY room.roomid HAVING COUNT(IF(bookingrecord.date = '$date',1,NULL))<9");
    
    while ($row = $query->fetch_assoc()) {
        $artist[] = $row["roomid"];
    }
    $_SESSION['artists']=$artist;
//SELECT Artists.artist_id FROM Artists LEFT JOIN bookings ON Artists.artist_id=bookings.artist_id GROUP BY Artists.artist_id HAVING COUNT(IF(bookings.date = '2017-09-11',1,NULL))<9
        //header ("Location: booking.php");
            
    


       
    mysqli_close($conn); // Closing connection
   
    }
if(isset($_POST['step2'])) {
//    $_SESSION['hide_step2'] = false;
//    $_SESSION['hide_step3'] = false;
    $hide_step2 = false;
    $hide_step3 = false;
    $artist_id=$_POST['artist'];
    $_SESSION['art_id'] = $artist_id;
    $slot = array();
    $d = $_SESSION['date'];
    
    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
    
    $query = mysqli_query($conn, "SELECT slotid FROM bookingrecord WHERE roomid='$artist_id' AND date='$d'");
    
    while ($row = $query->fetch_assoc()) {
        $slot[] = $row["slotid"];
    }
    
    $_SESSION['bslots']=$slot;
    
    mysqli_close($conn); // Closing connection
   
}

if(isset($_POST['step3'])) {
    $s=$_POST['slot'];
    $_SESSION['slot_id']=$s;
    $_SESSION['session']= true;
    

    $artist=$_SESSION['art_id'];
    $slot=$_SESSION['slot_id'];
    $date=$_SESSION['date'];
    $service=$_SESSION['serv'];
    
    $customer_id=$_SESSION["userid"];
    
    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
        //sql query to fetch information of registerd user and finds user match.
    
    
    
    mysqli_query($conn, "INSERT INTO `bookingrecord`(`roomid`, `userid`, `slotid`, `meetingid`, `date`) VALUES ('$artist','$customer_id','$slot','$service','$date')");

    $book_id = mysqli_insert_id($conn);
  
    mysqli_close($conn); // Closing connection
    
    unset($_SESSION['date']);
    unset($_SESSION['serv']);
    unset($_SESSION['artists']);
    unset($_SESSION['art_id']);
    //unset($_SESSION['session']);
    unset($_SESSION['date']);
    unset($_SESSION['slot_id']);
    unset($_SESSION['bslots']);
    
    
    
    //session_destroy();
    
    header("location: ./PHPMailer/mail.php?ID=".$book_id);
    
    //header("location: confirmation.php?book=".$book_id);
    
}

?>