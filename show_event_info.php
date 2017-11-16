<?php
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")) {
        header("location: index.php");
    }
    include("./includes/DB_queries.php");
    
    if (isset($_POST['id'])) {

        //fetching faculty for user with role "administrator" (role = 1)
        if ($_SESSION["role"] == "1") {
            $userid = $_SESSION["login"];
            $query = mysqli_query($conn, 
           "SELECT facultyid FROM user WHERE login = '$userid'");
            $row = mysqli_fetch_array($query);
            $userfaculty = $row['facultyid'];
        }

        $id = $_POST["id"];


        $query = select_booking($id);

        $row = mysqli_fetch_array($query);

        //Receiving parameters from booking.php page
        $roomid = $row['roomid'];
        $dateDB = $row["bookingdate"];
        $date = $dateDB[8].$dateDB[9].'/'.$dateDB[5].$dateDB[6].'/'.$dateDB[0].$dateDB[1].$dateDB[2].$dateDB[3];
        $time_start = date('H:i:s',strtotime($row['time_start']));
        $time_end = date('H:i:s',strtotime($row['time_end']));


        $branch = $row['branchid'];
        $faculty = $row['facultyid'];
        $capacity = $row['capacity'];
        $repeat = $row['bookingrepeat'];
        if ($repeat == 0) {
            $end_repeat = '';
        }
        else {
            $end_repeatDB = $row['end_repeat'];
            $end_repeat = $end_repeatDB[8].$end_repeatDB[9].'/'.$end_repeatDB[5].$end_repeatDB[6].'/'.$end_repeatDB[0].$end_repeatDB[1].$end_repeatDB[2].$end_repeatDB[3];;
        }
        $classname = $row['classname'];
        $tutor = $row['tutor'];



        $tutorquery = get_tutor_list($faculty,$branch);

        $campusquery = get_branch_list();

        $facultyquery = get_faculty_list();

        $roomquery = get_room_list();

        //Waiting when book but will be clicked
        if(isset($_POST['save'])){


            $userid = $_SESSION['login'];

            //Receiving parameters from bookinginfo.php page
            $id = $_POST['bookingid'];

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
           $query = check_room_availability($id,$roomid,$capacity,$branch,$faculty,$dateDB,$repeat,$last_repeat,$time_start,$time_end);

            $rows = mysqli_num_rows($query);

            //If classroom is available, then create booking record.
            if($rows == 1){

                $query = update_booking($dateDB,$time_start,$time_end,$roomid,$userid,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor,$id);

                header("Location: calendar.php");
            }
            else {
                $error = "Classroom can't be booked. Please, change booking parameters.";

            }

        }
    }
    else {
        header("location: calendar.php");
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
                <p>Change booking information</p>
            </div>
       </div>
        <form action="" method="post" onchange="checkform()" role="form" class="check_rq_fields">
<!--        All fields for booking record card-->
            <?php include("booking_fields.php")?>	
            
            <input type="text" name="bookingid" hidden <?php echo 'value='.$id;?>>
            
            <div class="row col-lg-4">
                <button class="btn btn-primary" name="back" onclick="goBack()">Back</button>
                <button type="submit" class="btn btn-primary" name="save" id="signup" disabled>Save</button>
                <?php 
                    echo '<button class="btn btn-primary" name="delete" onclick="delete_booking.php?ID='.$id.'">Delete</button>'
                ?>
                
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
    
    
    
    <script>
        <?php 
            if ($_SESSION["role"] != "0") {
                echo "
                $('#role option:not(:selected)').prop('disabled', true);
                $('#status option:not(:selected)').prop('disabled', true);
                $('#campus option:not(:selected)').prop('disabled', true);
                $('#faculty option:not(:selected)').prop('disabled', true);";
                if ($userfaculty != $faculty) 
                    echo "
                    $('input').prop('disabled', true);
                    $('select').prop('disabled', true);";
            }
        ?>
        function goBack() {
            window.history.back();
        }
    </script>
    <script src="js/booking.js" type="text/javascript">
    </script>
</body>

    