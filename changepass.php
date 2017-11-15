<?php
    include("loginserv.php");
    include("edit_user.php");
    
?>


<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Personal information - MRBS</title>
	     <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    
	 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	
        <!-- Static navbar -->
    <?php include("./includes/navi_bar.php")?>
	
    
   
       
    
        <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Change password
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>To change password please enter your old password</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Username*</label>
                    <input type="text" class="form-control rq" id="userid" name="userid" placeholder="Enter username" readonly <?php echo 'value='.$_SESSION["userid"]; ?>>
                </div>
           </div>
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label>Old Password</label>
                    <input type="password" class="form-control rq"  id="passsword" name="old_password" placeholder="Enter password">
                </div>
            </div>   
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label>New Password</label>
                    <input type="password" class="form-control rq"  id="passsword" name="password" placeholder="Enter password">
                </div>
            </div>
            
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="updatepass" id="signup" disabled>Update</button>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
        </form>
       </div>    
        
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
