<?php
    include("loginserv.php");
    include("add_branchquery.php");
    if ($_SESSION["role"] != "0") {
    //$_SESSION['msg'] = "You must log in first";
    header("location: login.php");
}
    

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
     <?php include("./includes/navi_bar.php");?>
	<div id="wrap">
  
    
   <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Register a new branch
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Enter branch ID and branch name to complete registration</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Branch ID*</label>
                    <input type="text" class="form-control rq" id="branchid" name="branchid" placeholder="Enter Branch ID">
                </div>
                <div class="form-group col-lg-4">
                    <label>Branch Name*</label>
                    <input type="text" class="form-control rq"  id="branchname" name="branchname" placeholder="Enter Branch Name">
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
   </div>
    <?php include("./includes/footer.php");?>
    
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
