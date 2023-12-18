<<<<<<< HEAD
<?php
    include 'handleDB.php';

    $db = new handleDB();

    if (isset($_POST['submit'])) {
        $fullName = $_POST['fullName'];
        $birthDay = $_POST['birthDay'];
        $phoneNumber = $_POST['phoneNumber'];
        $adress = $_POST['adress'];
        $data = array(
            "fullName" => $fullName,
            "phone" => $phoneNumber,
            "date_of_birth" => $birthDay,
            "address" => $address,
        );

        if ($db->add_data("userInfor", $data)) {
            echo "Chỉnh sửa thành công";           
        } else {
            echo "<script>alert('Chỉnh sửa thất bại thất bại')</script>";
        }
    }

    $db->__destruct();

?>
=======
>>>>>>> danhnt
