<?php

session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if ($_SESSION['username'] != "admin@gmail.com") {
    header("location: index.php");
}

include_once 'handleDB.php';
$db = new HandleDB();
$id = $_GET['deleteid'];

if ($db->delete('theater', 'theaterID', $id)) {
    $db -> set_auto_increment('theater', 'theaterID');
    $db -> set_auto_increment('seats', 'seatID');
    header("location: manageTheater.php");
} else {
    echo "<script>alert('Xóa rap thất bại');</script>";
}


?>