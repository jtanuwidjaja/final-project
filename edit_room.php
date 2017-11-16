<?php


    $ID=$_POST['roomid'];
    $name=$_POST['roomname'];
    $description=$_POST['roomdescription'];


    
    //Establishing Connection with server by passing server_name, user_id and pass as a parameter
    $conn = mysqli_connect("localhost", "root", "root");
    //Selecting Database
    $db = mysqli_select_db($conn, "MRBS");
    //sql query to fetch information of registerd user and finds user match.
    
    if(($_FILES['fileToUpload']['name'])&&(!$_FILES['fileToUpload']['error'])){  
        $query1 = mysqli_query($conn, "SELECT * FROM room WHERE roomid='$ID'");
        $row = $query1->fetch_assoc();
        $oldphoto = $row["roompic"];
        
        
        $target_dir = "./images/rooms/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        //if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
        
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                    //header ("Location: gallery.php?new=1");
                    

                // if everything is ok, try to upload file
                } else {
                    $newfilename= date('dmYHis').str_replace(" ", "", basename($_FILES["fileToUpload"]["name"]));
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
                        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    //insert new room into DB with photo
                    $roompic = $target_dir . $newfilename;
                    $query = mysqli_query($conn, "UPDATE room SET roomname='$name',roomdescription='$description',roompic='$roompic' WHERE roomid='$ID'");
                    //delete old photo from uploaded folder
                    unlink($oldphoto);
                    
                    header ("Location: gallery.php");
                    } else {
                        //header ("Location: gallery.php?new=1");
                        echo "Sorry, there was an error uploading your file";

                    }
                }
            
    }
    else {
    //update only roomname and description
    $query = mysqli_query($conn, "UPDATE room SET roomname='$name',roomdescription='$description' WHERE roomid='$ID'");

    header ("Location: gallery.php");
            
    
   }
   mysqli_close($conn); // Closing connection 
?>