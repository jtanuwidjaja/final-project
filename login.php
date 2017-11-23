<?php
include("loginserv.php"); // Include loginserv for checking username and password
?>

<!doctype html>
<html>
<head>
	<title>Login to MRBS</title>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meeting Room Booking System</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="css/login.css">-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>

            input[type=text] {
            background-color: #F6B03F;
            color: black;
        }
        input[type=password] {
            background-color: #F6B03F;
            color: black;
        }

        #box{
            background-color: black;
        }

        .container{
            opacity: 0.9;
        }
        body{
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
             color:white;
            background: url(images/meeting_room1_003.jpg) no-repeat center top;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-size: 100%;
        }
    </style>
</head> 
    
<body>
  <div class="container">
        <div class="card-container" id="box">
            <form action="" method="post" onchange="checkform()">
                <h1>Login</h1> 
                <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control rq" id="user" name="user" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control rq"  id="pass" name="pass" placeholder="Enter password">
                </div>
<!--                <div class="g-recaptcha" data-sitekey="6Lc8jy8UAAAAAGJoA7zhGCTPqSSHtupk6YZj2iWn" style="display: inline-block"></div><br><br>-->
                <button type="submit" class="btn btn-primary" name="submit" id="signup" disabled>Submit</button>

                <!-- Error Message -->
                <br><br>
                <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
            </form>
            <a href="lostpass.php" class="forgot-password">
                Forgot the password?
            </a>
        </div>
    
    </div>
    
    
	 
    <script src="js/site.js" type="text/javascript"></script>
    
    
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>  

</body>
</html>