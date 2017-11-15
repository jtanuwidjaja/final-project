<?php
    include("select_param.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking - MRBS</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
	<link rel="stylesheet" type="text/css" href="css/style_old.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
	<!-- Static navbar -->
   <?php include("./includes/navi_bar.php")?>
    
    <div id="body">
		<div id="roundheader">
			<img src="images/MRBSicon.png" alt="">
		</div>
        
        <div id="customer_contact">
            <h1>Your booking is now confirmed</h1>
            <h2>Your booking ID is <?php echo $_GET["book"]?></h2>
        
        
            <p> <br><br><br>A confirmation email will be sent to your email address shortly.<br>
            To manage your booking contact us through call to hte contact information provided<br>
            To cancel your booikng you can cancel it through our website<br>
                Thank you for trusting us and we are looking forward to seeing you soon.
                <br><br><br>
            </p>
            <form>
                <input type="submit" formaction="index.php" value="Ok">
            </form>
        </div>

    </div>
    
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
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
        
        <script src="js/site.js" type="text/javascript"></script>
    
</body>
</html>
