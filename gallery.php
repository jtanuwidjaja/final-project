<?php
    include("loginserv.php");
    //include("add_room.php");
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gallery - MRBS</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "includes/navi_bar.php"; ?>
	
 <div class="container">
<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Gallery
                    <small>We offer different types of Meeting rooms</small>
                </h1>
                <p>Watch the list of all existting meeting room in our office</p>
            </div>
        </div>
    
    <div class="row">
    
        <?php 
            $ID=$_GET["ID"];
            include("includes/DB_connection.php");
            //sql query to fetch information of registerd user and finds user match.
            $query = mysqli_query($conn, "SELECT * FROM room");
            $rows = mysqli_num_rows($query);
            if($rows >= 1){   
                while($row = mysqli_fetch_array($query)){   //Creates a loop to loop through results                    
                    if ($row["roomid"] == $ID) {
                        echo '
                        <form action="edit_room.php" method="POST" enctype="multipart/form-data">
                        <div class="col-md-4">
                        <div class="thumbnail">
                                <div class="caption">
                                    <input type="text" value="'.$row["roomid"].'" name="roomid" style="display:none;">
                                    <h3><input type="text" value="'.$row["roomname"].'"  name="roomname" style="border:none; width:100%; height:100%"> </h3>
                                </div>
                                <img src="'.$row["roompic"].'" alt="Lights" style="width:100%">
                                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">

                            <div class="caption">
                                <p><input type="text" value="'.$row["roomdescription"].'" name="roomdescription" style="border:none; width:100%"></p>
                            </div>';
                            if (($_SESSION["role"] == "administrator")||($_SESSION["role"] == "staff")) {
                                echo '<ul class="text-right list-inline">
                                        <li><a href="#" onclick="$(this).closest'."('form')".'.submit()"><span class="glyphicon glyphicon-floppy-save"></span></a></li>
                                        <li><a href="delete_room.php?ID='.$row["roomid"].'"><span class="glyphicon glyphicon-trash"></span></a></li>
                                    </ul>';
                            }
                            echo '</div>
                                    </div>
                                    </form>';
                        
                    }
                    
                        
                    
                    else {
                            echo '
                            <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="'.$row["roompic"].'">
                                    <div class="caption">
                                        <h3><input type="text" value="'.$row["roomname"].'"  name="roomname" style="border:none; width:100%; height:100%" readonly> </h3>
                                    </div>
                                    <img src="'.$row["roompic"].'" alt="Lights" style="width:100%">
                                    <br>
                                </a>

                                <div class="caption">
                                    <p><input type="text" value="'.$row["roomdescription"].'" name="roomname" style="border:none; width:100%" readonly></p>
                                </div>';
                            if (($_SESSION["role"] == "administrator")||($_SESSION["role"] == "staff")) {
                             echo '
                                <ul class="text-right list-inline">
                                    <li><a href="gallery.php?ID='.$row["roomid"].'"><span class="glyphicon glyphicon-pencil"></span></a></li>
                                    <li><a href="delete_room.php?ID='.$row["roomid"].'"><span class="glyphicon glyphicon-trash"></span></a></li>
                                </ul>'; }
                        echo '
                            </div>
                            </div> ';
                    }
                    
                
                }
            }
            else {
                echo '
                <div class="col-lg-12">
                    <h3>Sorry, no rooms can be found</h3>
                </div>';
            }
            if ((isset($_GET["new"]))&&(($_SESSION["role"] == "administrator")||($_SESSION["role"] == "staff"))) {
                echo '
                        <form action="add_room.php" method="POST" enctype="multipart/form-data">
                        <div class="col-md-4">
                        <div class="thumbnail">
                                <div class="caption">
                                    <h3><input type="text" value=""  placeholder="Enter room name" name="roomname" style="border:none; width:100%; height:100%"> </h3>
                                </div>
                                <img src="./images/rooms/default_room.jpg" alt="" style="width:100%">
                                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">

                            <div class="caption">
                                <p><input type="text" value="" placeholder="Enter room description" name="roomdescription" style="border:none; width:100%"></p>
                            </div>

                            <ul class="text-right list-inline">
                                <li><a href="#" onclick="$(this).closest'."('form')".'.submit()"><span class="glyphicon glyphicon-floppy-save"></span></a></li>
                                <li></li>
                            </ul>
                        </div>
                        </div>
                        </form>';
            }

            mysqli_close($conn); // Closing connection
            if (($_SESSION["role"] == "administrator")||($_SESSION["role"] == "staff")) {
                echo '
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="gallery.php?new=1" >
                                    <div class="caption">
                                        <h3><input type="text" value="Add new room"  name="roomname" style="border:none;"> </h3>
                                    </div>
                                    <img src="./images/add.png" alt="Lights" style="width:50%">
                                    <br>

                                    <div class="caption">
                                        <p><input type="text" value=""  name="roomdescription" style="border:none;"></p>
                                    </div>
                                </a>

                        <ul class="text-right list-inline">

                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>

                        </ul>
                    </div>
                    </div>';
            }
            ?>
  
</div>
    
</div> 
    
<?php include "includes/footer.php"; ?>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
