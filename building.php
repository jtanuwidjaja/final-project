<?php
    include("loginserv.php");
    include("select_param.php");

     if ($_SESSION["role"] != "0") {
    //$_SESSION['msg'] = "You must log in first";
    header("location: login.php");
}


?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Building</title>

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
                <h1 class="page-header">Building List
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p> Manage building list here</p>
            </div>
       </div>
       
       
    <?php
    include "includes/DB_connection.php";
    //sql query to fetch information of registerd user and find user match.
    $query = mysqli_query($conn, "SELECT * FROM building");
                    
    echo '
        <form method=post action=update_service.php>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>
                        <th>Branch ID</th>
                        <th>Building ID</th>
                        <th>Building Name</th>
                        <th>Address</th>
                        <th>Number of Level</th>
                        <th>Control</th>
                     
                      
                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query))
        
    
    {   //Creates a loop to loop through results 
        
        
      
        echo '
                <tr>
                    <td>
                    '.$row["branchid"].'
                    </td>
                    <td>
                    '.$row["buildingid"].'
                    </td>
                    <td>
                    '.$row["buildingname"].'
                    </td>
                    <td>
                    '.$row["address"].'
                    </td>
                    <td>
                    '.$row["nlevel"].'
                    </td>
                    <td style="width:60px; text-align: center;">
                        <a href="edit_building.php?ID='.$row["buildingid"].'"><span class="glyphicon glyphicon-pencil"></span></a>
            
                        <a href="delete_building.php?ID='.$row["buildingid"].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>';
                    
    
    
            
    }
    echo "</tbody></table></form>"; //Close the table in HTML
    echo '<p><a href="add_building.php" class="btn btn-primary">Add a new building</a></p>';
    mysqli_close($conn); // Closing connection
    ?>
        </div>

        

    
<?php include("./includes/footer.php");?>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

