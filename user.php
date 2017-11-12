<?php 
include("loginserv.php");
//here I am checking for session expiry
if ($_SESSION["role"] != "administrator") {
	//$_SESSION['msg'] = "You must log in first";
    header("location: login.php");
}

?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User - MRBS</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
<!--    <link href="css/style_old.css" rel="stylesheet">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!--    <script src="https://code.jquery.com/jquery-1.12.3.min.js"> </script>-->
    
<!--    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>-->
    
    
    
    
    
</head>
<body>

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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Booking<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="booking.php">Book room</a></li>';}
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
            <li class="active"><a href="user.php">User List</a></li>'; } ?>
            
                                                                                                
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
                <h1 class="page-header">User list
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Manatain user profiles and create new one. Only Administrator can create user with Administrator or Staff role</p>
            </div>
    </div>
       
       
    <?php
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM user");
                    
    echo '
        <form method=post action=update_service.php>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Password</th>
                        <th>Full name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
        echo '
                <tr>
                    <td>
                    '.$row["userid"].'
                    </td>
                    <td>
                    '.$row["password"].'
                    </td>
                    <td>
                    '.$row["username"].'
                    </td>
                    <td>
                    '.$row["role"].'
                    </td>
                    
                    ';
        if ($row["status"] == 0){  
                        echo '
                        <td style="text-align: center;">
                            <span class="glyphicon glyphicon-off" style="color: gray;"></span>
                        </td>';
        }
        else{
                        echo '
                        <td style="text-align: center;">
                            <span class="glyphicon glyphicon-off" style="color: green;"></span>
                        </td>';
        }
        echo '
                    <td>
                    '.$row["gender"].'
                    </td>
                    <td>
                    '.$row["age"].'
                    </td>
                    <td>
                    '.$row["phone"].'
                    </td>
                    <td>
                    '.$row["email"].'
                    </td>
                            
                    <td style="width:60px; text-align: center;">
                        <a href="userinfo.php?ID='.$row["userid"].'"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="delete_user.php?ID='.$row["userid"].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>';
            
    }
    echo "</tbody></table></form>"; //Close the table in HTML
    echo '<p><a href="registration.php">Create new user</a></p>';
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
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
    
</body>
</html>
