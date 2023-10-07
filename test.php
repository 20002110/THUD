<?php 

include "handleDB.php";

$handleDB = new HandleDB();

$data = array( 
    "name" => "xe dap",
    "content" => "Đào tạo lái xe ô tô",
    "url" => "images/t3.jpg"

);

if ($handleDB->add_data("services", $data)) {
    echo "Thêm thành công";
} else {
    echo "Thêm thất bại";
}
?>