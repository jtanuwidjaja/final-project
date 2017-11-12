<?php 
include("loginserv.php");
//here I am checking for session expiry
if ($_SESSION["role"] != "0") {
	//$_SESSION['msg'] = "You must log in first";
    header("location: login.php");
}

include("./includes/DB_queries.php");

$query = get_user_list();

mysqli_close($conn); // Closing connection

?>

<!doctype html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User list</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
<!--    <link href="css/style_old.css" rel="stylesheet">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<!--    <script src="https://code.jquery.com/jquery-1.12.3.min.js"> </script>-->
    
<!--    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>-->
    
    
    
    
    
</head>
<body>
<!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>	   
    
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User list
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Manatain user profiles and create new one. Only Superuser can create user with Superuser or Administrator role</p>
            </div>
    </div>
       
<<<<<<< HEAD
       
    <?php
    include("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT * FROM user");
                    
    echo '
        <form method=post action=update_service.php>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Password</th>
                        <th>Full name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
=======
    <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
        <thead>
            <tr>
                <th>Login</th>
                <th>First name</th>
                <th>Last name</th>                   <th>Role</th>
                <th>Status</th>
                <th>Gender</th>
                <th>Campus</th>
                <th>Faculty</th>                   <th>Phone</th>
                <th>Email</th>
                <th>Control</th>             
            </tr>
        </thead>
        <tbody> 
    <?php                    
    while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results        
>>>>>>> 7bb5958372c6c23df3c87bd85a986f237c9f7998
        echo '
                <tr>
                    <td>
                    '.$row["login"].'
                    </td>
                    <td>
                    '.$row["first_name"].'
                    </td>
                    <td>
                    '.$row["last_name"].'
                    </td>
                    ';
        switch ($row["role"]) {
            case 0: echo '
                    <td>
                    Superuser
                    </td>';
                    break;
            case 1: echo '
                    <td>
                    Administrator
                    </td>';
                    break;
            case 2: echo '
                    <td>
                    Tutor
                    </td>';
                    break;
        }
        if ($row["status"] == 0){  
                        echo '
                        <td style="text-align: center;">
                            <span class="glyphicon glyphicon-off" style="color: gray;"></span>
                        </td>';
        }
        else{
                        echo '
                        <td style="text-align: center;">
                            <span class="glyphicon glyphicon-off" style="color: green;"></span>
                        </td>';
        }
        if ($row["gender"] == 1) {
            echo '
                    <td>
                    Male
                    </td>';
        }
        else{
            echo '
                    <td>
                    Female
                    </td>';
        }
        
        echo '
                    <td>
                    '.$row["branchname"].'
                    </td>
                    <td>
                    '.$row["facultyname"].'
                    </td>
                    <td>
                    '.$row["phone"].'
                    </td>
                    <td>
                    '.$row["email"].'
                    </td>
                            
                    <td style="width:60px; text-align: center;">
                        <a href="userinfo.php?ID='.$row["login"].'&return=1"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="delete_user.php?ID='.$row["login"].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>';
            
    }
    ?>
        </tbody>
    </table>
    <p><a href="registration.php">Create new user</a></p>
      
</div>
    
    <!--Footer-->
    <?php include("./includes/footer.php");?>
<!--Java Script   -->
<!--JQuery-->
<script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
<!--Datatables-->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"> </script>
<!--Bootstrap main -->
<script src="js/bootstrap.min.js"></script>
<script>
    $(function() {
       $('#usertable').DataTable(); 
    });
</script>
    
</body>
</html>
