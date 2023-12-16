<?php
    session_start();
    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        echo "<script>alertBạn chưa đăng nhập</script>";
        header("location: login.php");
        exit;
    }

    include 'handleDB.php';

    $db = new handleDB();
    $userID = $db->find_data('users','username',$_SESSION['username'])['user_id'];
    $foreign_userID = $db->find_data('userInfor','user_id',$userID)['user_id'];

    if (isset($_POST['submit'])) {
        $fullName = $_POST['fullName'];
        $phoneNumber = $_POST['phoneNumber'];
        $birthDay = $_POST['birthDay'];
        $address = $_POST['address'];

        if (!isset($foreign_userID) || empty($foreign_userID)) {
            $data = array(
                "user_id" => $userID,
                "fullName" => $fullName,
                "phone" => $phoneNumber,
                "date_of_birth" => $birthDay,
                "address" => $address
            );
            if ($db->add_data("userInfor", $data)) {
                echo "<script>alert('Chỉnh sửa thành công')</script>";           
            } else {
                echo "<script>alert('Chỉnh sửa thất bại')</script>";
            }
        }
        else{
            $data = array(
                "fullName" => $fullName,
                "phone" => $phoneNumber,
                "date_of_birth" => $birthDay,
                "address" => $address
            );

            if ($db->update_infor("userInfor", $data, $userID)) {
                echo "<script>alert('Chỉnh sửa thành công')</script>";           
            } else {
                echo "<script>alert('update thất bại')</script>";
            }

        }    

    }

?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org" th:replace="~{user/header::layout(~{::section})}">

<head>
    <meta charset="utf-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section start -->
        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_link-container">
                        <a href="" class="contact_link1">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                334 Nguyễn Trãi, Thanh Xuân, Hà Nội
                            </span>
                        </a>
                        <a href="" class="contact_link2">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call : +84 123456789
                            </span>
                        </a>
                        <a href="" class="contact_link3">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                support@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="index.php">
                            <span>
                                <i>"THUD"</i>
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.php"> Services </a>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Account
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="view_profile.php">Your Profile</a>
                                        <?php
                                        session_start();
                                        if (isset($_SESSION['username'])) {
                                            echo '<a class="dropdown-item" href="logout.php">Log out</a>';
                                        } else {
                                            echo '<a class="dropdown-item" href="login.php">Log in</a>';
                                        }
                                        ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- header section end -->
    </div>
<?php
    $userPassword = $db->find_data('users','username',$_SESSION['username'])['password'];
    $userFullName = $db->find_data('userInfor','user_id',$userID)['fullName'];
    $userPhone = $db->find_data('userInfor','user_id',$userID)['phone'];
    $userBirthday = $db->find_data('userInfor','user_id',$userID)['date_of_birth'];
    $userAddress = $db->find_data('userInfor','user_id',$userID)['address'];

 ?>
    <section style="font-family: 'JetBrains Mono Medium'">
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="images/login_bg.jpg" alt="">
            </div>
        </div>
        <div class="container p-5 ">
            <div class="row">
                <div class="col-md-4">
                    <div class="card paint-card">
                        <div class="card-body">
                            <form th:action="view_profile.php" method="get">
                                <p class="fs-4 text-center" style="font-size: 24px">THÔNG TIN CỦA BẠN</p>

                                <div class="form-group mt-2">
                                    <label> Email</label>
                                    <input type="text" name="email" value="<?php echo $_SESSION['username'] ?>" readonly class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label> Mật khẩu</label>
                                    <input type="password" name="passWord" value="<?php echo $userPassword ?>" readonly class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label> Tên </label>
                                    <input type="text" name="fullName" value="<?php echo $userFullName ?>" readonly class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label> Ngày sinh </label>
                                    <input type="date" name="birthDay" value="<?php echo $userBirthday ?>" readonly class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label> Giới tính </label>  
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Nam
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Nữ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            None
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label> Số điện thoại</label>
                                    <input type="text" name="Phone_number" value="<?php echo $userPhone ?>" readonly class="form-control" required="required">
                                </div>
                                <div class="form-group mt-2">
                                    <label> Thành phố/Tỉnh</label>
                                    <input type="text" name="Adress" value="<?php echo $userAddress ?>" readonly class="form-control" required="required">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                                            
                <div class="col-md-6">
                    <div class="card paint-card">
                        <div class="card-body">
                            <form action="view_profile.php" method="post">

                                <p class="fs-4 text-center" style="font-size: 24px">CẬP NHẬT THÔNG TIN</p>

                                <div class="form-group mt-2">
                                    <label> Tên </label> 
                                    <input type="text" name="fullName" id="fullName" class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label> Ngày sinh </label>
                                    <input type="date" name="birthDay" id=birthDay class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Số điện thoại</label> 
                                    <input type="number" name="phoneNumber" id=phoneNumber class="form-control" required="required">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Thành phố/Tỉnh</label> 
                                    <input type="text" name="address" id=address class="form-control" required="required">
                                </div>

                                <div class="text-center mt-3">
                                    <input class="btn bg-primary text-white" type="submit" name="submit" id="submit">

                                    <button type="reset" class="btn btn-primary text-white">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>