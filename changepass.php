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
    <?php include "includes/navi_bar.php";?> 
    <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Change password
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>To change password please enter your old password</p>
            </div>
       </div>
       
    
        <form action="" method="post" role="form" class="check_rq_fields">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Login*</label>
                    <input type="text" class="form-control rq" id="userid" name="userid" placeholder="Enter username" readonly <?php echo 'value='.$_SESSION["login"]; ?>>
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
        
<!--Footer-->
<?php include("./includes/footer.php");?>
<!--Java Script   -->
<!--JQuery-->
<script src="https://code.jquery.com/jquery-1.12.4.js"> </script>

<!--Bootstrap main -->
<script src="js/bootstrap.min.js"></script>

<script>
    $(function () {
        $('.check_rq_fields').on("click change", function() {
            var f = $(".rq");
            var cansubmit = true;
            for (var i = 0; i < f.length; i++) {
                if (f[i].value.length == 0) cansubmit = false;
            }
            $('#signup').prop('disabled', !cansubmit);
        });
    });
</script>
    
</body>
</html>
