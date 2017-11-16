<?php
    //Connection to the database
    include("./includes/DB_connection.php");
    
    $branch = $_POST['branch'];
    $rooms = array();
    
    //echo 'rooms'.$branch.' ';
    //Add as resources buildings
    $query = mysqli_query($conn, "
    SELECT * FROM building WHERE branchid = $branch");
    //WHERE branchid = $branch");
    while($row = mysqli_fetch_array($query)){
        $r = array();
        $r['id'] = 'b'.$row['buildingid'];
        $r['title'] = $row['buildingname'];
        $bh = array();
        $bh['start'] = '00:00:00';
        $bh['end'] = '00:00:00';
        $r['businessHours'] = $bh;
        
        // Merge the event array into the return array
        array_push($rooms, $r);
    }

    $query = mysqli_query($conn, "SELECT room.roomid, room.roomname, room.capacity, room.buildingid   FROM room JOIN building ON room.buildingid = building.buildingid 
    WHERE building.branchid = $branch");

    while($row = mysqli_fetch_array($query)){
        $r = array();
        $r['id'] = $row['roomid'];
        $r['title'] = $row['roomname'].' ('.$row['capacity'].')';
        $r['parentId'] = 'b'.$row['buildingid'];
        
        // Merge the event array into the return array
        array_push($rooms, $r);
    }
    
    // Output json for our calendar
    echo json_encode($rooms);
    
//    function rooms(){
//        echo "  { id: 'a', title: 'Auditorium A' },
//				{ id: 'b', title: 'Auditorium B', eventColor: 'green' },
//				{ id: 'c', title: 'Auditorium C', eventColor: 'orange' },
//				{ id: 'd', title: 'Auditorium D', children: [
//					{ id: 'd1', title: 'Room D1' },
//					{ id: 'd2', title: 'Room D2' }
//				] },
//				{ id: 'e', title: 'Auditorium E' },
//				{ id: 'f', title: 'Auditorium F', eventColor: 'red' },
//				{ id: 'g', title: 'Auditorium G' },
//				{ id: 'h', title: 'Auditorium H' },
//				{ id: 'i', title: 'Auditorium I' },
//				{ id: 'j', title: 'Auditorium J' },
//				{ id: 'k', title: 'Auditorium K' },
//				{ id: 'l', title: 'Auditorium L' },
//				{ id: 'm', title: 'Auditorium M' },
//				{ id: 'n', title: 'Auditorium N' },
//				{ id: 'o', title: 'Auditorium O' },
//				{ id: 'p', title: 'Auditorium P' },
//				{ id: 'q', title: 'Auditorium Q' },
//				{ id: 'r', title: 'Auditorium R' },
//				{ id: 's', title: 'Auditorium S' },
//				{ id: 't', title: 'Auditorium T' },
//				{ id: 'u', title: 'Auditorium U' },
//				{ id: 'v', title: 'Auditorium V' },
//				{ id: 'w', title: 'Auditorium W' },
//				{ id: 'x', title: 'Auditorium X' },
//				{ id: 'y', title: 'Auditorium Y' },
//				{ id: 'z', title: 'Auditorium Z' }";
//    }
?>