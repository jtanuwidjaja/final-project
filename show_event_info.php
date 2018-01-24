<?php
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")&&($_SESSION["role"] != "2")) {
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
        $bookingquery = select_booking($id);

        $row = mysqli_fetch_array($bookingquery);

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
        <form action="update_booking.php" method="post" onchange="checkform()" role="form" class="check_rq_fields">
<!--        All fields for booking record card-->
            <?php include("booking_fields.php")?>	
            
            <input type="text" name="bookingid" hidden <?php echo 'value='.$id;?>>
            
            <div class="row col-lg-4">
                <button class="btn btn-primary" name="back" formaction="calendar.php">Back</button>
                <button type="submit" class="btn btn-primary" name="save" id="signup" disabled>Save</button>
                <button class="btn btn-primary" id="delete" <?php echo 'formaction="delete_booking.php?ID='.$id.'"'; ?>>Delete</button>'
                
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
                    $('select').prop('disabled', true);;
                    $('#delete').prop('disabled', true);";
            }
        ?>
//       function update_booking() {
//            var date = $("[name='date']").val();
//            var time_start = $("[name='time_start']").val();
//            var time_end = $("[name='time_end']").val();
//            var repeat = $("[name='repeat']").val();
//            var end_repeat = $("[name='end_repeat']").val();
//            var faculty = $("[name='faculty']").val();
//            var classname = $("[name='classname']").val();
//            var capacity = $("[name='capacity']").val();
//            var tutor = $("[name='tutor']").val();
//            var bookingid = $("[name='bookingid']").val();
//            var room = $("[name='room']").val();
//            var campus = $("[name='campus']").val();
//            
//            $.ajax({
//            url: 'update_booking.php',
//            data: 'date='+ date + '&time_start=' + time_start + '&time_end=' + time_end + '&repeat=' + repeat + '&end_repeat=' + end_repeat + '&faculty=' + faculty + '&classname=' + '&capacity=' + capacity + '&tutor' + tutor +'&bookingid=' + bookingid + '&room=' + room + '&campus=' + campus,
//            type: "POST",
////            success: function(json) {
////                    alert("Update successfully");
////            },
////            error: function(json) {
////                    alert("There is some connection problems. Please contact to your system administrator.");
////                    revertFunc();
////            },
//            }); 
//        }
//            
//        }
    </script>
    <script src="js/booking.js" type="text/javascript">
    </script>
</body>

    