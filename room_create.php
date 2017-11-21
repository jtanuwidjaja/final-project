<?php
    include("loginserv.php");
    include("includes/create_room.php");
    include("includes/DB_connection.php");
 

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
    <link rel="stylesheet" type="text/css" href="css/spinner.css">
</head>

<body>
	<?php include "includes/navi_bar.php";?>
   <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create a new room
<!--<small>We are always ready to help you</small>-->
                </h1>
                <p>Enter information about your new room.</p>
            </div>
       </div>
    <form action="" method="post" onchange="checkform()" role="form">
      <div class="row"> 
                <div class="form-group col-xs-2">
                    <label >Full name*</label>
                    <input type="text" class="form-control rq" id="username" name="fullname" placeholder="Enter your full name">
                </div>
         
         <div class="col-xs-2"> 
              <label for="ex2">Select Branch</label>
                 <select class="form-control" id="branchdd" name="branchdd" onchange="change_branch()">
                      <option>Select</option>
                      <?php 
                      $res=mysqli_query($conn,"SELECT * FROM branch");
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


            <div class="col-xs-2" id="level"">
                   <label for="ex2">Choose Level*</label>
                         <select class="form-control">
                <option>Select</option>
            </select>  
            </div>

            <div class="form-group col-xs-2">
                    <div class="input-group spinner">
                        <label >Capacity</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" name="capacity" value="12" id="capacity">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <div class="row">

           <div class="form-group col-xs-2">
                    <label >Status</label>
                    <select class="form-control" id="status" name="status" >
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
          </div>
          
          <div class="row">
           <div class="form-group col-lg-4">
            <label >Faculty*</label>
          <?php 
            $res=mysqli_query($conn,"SELECT * FROM faculty");
            while($row=mysqli_fetch_array($res))
            {  
              echo '<div class="checkbox">
                      <label>
                        <input type="checkbox" class="faculty" name="'.$row["facultyid"].'">'.$row["facultyname"].
                      '</label>
                    </div>';
            }
            
          ?>
            <input type="checkbox" id="checkAll" name="checkAll">Check All
                </div>
                </div>
        

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
                     <div class="row col-lg-12">
                <button type="submit" class="btn btn-primary" name="create" id="signup">Create</button>
            </div>
        </form>
       </div> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="js/spinner.js"></script>
    <script src="js/site.js" type="text/javascript"></script> 
    <script>
      function change_branch(){
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.open("GET","ajax.php?branch="+document.getElementById("branchdd").value,false);
          xmlhttp.send(null);
          document.getElementById("tower").innerHTML=xmlhttp.responseText; 


          if(document.getElementById("branchdd").value=="Select")
          {
            document.getElementById("level").innerHTML="<label for='ex2'>Choose Level*</label><select class='form-control'><option>Select</option></select>"
          }
           if(document.getElementById("branchdd").value!="Select")
          {
            document.getElementById("level").innerHTML="<label for='ex2'>Choose Level*</label><select class='form-control'><option>Select</option></select>"
          }

        }

        function change_tower()
        {
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.open("GET","ajax.php?tower="+document.getElementById("towerdd").value,false);
          xmlhttp.send(null);
          document.getElementById("level").innerHTML=xmlhttp.responseText;
          }  
        </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>	
    <script>
       $("#checkAll").click(function () {
          $('input:checkbox').not(this).prop('checked', this.checked);
        });
       $('.faculty').click(function(){
          if ($(this).prop('checked') == false){
             $("#checkAll").prop('checked', false);
          }
          if ($('.faculty').not(':checked').length == 0) {
              $("#checkAll").prop('checked', true);
          }
       });


    </script>
    
</body>
</html>
