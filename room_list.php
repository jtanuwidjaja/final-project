<?php 
include("loginserv.php");
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
	<title>Room List</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
<!--    <link href="css/style_old.css" rel="stylesheet">-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<!--    <script src="https://code.jquery.com/jquery-1.12.3.min.js"> </script>-->
    
<!--    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>-->
    
    
    
    
    
</head>

<body>
  
<?php include "includes/navi_bar.php";?>
    <div id="wrap">
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Room List
<!--                    <small>We are always ready to help you</small>-->
                </h1>
                <p>Manatain user profiles and create new one. Only Administrator can create user with Administrator or Staff role</p>
            </div>
    </div>
       
       
    <?php
   
    include ("includes/DB_connection.php");
    //sql query to fetch information of registerd user and finds user match.
    $query = mysqli_query($conn, "SELECT branch.*, building.*, room.*
                        FROM branch, building, room
                        WHERE branch.branchid = building.branchid AND building.buildingid = room.buildingid"
);

                    
    echo '
        <form method=post action=update_service.php>
            <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">'; // start a table tag in the HTML
    echo '
                <thead>
                    <tr>

                        <th>Branch Name</th>
                        <th>Building Name</th>
                        <th>Level</th>
                        <th>Room Name</th>
                        <th>Address</th>
                        <th>Capacity</th>
                        <th>Room ID</th>
                        <th>Availability</th>
                        <th>Edit or Delete</th>

                    </tr>
                </thead>
                <tbody>';
    while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results            
        







        echo '
                <tr>
                    <td>
                    '.$row["branchname"].'
                    </td>
                    <td>
                    '.$row["buildingname"].'
                    </td>
                    <td>
                    '.$row["level"].'
                    </td>
                    <td>
                    '.$row["roomname"].'
                    </td>
                    <td>
                    '.$row["address"].'
                    </td>
                      <td>
                    '.$row["capacity"].'
                    </td>
                    <td>
                    '.$row["roomid"].'
                    </td>';

                     

        if($row["status"] == 0){  
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
                   

                 echo'   <td style="width:60px; text-align: center;">
                        <a href="room_edit.php?ID='.$row["roomid"].'"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="includes/delete_room.php?ID='.$row["roomid"].'"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>';
            
    }

    echo "</tbody></table></form>"; //Close the table in HTML
    echo '<a href="room_create.php" class="btn btn-primary" role="button">Create new room</a>';
    mysqli_close($conn); // Closing connection
    ?>
      
</div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"> </script>
    
    <script> 
        
        $(document).ready(function() {
            $('#usertable').DataTable();
        } );
    
    
    </script>


<!--    <script src="js/site.js" type="text/javascript"></script> -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
-->
<!--     IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>	-->


    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!--  <script src="js/bootstrap.min.js"></script> -->
   </div>
       <?php include "includes/footer.php";?>
</body>
</html>
