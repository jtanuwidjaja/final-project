<?php  
    //Connection to the database
    include("./includes/DB_connection.php");
    
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
    
    $campusquery = mysqli_query($conn, 
       "SELECT * FROM branch");
    
    $facultyquery = mysqli_query($conn, 
       "SELECT * FROM faculty");

    $roomquery = mysqli_query($conn, 
       "SELECT * FROM room");
    
    //Waiting when book but will be clicked
    if(isset($_POST['book'])){
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
        $end_repeat = $dateDB;
    }
        
        //check, that room with selected criteria is available 
        $query = mysqli_query($conn, 
        "SELECT * FROM room 
        JOIN building ON room.buildingid=building.buildingid
        LEFT JOIN restriction ON room.roomid=restriction.roomid
        WHERE
        room.roomid = '$roomid' AND
        room.capacity >= '$capacity' AND
        building.branchid = '$branch' AND
        (restriction.facultyid = '$faculty' OR restriction.facultyid IS NULL) AND
        room.roomid NOT IN 
        (
            SELECT DISTINCT roomid FROM bookingrecord 
			WHERE
            (
                DATEDIFF(bookingdate, '$last_repeat') <= 0 AND 
                (
                    DATEDIFF(DATE_SUB(end_repeat, INTERVAL (MOD(DATEDIFF(end_repeat, bookingdate),bookingrepeat)) DAY)
                             , '$dateDB') >= 0 OR
                    DATEDIFF(DATE_SUB(end_repeat, INTERVAL (MOD(DATEDIFF(end_repeat, bookingdate),bookingrepeat)) DAY)
                             , '$dateDB') IS NULL
                )
    		) AND
            (
        		MOD(DATEDIFF(bookingdate, '$dateDB'),LEAST(bookingrepeat,$repeat)) = 0 OR MOD(DATEDIFF('$dateDB', bookingdate),LEAST(bookingrepeat,$repeat)) is NULL
    		) AND  
    		time_start < '$time_end' AND time_end > '$time_start'
        )");
        
        $rows = mysqli_num_rows($query);
        
        //If classroom is available, then create booking record.
        if($rows == 1){
            $query = mysqli_query($conn, 
            "INSERT INTO `bookingrecord`(`bookingdate`, `roomid`, `time_start`, `userid`, `time_end`, `facultyid`, `classname`, `capacity`, `bookingrepeat`, `end_repeat`) VALUES ('$dateDB','$roomid','$time_start','1','$time_end','$faculty','$classname','$capacity','$repeat','$end_repeatDB')");
            
            header("Location: index.php");
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
        <form action="" method="post" onchange="checkform()" role="form">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Room</label>
                    <select class="form-control" name="room">
                        <?php 
                            while($row = mysqli_fetch_array($roomquery)){
                                
                                echo '<option value="'.$row["roomid"].'"';
                                if ($row["roomid"] == $roomid) {
                                    echo ' selected';
                                }
                                echo '>'.$row["roomname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Campus</label>
                    <select class="form-control" name="campus">
                        <?php 
                            while($row = mysqli_fetch_array($campusquery)){
                                
                                echo '<option value="'.$row["branchid"].'"';
                                if ($row["branchid"] == $branch) {
                                    echo ' selected';
                                }
                                echo '>'.$row["branchname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4 col-md-4">
                    <label >Date</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control rq" name="date" <?php echo 'value='.$date; ?>/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time from</label>
                    <div class='input-group date' id="timepickerfrom">
                        <input type='text' class="form-control rq" name="time_start" <?php echo 'value="'.$time_start.'"'; ?>/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time to</label>
                    <div class='input-group date' id="timepickerto">
                    <input type='text' class="form-control rq" name="time_end" <?php echo 'value="'.$time_end.'"'; ?>/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Repeat</label>
                    <select class="form-control" name="repeat" id="repeat">
                        <option value="0" <?php if($repeat == 0) echo 'selected';?>>Never</option>
                        <option value="1" <?php if($repeat == 1) echo 'selected';?>>Every Day</option>
                        <option value="7" <?php if($repeat == 7) echo 'selected';?>>Every Week</option>
                        <option value="14" <?php if($repeat == 14) echo 'selected';?>>Every Fortnight</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4">
                    <label >End Repeat</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control" name="end_repeat" id="end_repeat" <?php echo 'value="'.$end_repeat.'"'; ?>>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Faculty</label>
                    <select class="form-control" name="faculty">
                        <?php 
                            while($row = mysqli_fetch_array($facultyquery)){
                                echo '<option value="'.$row["facultyid"].'"';
                                if ($row["facultyid"] == $faculty) {
                                    echo ' selected';
                                }
                                echo '>'.$row["facultyname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label >Class Name</label>
                    <input type="text" class="form-control rq" id="userid" name="classname" placeholder="Enter class name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-2">
                    <div class="input-group spinner">
                        <label >Enrolments</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control rq" <?php echo 'value="'.$capacity.'"';?> name="capacity">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label >Trainer</label>
                    <input type="text" class="form-control rq" name="tutor" placeholder="Enter tutor name">
                </div>
            </div>
            
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
    <script src="js/site.js" type="text/javascript"></script>
    
    <script src="js/booking.js" type="text/javascript">
    </script>
    

</body>

    