<?php
if(isset($_POST['create'])){
    
    
    $level = $_POST['leveldd'];
    $tower = $_POST['towerdd'];
    $capacity = $_POST['capacity'];
    $fullname = $_POST['fullname'];
    $roomid = $_POST['roomid'];
    $status = $_POST['status'];






        include ("includes/DB_connection.php");


        // $allfaculties = $_POST['checkAll'];
        // echo  $allfaculties;
        // if ($allfaculties == false) {
        //     $res=mysqli_query($conn,"SELECT * FROM faculty");
        //     while($row=mysqli_fetch_array($res))
        //     {
        //         $facultyid = $row['facultyid'];
        //         $faculty_checkbox = $_POST['$facultyid'];
        //         if ($faculty_checkbox == true) {
        //             $query = mysqli_query($conn, "INSERT INTO restriction (roomid, facultyid) VALUES ('$roomid','$facultyid')");
        //         }

        //     }  

        // }

        //sql query to fetch information of registerd user and finds user match.
        $query = mysqli_query($conn, "INSERT INTO room (roomname, buildingid, level, capacity) VALUES ('$fullname','$tower','$level','$capacity')");
        
        $error1 =  "INSERT INTO room ('roomname', 'buildingid', 'level', 'capacity', 'status') VALUES ('$fullname','$tower','$level','$capacity', '$status')";

        if(! $query ) {
            $error = "Error";   
            }
        else
        {
            header("Location: room_list.php"); // Redirecting to other page
        }
        
        
        mysqli_close($conn); // Closing connection

}
?>