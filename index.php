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

<?php include "includes/navi_bar.php";?>
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

<?php include "includes/footer.php";?>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
