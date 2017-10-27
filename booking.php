<?php
    include("loginserv.php");
    include("select_param.php");
?>

<!doctype HTML5>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking room</title>
    
<!--    <link rel="stylesheet" type="text/css" href="css/style.css">-->
	
<!--    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
<!--	<link rel="stylesheet" type="text/css" href="css/style_old.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
    
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <link href="css/booking.css" rel="stylesheet">
    
    
</head>
<body>
	    <!-- Static navbar -->
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="images/MRBSicon.png" width="100px" height="25px" alt="">
          </a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            
            <?php if (isset ($_SESSION["role"])) { echo '
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Booking<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="booking.php">Book room</a></li>';}
                if (($_SESSION["role"] == "staff")||($_SESSION["role"] == "administrator")){
            echo '
                <li><a href="booking_list.php">Booking list</a></li>'; }
                if (isset ($_SESSION["role"])) { echo '                 
                <li role="separator" class="divider"></li>
                <li><a href="cancel_booking.php">Cancel booking</a></li>
              </ul>
            </li>'; } ?>
            <?php if ($_SESSION["role"] == "administrator"){
            echo '
            <li><a href="user.php">User List</a></li>'; } ?>
            
                                                                                                
            <li><a href="contact.php">Contact us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION["name"])) { echo '
            <li><a href="userinfo.php?ID='.$_SESSION["userid"].'">'.$_SESSION["name"].'</a></li>
            <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>'; }
            else {
                echo '
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>'; }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
	
    <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Book the Room
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>For booking the room select creteria and choose the room</p>
            </div>
       </div>
    
        
        
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-lg-4 col-md-4">
                    <label >Date</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control" name="date" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time from</label>
                    <div class='input-group date' id="timepickerfrom">
                        <input type='text' class="form-control" name="time_start"/>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time to</label>
                    <div class='input-group date' id="timepickerto">
                    <input type='text' class="form-control" name="time_end"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-2">
                    <div class="input-group spinner">
                        <label >Number of student</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="12" name="capacity">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Faculty</label>
                    <select class="form-control" name="faculty">
                        <option value="1">IT</option>
                        <option value="2">Business</option>
                        <option value="3">Hospitaly</option>
                        <option value="4">Health</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Campus</label>
                    <select class="form-control" name="campus">
                        <option value="1">Auckland</option>
                        <option value="2">Tauranga</option>
                        <option value="3">Wellington</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Repeat</label>
                    <select class="form-control" name="repeat">
                        <option value="day">Every Day</option>
                        <option value="week">Every Week</option>
                        <option value="fortnight">Every Fortnight</option>
                        <option value="month">Every Month</option>
                        <option value="year">Every Year</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4">
                    <label >End Repeat</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
            </div>

            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="search" id="signup" disabled>Search</button>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
        </form>
  
    <?php
    
    if(isset($_POST['search'])){
        $conn = mysqli_connect("localhost", "root", "root");
        //Selecting Database
        $db = mysqli_select_db($conn, "RoomAllocation");
        //sql query to fetch information of registerd user and finds user match.
        
        $in = $_POST['date'];
        $date = $in[6].$in[7].$in[8].$in[9].'-'.$in[3].$in[4].'-'.$in[0].$in[1];
        $time_start = date('H:i:s',strtotime($_POST['time_start']));
        $time_end = date('H:i:s',strtotime($_POST['time_end'])); 
        $branch = $_POST['campus'];
        $faculty = $_POST['faculty'];
        $capacity = $_POST['capacity'];
        
        $query = mysqli_query($conn, 
        "SELECT * FROM room 
        JOIN building ON room.buildingid=building.buildingid
        LEFT JOIN restriction ON room.roomid=restriction.roomid
        WHERE 
        room.capacity >= '$capacity' AND
        building.branchid = '$branch' AND
        (restriction.facultyid = '$faculty' OR restriction.facultyid IS NULL) AND
        room.roomid NOT IN 
        (SELECT DISTINCT roomid FROM bookingrecord WHERE date = '$date' AND time_start < '$time_end' AND time_end > '$time_start')");
    
//SELECT * FROM room 
//JOIN building ON room.buildingid=building.buildingid
//LEFT JOIN restriction ON room.roomid=restriction.roomid
//WHERE 
//room.capacity >= '10' AND
//building.branchid = '1' AND
//(restriction.facultyid = '1' OR restriction.facultyid IS NULL) AND
//room.roomid NOT IN 
//(SELECT DISTINCT roomid FROM bookingrecord WHERE date = '2017-10-27' AND time_start < '16:00:00' AND time_end > '13:00:00')
//    
        echo '
        <form>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
        echo '
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Building</th>
                        <th>Level</th>
                        <th>Capacity</th>
                        <th>Acessibility</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = mysqli_fetch_array($query)){          
            $roomid = $row["roomid"];
            $query2 = mysqli_query($conn,
            "SELECT faculty.facultyname FROM restriction JOIN faculty ON restriction.facultyid = faculty.facultyid WHERE restriction.roomid = '$roomid'");
        
        
            echo '
                <tr>
                    <td>
                    '.$row["roomname"].'
                    </td>
                    <td>
                    '.$row["buildingname"].'
                    </td>
                    <td>
                    '.$row["level"].'
                    </td>
                    <td>
                    '.$row["capacity"].'
                    </td>
                    <td>';
            while($faculty = mysqli_fetch_array($query2)) {
            
                echo    $faculty["facultyname"].' ';
            }
                    
            echo   '</td>
                    <td style="width:60px; text-align: center;">
                        <a href="create_booking.php?ID='.$row["roomid"].'&data='.$date.'&time_start='.$time_start.'time_finish='.$time_end.'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                    </tr>';
            
        }
        echo "</tbody></table></form>"; //Close the table in HTML
        echo '<p><a href="booking.php">Create new booking</a></p>';
        mysqli_close($conn); // Closing connection
    
}
                    
    
    ?>
      
</div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"> </script>
    
    <script> 
        
        $(document).ready(function() {
            $('#usertable').DataTable();
        } );
    
    
    </script>
        
        

    
    <br><br><br><br><br><br><br><br><br><br><br><br>
	<footer id="myFooter">
        
        <br>
        <div class="text-center">
        <p>Find us in social networks<p>
        <a onclick="" class="btn btn-social-icon btn-lg btn-facebook"><i class="fa fa-facebook"></i></a>
        <a onclick="" class="btn btn-social-icon btn-lg btn-instagram"><i class="fa fa-instagram"></i></a>
        <a onclick="" class="btn btn-social-icon btn-lg btn-linkedin"><i class="fa fa-linkedin"></i></a>
    </div>
        <div class="footer-copyright">
            <p>© 2017 Copyright Andrey Dementyev</p>
        </div>
        
        
    </footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <script type="text/javascript" src="js/moment.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="js/bootstrap.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/site.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(function () {
            $('#timepickerfrom').datetimepicker({
                format: 'LT',
                stepping: 30,
                
            });
            $('#timepickerto').datetimepicker({
                format: 'LT',
                stepping: 30,
                useCurrent: false //Important! See issue #1075
                
            });
            $("#timepickerfrom").on("dp.change", function (e) {
                $('#timepickerto').data("DateTimePicker").minDate(e.date);
            });
            $("#timepickerto").on("dp.change", function (e) {
                $('#timepickerfrom').data("DateTimePicker").maxDate(e.date);
            });
        
            $('.datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            
            $('.spinner .btn:first-of-type').on('click', function() {
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
            });
            $('.spinner .btn:last-of-type').on('click', function() {
            $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
  });
            
        });
    </script>
        
</body>
</html>
