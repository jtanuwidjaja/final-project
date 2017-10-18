<?php
    include("loginserv.php");
    if (isset($_GET['logout'])) {
	   session_destroy();
	   unset($_SESSION['user']);
        unset($_SESSION['role']);
	   header("location: index.php");
}
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meeting Room Booking System</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
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
            <li class="active"><a href="index.php">Home</a></li>
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
    
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/meeting_room1.jpg" width="100%" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="images/meeting_room2.jpg" width="100%" alt="Chicago">
    </div>

    <div class="item">
      <img src="images/meeting_room3.jpg" width="100%" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        <div><br></div>

    

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Meeting Room Booking System</h1>
        <p>This is online meeting room booking system for all office staff. Any Meeting room can be booked through this system. </p>
        <?php if (!isset($_SESSION["name"])) {
                echo '
            <p>Please, login to book the meeting room. If have no login, please, pass quick registration.</p>
            <p>
            <a class="btn btn-lg btn-primary" href="login.php" role="button">Login</a>
            <span> </span><a class="btn btn-lg btn-primary" href="registration.php" role="button">Register</a>
            </p>';} ?>
      </div>

    </div> <!-- /container -->

    
    

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
