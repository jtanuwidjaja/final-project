<?php
    include("loginserv.php");
    include("create_user.php");
    if ($_SESSION["role"] != "0") {
	//$_SESSION['msg'] = "You must log in first";
    header("location: login.php");
}
    include("./includes/DB_queries.php");
    
    $campusquery = get_branch_list();
    
    $facultyquery = get_faculty_list();
    
?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
    
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
                <h1 class="page-header">Registration
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Enter information about you to register in MSBS. Registered user can access to Booking functionallity.</p>
            </div>
       </div>
       
    
    <form action="" method="post" role="form" class="check_rq_fields">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Login*</label>
                    <input type="text" class="form-control rq" id="userid" name="userid" placeholder="Enter username">
                </div>
                <div class="form-group col-lg-4">
                    <label>Password*</label>
                    <input type="password" class="form-control rq"  id="passsword" name="password" placeholder="Enter password">
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >First name*</label>
                    <input type="text" class="form-control rq" id="first_name" name="first_name" placeholder="Enter your full name">
                </div>
                <div class="form-group col-lg-4">
                    <label >Last name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your full name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="2">Tutor</option>
                        <option value="1">Administrator</option>
                        <option value="0">Superuser</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Status</label>
                    <select class="form-control" id="status" name="status" >
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
            </div>
            <div class="row" id="campus_faculty">
                <div class="form-group col-lg-4">
                    <label >Campus</label>
                    <select class="form-control" name="campus" id="campus" >
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
                    <select class="form-control" name="faculty" id="faculty">
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
                    <label >Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Phone*</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phonenumber" pattern='0{1}[0-9]{9}'>
                </div>
                <div class="form-group col-lg-4">
                    <label >Email*</label>
                    <input type="email" class="form-control rq" id="email" name="email" placeholder="Enter username">
                </div>
            </div>
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="register" id="signup" disabled>Save</button>
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
        if ($('#role').val() == 0) {
            $('#campus').prop('disabled', true);
            $('#faculty').prop('disabled', true);
            $('#campus_faculty').prop('hidden', true);
        }
        $("#role").change(function(){
            var hide = false;
            if ($('#role').val() == 0) hide = true;
                
            $('#campus').prop('disabled', hide);
            $('#faculty').prop('disabled', hide);
            $('#campus_faculty').prop('hidden', hide);      
        }
        );
    });
</script>
    
</body>
</html>
