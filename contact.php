<?php
    include("loginserv.php");  
?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contact - MRBS</title>
    
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
            <li><a href="user.php">User List</a></li>'; } ?>
            
                                                                                                
            <li class="active"><a href="contact.php">Contact us</a></li>
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
                <h1 class="page-header">About us
                    <small>We are always ready to help you</small>
                </h1>
                <p>If you have any issues and questions about the Meeting Room Booking System, contact us by email or phone call. We will happy to answer on your questions!</p>
            </div>
    </div>
    
    <!-- Team Members Row -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="./images/Andrey.jpg" alt="">
                <h3>Andrey Dementyev
                    <small>IT Specialist</small>
                </h3>
                <p>If there is any trouble, call to me</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <img class="img-circle img-responsive img-center" src="./images/Jess.jpg" width="100%" alt="">
                <h3>Jessica Putri
                    <small>IT Specialist</small>
                </h3>
                <p>I will help with any issues and will provide to you all necessary information about our system!</p>
            </div>
        
       </div>
		
    <div class="row">
        <div class="col-lg-12">
                <h2 class="page-header">Our contact information</h2>
            </div>
    <!-- AIzaSyDYZnUY4ENtpMktD3G5qtFvWM3E-->
        <div class="col-lg-4 col-sm-6 text-center">   
            <div id="map" style="width: 400px; height: 300px;"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYZnUY4ENtpMktD3G5qtFvWM3E-oTURpo&callback=initMap"
    async defer></script>
        </div>
        <div class="col-lg-4 col-sm-6 text-center">     
            <div id="address">
            <h3>Address</h3>
            <p>20 Hobson Street, Auckland</p>
            <h3>Contact Number</h3>
            <p>0080 0090 00</p>
            </div>
        </div>
    </div>
        
	
  
    </div>
    <br><br><br><br><br><br>
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
      
    <script src="js/site.js" type="text/javascript"></script> 
    
    
</body>
</html>
