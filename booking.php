<?php
    include("loginserv.php");
    include("select_param.php");
?>

<!doctype HTML5>
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
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Booking<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="booking.php">Book room</a></li>';}
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
            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>'; }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
	
    <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Book the Room
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>For booking the room you should complete 3 steps.</p>
            </div>
       </div>
    
        
        
    <form action="" method="post" onchange="checkform()" role="form">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Date</label>
                    <input type="date" class="form-control rq" name="adate"<?php echo "value=".$_SESSION['date'];?> placeholder="Enter date" <?php echo 'value='.$userid; ?>>
                </div>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] != "administrator") echo 'style="display:none;"';?>>
                    <label>Password*</label>
                    <input type="password" class="form-control rq"  id="passsword" name="password" placeholder="Enter password" <?php echo 'value='.$password; ?>>
                </div>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] == "administrator") echo 'style="display:none;"';?>>
                    <label>Password*</label>
                    <p><a href="changepass.php">Change password</a></p>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Full name*</label>
                    <input type="text" class="form-control rq" id="username" name="username" placeholder="Enter your full name" <?php echo 'value='.$username; ?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Role</label>
                    <select class="form-control" id="role" name="role" <?php if ($_SESSION["role"] != "administrator") echo 'readonly';?>>
                        <option value="customer" <?php if ($role == "customer") echo 'selected'; ?>>Customer</option>
                        <option value="staff" <?php if ($role == "staff") echo 'selected'; ?> >Staff</option>
                        <option value="administrator" <?php if ($role == "administrator") echo 'selected'; ?>>Administrator</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Status</label>
                    <select class="form-control" id="status" name="status" <?php if ($_SESSION["role"] != "administrator") echo 'readonly';?>>
                        <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Enable</option>
                        <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Disable</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="Enter your age" <?php echo 'value='.$age; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label >Gender*</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male" <?php if ($gender == "male") echo 'selected'; ?>>Male</option>
                        <option value="female" <?php if ($gender == "female") echo 'selected'; ?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Phone*</label>
                    <input type="text" class="form-control rq" id="phone" name="phone" placeholder="Enter phonenumber" pattern='0{1}[0-9]{9}' <?php echo 'value='.$phone; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label >Email*</label>
                    <input type="email" class="form-control rq" id="email" name="email" placeholder="Enter username" <?php echo 'value='.$email; ?>>
                </div>
            </div>
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="save" id="signup" disabled>Save</button>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
        </form>
        
        
    
    <div id="body">
        
        <div id="select_data_service">
            <h2><span>Step 1: Pick a date and meeting type</span></h2>
            
                <div id = "calendar" >
                    <form id="book_param" onchange="checkstep1()" action="" method="post">
                    <span><b>Date:</b></span>
                        <input id="date" type="date" name="adate"<?php echo "value=".$_SESSION['date'];?>>
                        <span><b> Select a Faculty</b></span>
                        <select name="faculty">
                            <option value="IT">IT</option>
                            <option value="Bussines">Bussines</option>
                        </select>
                        <input id="capacity" name="capacity" placeholder="Capacity">
                    <!--<input type="submit">-->
            
                    <span><b> Select a Meeting type</b></span>
                    <select name="service" id="Service">
                        <option value="" >Select a Meeting type</option>
                        <?php 
                            
                            $conn = mysqli_connect("localhost", "root", "root");
                            //Selecting Database
                            $db = mysqli_select_db($conn, "MRBS");
                            //sql query to fetch information of registerd user and finds user match.
                            $query = mysqli_query($conn, "SELECT * FROM meeting");

                            while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results
                                if($_SESSION['serv'] == $row["meetingid"]) {
                                    echo '<option value="'.$row["meetingid"].'" selected>'.$row["meetingname"].'</option>';
                                }
                                else {
                                    echo '<option value="'.$row["meetingid"].'">'.$row["meetingname"].'</option>';
                                }    
                            }
                            
                            mysqli_close($conn); // Closing connection
                        ?>
                    </select>
                    <br><br>
<!--                <span><?php echo $_SESSION['sl']; ?></span>-->
                    <input type="submit" value="Next" name="step1" id="step1" disabled>
                </form>
                </div>
            
        </div>
        <div id="select_artist" <?php if($hide_step2) echo "hidden";?> >
            <h2><span>Step 2: Select meeting room</span></h2>
            <ul>
                <?php 
                $conn = mysqli_connect("localhost", "root", "root");
                //Selecting Database
                $db = mysqli_select_db($conn, "MRBS");
                //sql query to fetch information of registerd user and finds user match.
                $query = mysqli_query($conn, "SELECT * FROM room");
                
                while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
                    echo '
                        <li onclick="SelectItem(this)" value="'.$row["roomid"].'"';
                    if (!in_array($row["roomid"],$_SESSION['artists'])) echo 'style="display:none;"';
                    if ($_SESSION['art_id'] == $row["roomid"]) echo 'class=active';
                    echo '>
                            <img src="'.$row["roompic"].'" alt="">
                            <p>'.$row["roomname"].'</p>
                         </li>';

                }
           
            ?>      
            
		  </ul>
            <form id="artist" onchange="checkform()" action="" method="post">
                <input type="text" name="artist" id="artist_id" style="display:none;">
                <input type="submit" value="Next" name="step2" id="step2" disabled>
            </form>
        </div>
        <div id="select_time" <?php if($hide_step3) echo "hidden";?>>
            <h2><span>Step 3: What time is best for you?</span></h2>
            <ul id="time">
                <?php 
                $conn = mysqli_connect("localhost", "root", "root");
                //Selecting Database
                $db = mysqli_select_db($conn, "MRBS");
                //sql query to fetch information of registerd user and finds user match.
                $query = mysqli_query($conn, "SELECT * FROM slot");
                
                while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
                    echo '
                        <li onclick="SelectTime(this)" value="'.$row["slotid"].'"';
                    if (in_array($row["slotid"],$_SESSION['bslots']))   echo 'class=hide';
                    echo '>'.$row["slotdesc"].'</li>';

                }
           
            ?>      

            </ul>
            <form action="" method="post">
                <input type="text" name="slot" id="slot_id" style="display:none;">
                <input id="submitbutton" value="Continue" type="submit" name="step3" disabled>
            </form>
        </div>

        
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
