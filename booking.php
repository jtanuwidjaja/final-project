<?php
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")) {
        header("location: index.php");
    }

    //Connection to the database
    include("./includes/DB_connection.php");

    
    $campusquery = mysqli_query($conn, 
       "SELECT * FROM branch");

    $facultyquery = mysqli_query($conn, 
       "SELECT * FROM faculty");
    
    //searching branch for administrators of faculties
    if ($_SESSION["role"] == 1) {
        $userid = $_SESSION['login'];
        $userbrachquery = mysqli_query($conn, 
       "SELECT branchid, facultyid FROM user WHERE login = '$userid'");
        $rows = mysqli_fetch_array($userbrachquery);
        $branch = $rows["branchid"];
        $faculty = $rows["facultyid"];
    }
    
    $date = $_POST['date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
?>

<!doctype HTML5>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Booking room</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
    
    <!--icons-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!--Room table design-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/select/1.2.3/css/select.bootstrap.min.css">
    
    
    <!--Spinner design-->
    <link href="css/booking.css" rel="stylesheet">
    
    
</head>
<body>
    <!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>	
    
    <div class="container"> 
       <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Select the Room
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>For booking the room select criteria and choose the room</p>
            </div>
       </div>
    
        
        
        <form action="bookinginfo.php" method="post" role="form" id="selectionform" class="check_rq_fields">
           <div class="row"> 
                <div class="form-group col-lg-4 col-md-4">
                    <label >Date</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control rq" id="date" name="date" <?php echo 'value='.$date; ?>>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time from</label>
                    <div class='input-group date' id="timepickerfrom">
                        <input type='text' class="form-control rq" id="time_start" name="time_start" <?php echo 'value='.$time_start; ?>>
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
               </div>
                <div class="form-group col-lg-4">
                    <label >Time to</label>
                    <div class='input-group date' id="timepickerto">
                    <input type='text' class="form-control rq" id="time_end" name="time_end" <?php echo 'value='.$time_end; ?>>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-2">
                    <div class="input-group spinner">
                        <label >Enrolments</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control rq" value="12" id="capacity" name="capacity">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Campus</label>
                    <select class="form-control" name="campus" id="campus" <?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
                        <?php 
                            while($row = mysqli_fetch_array($campusquery)){
                                
                                echo '<option value="'.$row["branchid"].'"';
                                if ($row["branchid"] == $branch) {
                                    echo ' selected';
                                }
                                echo '>'.$row["branchname"].'</option>';
                            }
                        ?>
                    </select>
                    
                </div>
                <div class="form-group col-lg-4">
                    <label >Faculty</label>
                    <select class="form-control" name="faculty" id="faculty" <?php if ($_SESSION["role"] != "0") echo 'readonly'?> >
                        <?php 
                            while($row = mysqli_fetch_array($facultyquery)){
                                echo '<option value="'.$row["facultyid"].'"';
                                if ($row["facultyid"] == $faculty) {
                                    echo ' selected';
                                }
                                echo '>'.$row["facultyname"].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Repeat</label>
                    <select class="form-control" name="repeat" id="repeat">
                        <option value="0" >Never</option>
                        <option value="1">Every Day</option>
                        <option value="7">Every Week</option>
                        <option value="14">Every Fortnight</option>
                    </select>
                </div>
                <div class="form-group col-lg-4 col-md-4">
                    <label >End Repeat</label>
                    <div class='input-group date datepicker'>
                       <input type='text' class="form-control" name="end_repeat" id="end_repeat">
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
               </div>
            </div>

            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" id="signup" disabled>Search</button>
            </div>

                    <!-- Error Message -->
                    <br><br>
                    <span style="color:red;font-size=20px;"><?php echo $error; ?></span>
            <input type="text" name=roomid id=roomid hidden="hidden">
        </form>
        
        
        
        <div class="row">
            
            <table id="roomlist" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            
            </table>
                
        
        
        </div>
        
        
      
</div>
    
    <!--Footer-->
    <?php include("./includes/footer.php");?>
<!--Java Script   -->
<!--JQuery-->
<script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
<!--Datatables-->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"> </script>
        
<!--JS files for Datapicker-->
<script type="text/javascript" src="js/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<!--Bootstrap main -->
<script src="js/bootstrap.min.js"></script>
    
<script src="js/booking.js" type="text/javascript">
</script>

    <script>
        $('#signup').click(function showlistroom()
        {
            var bdate = document.getElementById("date").value;
            var time_start = document.getElementById("time_start").value;
            var time_end = document.getElementById("time_end").value;
            var campus = document.getElementById("campus").value;
            var faculty = document.getElementById("faculty").value;
            var capacity = document.getElementById("capacity").value;
            var repeat = document.getElementById("repeat").value;
            var end_repeat = document.getElementById("end_repeat").value;
            
            var http = new XMLHttpRequest();
            http.open ("POST", "selectroom.php", false);
            
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            
            http.send ("date="+bdate+"&time_start="+time_start+"&time_end="+time_end+"&campus="+campus+"&faculty="+faculty+"&capacity="+capacity+"&repeat="+repeat+"&end_repeat="+end_repeat);
            
            document.getElementById("roomlist").innerHTML=http.responseText; 
            
            $('#roomlist').DataTable();
            
            return false;
        });
        
        function selectroom(roomid){
            $('#roomid').val(roomid);
            $('#selectionform').submit();
        }
        
        <?php if ($_SESSION["role"] != "0") echo "
        $('#role option:not(:selected)').prop('disabled', true);
        $('#status option:not(:selected)').prop('disabled', true);
        $('#campus option:not(:selected)').prop('disabled', true);
        $('#faculty option:not(:selected)').prop('disabled', true);
        ";?>
        
    </script>
        
</body>
</html>
