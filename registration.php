<?php
    include("loginserv.php");
    include("create_user.php");

?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration - MRBS</title>
    
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
            
                                                                                                
            <li><a href="contact.php">Contact us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION["name"])) { echo '
            <li><a href="userinfo.php?ID='.$_SESSION["userid"].'">'.$_SESSION["name"].'</a></li>
            <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>'; }
            else {
                echo '
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <li class="active"><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>'; }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
   <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Registration
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Enter information about you to register in MSBS. Registered user can access to Booking functionallity.</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Username*</label>
                    <input type="text" class="form-control rq" id="userid" name="userid" placeholder="Enter username">
                </div>
                <div class="form-group col-lg-4">
                    <label>Password*</label>
                    <input type="password" class="form-control rq"  id="passsword" name="password" placeholder="Enter password">
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Full name*</label>
                    <input type="text" class="form-control rq" id="username" name="username" placeholder="Enter your full name">
                </div>
            </div>
            <div class="row" <?php if ($_SESSION["role"] != "administrator") echo 'style="display:none;"';?>>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] != "administrator") echo 'style="display:none;"';?>>
                    <label >Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="customer">Customer</option>
                        <option value="staff">Staff</option>
                        <option value="administrator">Administrator</option>
                    </select>
                </div>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] != "administrator") echo 'style="display:none;"';?>>
                    <label >Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="Enter your age">
                </div>
                <div class="form-group col-lg-4">
                    <label >Gender*</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Phone*</label>
                    <input type="text" class="form-control rq" id="phone" name="phone" placeholder="Enter phonenumber" pattern='0{1}[0-9]{9}'>
                </div>
                <div class="form-group col-lg-4">
                    <label >Email*</label>
                    <input type="email" class="form-control rq" id="email" name="email" placeholder="Enter username">
                </div>
            </div>
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="register" id="signup" disabled>Register</button>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
        </form>
       </div>
     <br><br><br><br><br><br> <br><br><br><br><br><br><br><br><br>
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
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>	
    
</body>
</html>