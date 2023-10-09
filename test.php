<?php 

include "handleDB.php";

$handleDB = new HandleDB();

$data = array( 

    "username" => "ad",
    "password" => "12112002",
    "email" => "admin@gmail.com"

);

if ($handleDB->add_data("Users", $data)) {
    echo "Thêm thành công";
} else {
    echo "Thêm thất bại";
}
?>