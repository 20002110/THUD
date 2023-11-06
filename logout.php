<?php

session_start();
$_SESSION['username'] = "";
$_SESSION['password'] = "";
session_destroy();
header("Location: index.php");

?>

