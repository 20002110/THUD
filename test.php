

<?php 

include "handleDB.php";

$handleDB = new HandleDB();

$username = "test";
$password = "test";

$password = hash_hmac('sha256', $password, 'key');

$data = array(
    "username" => $username,
    "password" => $password
);

if ($handleDB->add_data("Users", $data)) {
    echo "Thêm thành công";
} else {
    echo "Thêm thất bại";
}


?>
