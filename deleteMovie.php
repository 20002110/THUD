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

if ($db->delete('Movies', 'movieID', $id)) {
    $db -> set_auto_increment('Movies', 'movieID');
    $db -> set_auto_increment('seats', 'seatID');
    header("location: manageMovie.php");
} else {
    echo "<script>alert('Xóa phim thất bại');</script>";
}


?>