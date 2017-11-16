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
    
    <?php include "includes/navi_bar.php";?>
	
    
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
    
     <?php include "includes/footer.php";?>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      
    <script src="js/site.js" type="text/javascript"></script> 
    
    
</body>
</html>
