<?php
    include("loginserv.php");
    include("edit_buildingquery.php");

    
    include "includes/DB_connection.php";
    //sql query to fetch information of registerd user and finds user match.

    $buildingid = $_GET['ID'];
    $query = mysqli_query($conn, "SELECT * FROM building WHERE buildingid='$buildingid'");
    $row = $query->fetch_assoc();  
    $branchid=$row["branchid"];
    $buildingid=$row["buildingid"]; 
    $buildingname=$row["buildingname"];
    $buildingaddress=$row["address"];
    $nlevel=$row["nlevel"];



?>


<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Branch</title>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    
	 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	
   <?php include "includes/navi_bar.php";?>
        <div id="wrap">
    
        <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Building Details
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Update building list and click save button</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
               <div class="form-group col-lg-4">
                    <label >Branch ID*</label>
                    <input type="text" class="form-control rq" id="branch_id" name="branchid" placeholder="Enter Branch ID" readonly <?php echo 'value='.$branchid; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label >Building ID*</label>
                    <input type="text" class="form-control rq" id="building_id" name="buildingid" placeholder="Enter Building ID" readonly <?php echo 'value='.$buildingid; ?>>
                </div>
            </div>
            <div class="row"> 
               <div class="form-group col-lg-4">
                    <label>Building Name*</label>
                    <input type="text" class="form-control rq"  id="building_name" name="buildingname" placeholder="Enter Building Name" <?php echo 'value="'.$buildingname.'"'; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label>Building Address*</label>
                    <input type="text" class="form-control rq"  id="buildingaddress" name="address" placeholder="Enter Building Address"  <?php echo 'value='.$buildingaddress; ?>>
                </div>
            </div>
            <div class="row"> 
               <div class="form-group col-lg-4">
                    <label>Number of Level*</label>
                    <input type="text" class="form-control rq"  id="number_level" name="nlevel" placeholder="Enter Number of Level" <?php echo 'value="'.$nlevel.'"'; ?>>
                </div>
            </div>
            
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="save" id="signup" disabled>Save</button>
            </div>

            

           
                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
            
        </form>
       </div> 
       </div> 
    
       <?php include "includes/footer.php";?>
        
  
    
    
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
