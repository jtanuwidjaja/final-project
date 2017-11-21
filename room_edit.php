<?php
    include("loginserv.php");
    include("includes/edit_room.php");
    
    if ($_SESSION["role"] != "0") {
        header("location: index.php");
    }

    $roomid = $_GET['ID'];
    
    include ("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM branch LEFT JOIN building ON branch.branchid=building.branchid LEFT JOIN room ON building.buildingid=room.buildingid WHERE roomid='$roomid';");
    $row = $query->fetch_assoc();
    $branchname=$row["branchname"];
    $buildingname = $row["buildingname"];
    $buildingid = $row["buildingid"];
    $address = $row["address"];
    $roomname = $row["roomname"];
    $capacity = $row["capacity"];
    $level = $row["level"];
    $branchid = $row["branchid"];
    $status = $row["status"];


?>


<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Room EDIT</title>
    
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
      <link rel="stylesheet" type="text/css" href="css/spinner.css">

      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
   <?php include "includes/navi_bar.php";?>
     <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Room Edit
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Update personal information and click Save button</p>
            </div>
       </div>
       
    
        <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-xs-2">
                    <label >Room ID*</label>
                    <input type="text" class="form-control rq" id="roomid" name="roomid" placeholder="Enter username" readonly <?php echo 'value='.$roomid; ?>>
                </div>

                <div class="form-group col-xs-2" <?php if ($_SESSION["role"] == "2") echo 'style="display:none;"';?>>
                    <label>Room Name*</label>
                    <input type="roomname" class="form-control rq"  id="roomname" name="roomname" placeholder="Enter roomname" <?php echo 'value='.$roomname; ?>>
                </div>
             </div>

            

              <div class="row"> 
                <div class="form-group col-xs-2">
                 <label for="ex2">Select Branch</label>
                         <select class="form-control" id="branchdd" name="branch" onchange="change_branch()">
                              <option>Select</option>
                              <?php 
                              $res=mysqli_query($conn,"SELECT * FROM branch");
                              while($row=mysqli_fetch_array($res))
                              {
                                echo '<option value="'.$row["branchid"].'"';
                                if ($row["branchid"] == $branchid){
                                  echo 'selected';
                                }
                                echo '>'.$row["branchname"].'</option>';
                              }
                              ?>
                            </select>
                           </div>

            <div class="col-xs-2" id="tower">
                   <label for="ex2">Choose Tower*</label>
                         <select class="form-control" name="towerdd">
                <option>Select</option>
                <?php 
                              $res=mysqli_query($conn,"SELECT * FROM building LEFT JOIN branch ON branch.branchid=building.branchid");
                              while($row=mysqli_fetch_array($res))
                              {
                                echo '<option value="'.$row["buildingid"].'"';
                                if ($row["buildingid"] == $buildingid){
                                  echo 'selected';
                                } 
                                echo '>'.$row["buildingname"].'</option>';
                              }
                              ?>
            </select>  
            </div>


            <div class="col-xs-2" id="level"">
                   <label for="ex2">Choose Level*</label>
                         <select class="form-control" name="leveldd">
                <option>Select</option>
                <?php 
                      $res=mysqli_query($conn,"SELECT * FROM branch LEFT JOIN building ON branch.branchid=building.branchid LEFT JOIN room ON building.buildingid=room.buildingid WHERE roomid='$roomid'");
                      $row=mysqli_fetch_array($res);
                      $nlevel = $row['nlevel'];
                      for($i=0; $i<=$nlevel; $i++){
                      echo '<option value="'.$i.'"';
                                if ($i == $level){
                                  echo 'selected';
                                }
                                echo '>'.$i.'</option>';
                      }
                  ?>
            </select>  
            </div>


           <div class="form-group col-xs-2">
                    <div class="input-group spinner">
                        <label >Capacity</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" name="capacity"  id="capacity"<?php echo 'value='.$capacity; ?>>
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
                    <select class="form-control" id="status" name="status" <?php if ($_SESSION["role"] != "0") echo 'readonly';?>>
                        <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Enable</option>
                        <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Disable</option>
                    </select>
                </div>
              </div>


               <div class="row">
                <div class="form-group col-lg-4">
                 <button type="submit" class="btn btn-primary" name="save" id="signup">Save</button>
             

              </div>
            </div>
          
      

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>     
    <script src="js/site.js" type="text/javascript"></script> 
    <script src="js/spinner.js" type="text/javascript"></script> 
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> 
    <script type="text/javascript">
          function change_branch(){
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.open("GET","ajax_edit.php?branch="+document.getElementById("branchdd").value,false);
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
          xmlhttp.open("GET","ajax_edit.php?tower="+document.getElementById("towerdd").value,false);
          xmlhttp.send(null);
        
          document.getElementById("level").innerHTML=xmlhttp.responseText;  
        }
        </script>

        
       
</body>

</html>
