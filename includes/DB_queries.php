<?php
//Connection to the database
include("./includes/DB_connection.php");

function  get_tutor_list($faculty,$branch) {

    require("./includes/DB_connection.php");
    $tutorquery = mysqli_query($conn, 
       "SELECT login, first_name, last_name, phone, email FROM user WHERE role = '2' AND facultyid = '$faculty' AND branchid='$branch'") or trigger_error(mysql_error());
return $tutorquery;
} 

function  get_branch_list() {

    require("./includes/DB_connection.php");
    $campusquery = mysqli_query($conn, 
       "SELECT * FROM branch") or trigger_error(mysql_error());
return $campusquery;
} 

function  get_faculty_list() {

    require("./includes/DB_connection.php");
    $facultyquery = mysqli_query($conn, 
       "SELECT * FROM faculty") or trigger_error(mysql_error());
return $facultyquery;
} 

function  get_room_list() {

    require("./includes/DB_connection.php");
    $roomquery = mysqli_query($conn, 
       "SELECT * FROM room") or trigger_error(mysql_error());
return $roomquery;
} 

function check_room_availability($id,$roomid,$capacity,$branch,$faculty,$dateDB,$repeat,$last_repeat,$time_start,$time_end) {
    require("./includes/DB_connection.php");
    $query = mysqli_query($conn, 
        "SELECT * FROM room 
        JOIN building ON room.buildingid=building.buildingid
        LEFT JOIN restriction ON room.roomid=restriction.roomid
        WHERE
        room.roomid = '$roomid' AND
        room.capacity >= '$capacity' AND
        building.branchid = '$branch' AND
        (restriction.facultyid = '$faculty' OR restriction.facultyid IS NULL) AND
        room.roomid NOT IN 
        (
            SELECT DISTINCT roomid FROM bookingrecord 
			WHERE
            (
                DATEDIFF(bookingdate, '$last_repeat') <= 0 AND
                DATEDIFF(DATE_SUB(end_repeat, INTERVAL (MOD(DATEDIFF(end_repeat, bookingdate),GREATEST(bookingrepeat,1))) DAY), '$dateDB') >= 0
    		) AND
            (
        		MOD(DATEDIFF(bookingdate, '$dateDB'),LEAST(bookingrepeat,$repeat)) = 0 OR MOD(DATEDIFF('$dateDB', bookingdate),LEAST(bookingrepeat,$repeat)) is NULL
    		) AND  
    		time_start < '$time_end' AND time_end > '$time_start'
            AND bookingid <> $id
        )") or trigger_error(mysql_error());
return $query;
}

function update_booking($dateDB,$time_start,$time_end,$roomid,$userid,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor,$id) {

    require("./includes/DB_connection.php");
    $query = mysqli_query($conn, 
            "UPDATE bookingrecord SET bookingdate = '$dateDB', time_start = '$time_start', time_end = '$time_end', roomid = '$roomid', login = '$userid', facultyid = '$faculty', classname = '$classname', capacity = '$capacity', bookingrepeat = '$repeat', end_repeat = '$end_repeatDB', tutor = '$tutor'  WHERE bookingid = '$id'") or trigger_error(mysql_error());
return $query;
} 

function select_booking($id) {
    require("./includes/DB_connection.php");
    $query = mysqli_query($conn,"
        SELECT *
        FROM bookingrecord 
        JOIN room ON room.roomid = bookingrecord.roomid 
        JOIN building ON building.buildingid = room.buildingid
        JOIN branch ON branch.branchid = building.branchid
        WHERE bookingid = '$id'") or trigger_error(mysql_error());
return $query;
}
function insert_booking($dateDB,$roomid,$time_start,$userid,$time_end,$faculty,$classname,$capacity,$repeat,$end_repeatDB,$tutor) {
    require("./includes/DB_connection.php");
    $query = mysqli_query($conn, 
            "INSERT INTO `bookingrecord`(`bookingdate`, `roomid`, `time_start`, `login`, `time_end`, `facultyid`, `classname`, `capacity`, `bookingrepeat`, `end_repeat`,`tutor`) VALUES ('$dateDB','$roomid','$time_start','$userid','$time_end','$faculty','$classname','$capacity','$repeat','$end_repeatDB','$tutor')") or trigger_error(mysql_error());
return $query;
}

function  get_user_list() {

    require("./includes/DB_connection.php");
    $query = mysqli_query($conn, "SELECT * FROM user LEFT JOIN branch ON user.branchid = branch.branchid LEFT JOIN faculty ON user.facultyid = faculty.facultyid") or trigger_error(mysql_error());
return $query;
} 



?>