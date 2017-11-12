<?php
    include("loginserv.php");
    include("edit_user.php");
    if (isset($_SESSION["login"])){
        if ($_SESSION["role"] == "0") {
            $userid = $_GET["ID"];
        }
        else {
            $userid = $_SESSION["login"];
        }
    } 
    else {
        header("location: login.php");
    }
<<<<<<< HEAD
    
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM user WHERE userid='$userid'");
=======
        
    include("./includes/DB_queries.php");

    $query = mysqli_query($conn, "SELECT * FROM user WHERE login='$userid'");
>>>>>>> 7bb5958372c6c23df3c87bd85a986f237c9f7998
    $row = $query->fetch_assoc();  
    $password=$row["password"];
    $first_name=$row["first_name"];
    $last_name=$row["last_name"];
    $role=$row["role"];
    $phone=$row["phone"];
    $email=$row["email"];
    $gender=$row["gender"];
    $branch=$row["branchid"];
    $faculty=$row["facultyid"];
    $status=$row["status"];
    
    $campusquery = get_branch_list();
    
    $facultyquery = get_faculty_list();

?>


<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User information</title>
    
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
                <h1 class="page-header">Personal information
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Update personal information and click Save button</p>
            </div>
       </div>
       
    <form action="" method="post" role="form" class="check_rq_fields">
           <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >Login*</label>
                    <input type="text" class="form-control rq" id="userid" name="userid" placeholder="Enter username" readonly <?php echo 'value='.$userid; ?>>
                </div>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] != "0") echo 'style="display:none;"';?>>
                    <label>Password*</label>
                    <input type="password" class="form-control rq"  id="passsword" name="password" placeholder="Enter password" <?php echo 'value='.$password; ?>>
                </div>
                <div class="form-group col-lg-4" <?php if ($_SESSION["role"] == "0") echo 'style="display:none;"';?>>
                    <label>Password*</label>
                    <p><a href="changepass.php">Change password</a></p>
                </div>
            </div>
            <div class="row"> 
                <div class="form-group col-lg-4">
                    <label >First name*</label>
                    <input type="text" class="form-control rq" id="first_name" name="first_name" placeholder="Enter your full name" <?php echo 'value="'.$first_name.'"'; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label >Last name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your full name" <?php echo 'value="'.$last_name.'"'; ?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Role</label>
                    <select class="form-control" id="role" name="role" <?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
                        <option value="2" <?php if ($role == "2") echo 'selected'; ?>>Tutor</option>
                        <option value="1" <?php if ($role == "1") echo 'selected'; ?> >Administrator</option>
                        <option value="0" <?php if ($role == "0") echo 'selected'; ?>>Superuser</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label >Status</label>
                    <select class="form-control" id="status" name="status" <?php if ($_SESSION["role"] != "0") echo 'readonly';?>>
                        <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Enable</option>
                        <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Disable</option>
                    </select>
                </div>
            </div>
            <div class="row" id="campus_faculty">
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
                    <label >Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="1" <?php if ($gender == "1") echo 'selected'; ?>>Male</option>
                        <option value="0" <?php if ($gender == "0") echo 'selected'; ?>>Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label >Phone*</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phonenumber" pattern='0{1}[0-9]{9}' <?php echo 'value='.$phone; ?>>
                </div>
                <div class="form-group col-lg-4">
                    <label >Email*</label>
                    <input type="email" class="form-control rq" id="email" name="email" placeholder="Enter username" <?php echo 'value='.$email; ?>>
                </div>
            </div>
            <input type="text" name="return" hidden <?php echo 'value='.$_GET['return'];?>>
            <div class="row col-lg-4">
                <button type="submit" class="btn btn-primary" name="save" id="signup" disabled>Save</button>
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
    
    <?php if ($_SESSION["role"] != "0") echo "
        $('#role option:not(:selected)').prop('disabled', true);
        $('#status option:not(:selected)').prop('disabled', true);
        $('#campus option:not(:selected)').prop('disabled', true);
        $('#faculty option:not(:selected)').prop('disabled', true);
        ";?>
</script>
    
</body>
</html>
