<?php 
include("loginserv.php");
//here I am checking for session expiry
if (($_SESSION["role"] != "staff")&&($_SESSION["role"] != "administrator")) {
	//$_SESSION['msg'] = "You must log in first";
    header("location: index.php");
}

?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking list - MRBS</title>
<!--    <link href="css/style_old.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!--    <script src="https://code.jquery.com/jquery-1.12.3.min.js"> </script>-->
    
<!--    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>-->
    
    
    
    
    
</head>
<body>
	
       <?include "includes/navi_bar.php";?>
    
    
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Booking list
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Mantain bookings or create new one. Only Staff can maintain bookings through the booking list</p>
            </div>
    </div>
       
       
    <?php
    $conn = mysqli_connect("localhost", "root", "root");
    //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM bookingrecord JOIN slot ON bookingrecord.slotid=slot.slotid JOIN meeting ON bookingrecord.meetingid=meeting.meetingid JOIN room ON bookingrecord.roomid=room.roomid JOIN user ON bookingrecord.userid=user.userid");
                    
    echo '
        <form>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Date</th>
                        <th>Meeting type</th>
                        <th>Room</th>
                        <th>Time slot</th>
                        <th>User login</th>
                        <th>User name</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
        echo '
                <tr>
                    <td>
                    '.$row["bookingid"].'
                    </td>
                    <td>
                    '.$row["date"].'
                    </td>
                    <td>
                    '.$row["meetingdesc"].'
                    </td>
                    <td>
                    '.$row["roomname"].'
                    </td>
                    <td>
                    '.$row["slotdesc"].'
                    </td>
                    <td>
                    '.$row["userid"].'
                    </td>
                    <td>
                    '.$row["username"].'
                    </td>
                    <td style="width:60px; text-align: center;">
                        <a href="delete_booking.php?ID='.$row["bookingid"].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>';
            
    }
    echo "</tbody></table></form>"; //Close the table in HTML
    echo '<p><a href="booking.php">Create new booking</a></p>';
    mysqli_close($conn); // Closing connection
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
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      
<!--    <script src="js/site.js" type="text/javascript"></script> -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
-->
<!--     IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>	-->

    
</body>
</html>
