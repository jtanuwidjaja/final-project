<?php
    include("loginserv.php");
 
$link=mysqli_connect("localhost","root","root");
mysqli_select_db($link,"MRBS");
 

?>


<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration - MRBS</title>
    <script src="js/site.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/forspinner.css">
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
                <h1 class="page-header">Create a new class
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Enter information about your new class.</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
          

          <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Room ID*</label>
                    <input type="text" class="form-control rq" id="roomid" name="roomid" placeholder="Enter Room ID">
                </div>
            </div>


            <div class="row"> 
                <div class="form-group col-lg-4">
                
                </div>
            </div>
          

          <div class="row"> 
                <div class="col-xs-2">
                <label for="ex2">Select Branch</label>
                         <select class="form-control" id="branchdd" name="branchdd" onchange="change_branch()">
                              <option>Select</option>
                              <?php 
                              $res=mysqli_query($link,"SELECT * FROM branch");
                              while($row=mysqli_fetch_array($res))
                              {
                                ?>
                                <option value="<?php echo $row["branchid"]; ?>"><?php echo $row["branchname"]?></option>
                              <?php  
                              }
                              ?>  

                              ?>
                            </select> 
            </div>

            <div class="col-xs-2" id="tower">
                   <label for="ex2">Choose Tower*</label>
                         <select class="form-control">
                <option>Select</option>
            </select>  
            </div>


            <div class="col-xs-2" id="level">
                   <label for="ex2">Choose Level*</label>
                         <select class="form-control">
                <option>Select</option>
            </select>  
            </div>






            <div class="col-xs-2">
                    <label for="ex2">Choose Capacity*</label>
                        <div class="input-group spinner">
                    <input type="text" class="form-control" value="42">
                    <div class="input-group-btn-vertical">
                      <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                      <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                    </div>
                  </div>
            </div>
            <div class="col-xs-2">
                    <label for="ex2">Choose Room*</label>
                                 <input type="text" class="form-control rq" id="fullname" name="fullname" placeholder="Enter Room">
            </div>
            </div>



            <div class="row"> 
            <div class="form-group col-lg-4">
            <label >Faculty*</label>
            <div class="checkbox">
                <label><input type="checkbox" id="faculty" name="faculty" value="accounting">Accounting</label>
                </div>
            <div class="checkbox">
              <label><input type="checkbox" id="faculty" name="faculty" value="business">Business</label>
                </div>
            <div class="checkbox">
              <label><input type="checkbox" id="faculty" name="faculty" value="healthcare">Healthcare</label>
                </div>
             <div class="checkbox">
              <label><input type="checkbox" id="faculty" name="faculty" value="hospitality">Hospitality</label>
                </div>
             <div class="checkbox">
              <label><input type="checkbox" id="faculty" name="faculty" value="IT">IT</label>
                </div>     
                </div>
            </div>
    
            
            <div class="row col-lg-12">
                <button type="submit" class="btn btn-primary" name="create" id="signup">Create</button>
            </div>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
        </form>
       </div>


    
   
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>  
        
  
        
      
    <script src="js/site.js" type="text/javascript"></script> 
    <script src="js/create_class.js" type="text/javascript"></script>
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
