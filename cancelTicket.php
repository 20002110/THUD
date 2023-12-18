<?php

session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include_once 'handleDB.php';
$db = new HandleDB();

$id = $_GET['id'];
$userID = $_SESSION['userID'];


$ticket = $db->find_data('ticket', 'ticketID', $id);
$seatID = $ticket['seatID'];
$seat = $db->find_data('seats', 'seatID', $seatID);
$movieID = $seat['MovieID'];
$theaterID = $seat['theaterID'];
$time = $seat['time'];
$date = $seat['date'];
$seatMap = $seat['seat'];
$seatMap = json_decode($seatMap, true);
$newSeatMap = array();
foreach ($seatMap as $seat) {
    if ($seat['user_id'] == $userID && $seat['ticketID'] == $id) {
        $seat['user_id'] = 0;
        $seat['status'] = 0;
        $seat['ticketID'] = -1;
    }
    $newSeatMap[] = $seat;
}

$newSeatMap = json_encode($newSeatMap);





if ($db->update('seats', array('seat' => $newSeatMap), 'seatID', $seatID)) {
    if ($db->delete('ticket', 'ticketID', $id)) {
        header("ticket.php");
    }
} else {
    echo '<script>alert("Có lỗi xảy ra, vui lòng thử lại sau")</script>';
}




?>