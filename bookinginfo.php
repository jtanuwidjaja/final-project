<?php  
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")) {
        header("location: index.php");
    }
    include("./includes/DB_queries.php");
    
    //Receiving parameters from booking.php page
    $roomid = $_POST["roomid"];
    $date = $_POST["date"];
    $time_start = date('H:i:s',strtotime($_POST['time_start']));
    $time_end = date('H:i:s',strtotime($_POST['time_end'])); 
    $branch = $_POST['campus'];
    $faculty = $_POST['faculty'];
    $capacity = $_POST['capacity'];
    $repeat = $_POST['repeat'];
    $end_repeat = $_POST['end_repeat'];

    $tutorquery = get_tutor_list($faculty,$branch);
    
    $campusquery = get_branch_list();
    
    $facultyquery = get_faculty_list();

    $roomquery = get_room_list();
    
    //Waiting when book but will be clicked
    if(isset($_POST['book'])){
        
        $userid = $_SESSION['login'];
        
        //Receiving parameters from bookinginfo.php page
        
        $roomid = $_POST['room'];
        $date = $_POST['date'];
        $dateDB = $date[6].$date[7].$date[8].$date[9].'-'.$date[3].$date[4].'-'.$date[0].$date[1];
        $time_start = date('H:i:s',strtotime($_POST['time_start']));
        $time_end = date('H:i:s',strtotime($_POST['time_end'])); 
        $branch = $_POST['campus'];
        $faculty = $_POST['faculty'];
        $capacity = $_POST['capacity'];
        $classname = $_POST['classname'];
        $repeat = $_POST['repeat'];
        $end_repeat = $_POST['end_repeat'];
        $end_repeatDB = $end_repeat[6].$end_repeat[7].$end_repeat[8].$end_repeat[9].'-'.$end_repeat[3].$end_repeat[4].'-'.$end_repeat[0].$end_repeat[1];
        $tutor = $_POST['tutor'];
        
        
        if ($repeat > 0) {
        //Defining last repeat date for query
        $formated_date = date_create($dateDB);
        $formated_end_repeat = date_create($end_repeatDB);
        $interval = date_diff($formated_end_repeat, $formated_date); //end_date - date
        $days = $interval->format('%d'); //number of days between end_date and date
        $remainder = $days % $repeat;
        date_sub($formated_end_repeat, date_interval_create_from_date_string($remainder.' days')); //last date = end_date - remainder of (days/repeat)
        $last_repeat = $formated_end_repeat->format('Y-m-d');
    }
    else {
        $last_repeat = $dateDB;
        $end_repeatDB = $dateDB;
    }
        
        //check, that room with selected criteria is available 
        $query = check_room_availability(0,$roomid,$capacity,$branch,$faculty,$dateDB,$repeat,$last_repeat,$time_start,$time_end);
        
        $rows = mysqli_num_rows($query);
        
        //If classroom is available, then create booking record.
        if($rows == 1){
            //echo "laskdjlaksjd";
            $id = insert_booking($dateDB,$roomid,$time_start,$userid,$time_end,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor);
            
            header("Location: ./phpmailer/mail.php?ID=".$id.'&type=new');
        }
        else {
            $error = "Classroom can't be booked. Please, change booking parameters.";
        }
        
    }

?>

<!doctype HTML5>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking room</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link href="css/booking.css" rel="stylesheet">
    
</head>
<body>
    
    <!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>	
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Booking information
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Complete booking information</p>
            </div>
       </div>
        <form action="" method="post" onchange="checkform()" role="form" class="check_rq_fields">
<!--        All fields for booking record card-->
            <?php include("booking_fields.php")?>
            
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="book" id="signup" disabled>Book</button>
            </div>
            <div class="row col-lg-4">
                <label><?php echo $error; ?></label>
            </div>
        </form>
        
        
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script type="text/javascript" src="js/moment.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="js/bootstrap.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    
    <script src="js/booking.js" type="text/javascript">
    </script>
    
    <script>
        <?php if ($_SESSION["role"] != "0") echo "
        $('#role option:not(:selected)').prop('disabled', true);
        $('#status option:not(:selected)').prop('disabled', true);
        $('#campus option:not(:selected)').prop('disabled', true);
        $('#faculty option:not(:selected)').prop('disabled', true);
        ";?>
    </script>
    

</body>

    