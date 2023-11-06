<?php

session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
 header("location: login.php");
exit;
}

if ($_SESSION['username'] != "admin@gmail.com") {
 header("location: addNew.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Add Product</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="images/vinfast.jpeg" alt="">
            </div>
        </div>

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
                                Guarder
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.php"> Services </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php ">Log out</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->

        <!-- Add product main -->
        <section class="contact_section layout_padding">
            <div class="contact_bg_box">
                <div class="img-box">
                    <img src="images/contact-bg.jpg" alt="">
                </div>
            </div>
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Add New Product
                    </h2>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-md-7 mx-auto">
                            <form action="" method = "post" enctype="multipart/form-data">
                                <div class="contact_form-container">
                                    <div>
                                        <div>
                                            <label for="name">Name Product</label>
                                            <input type="text" placeholder="Name" name="name" id="name" />
                                        </div>
                                        <div>
                                            <label for="name">SubContent</label>
                                            <input type="text" placeholder="Subcontent" name="content" id="content" />
                                        </div>
                                        <div>
                                            <label for="discribe">Product Discribe</label>
                                            <textarea name="discribe" id = "discribe" cols="30" rows="10" class="form-control" placeholder="Describe" required></textarea>
                                        </div>
                                        <div>
                                            <label for="price">Price</label>
                                            <input type="number" placeholder="Price" name="price" id="price" />
                                        </div>
                                        <div class="img-box">
                                            <label for="file">URL hình ảnh</label>
                                            <input type="file" name="file" id="file" class="form-control" required>
                                            <img src="" id="image" class="img-fluid" alt="Ảnh sản phẩm" required>
                                        </div>
                                        <script>
                                            var loadFile = function (event) {
                                                var image = document.getElementById('image');
                                                var file = event.target.files[0];

                                                // Kiểm tra file upload là file hình ảnh
                                                var fileType = file.type;

                                                if (fileType != 'image/jpeg' && fileType != 'image/png' && fileType != 'image/jpg') {
                                                    alert("Chỉ được upload file hình ảnh");
                                                    return;
                                                }

                                                // Tạo URL của file ảnh
                                                var url = URL.createObjectURL(file);
                                                console.log(url);

                                                // Hiển thị ảnh
                                                image.src = url;
                                            };

                                            // Gắn sự kiện cho thẻ input
                                            document.getElementById('file').addEventListener('change', loadFile);
                                        </script>

                                        <div class="btn-box ">
                                            <button type="submit">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end Add product main -->

        <?php
        include_once 'handleDB.php';
        $db = new HandleDB();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $subcontent = $_POST['content'];
            $describe = $_POST['discribe'];
            $price = $_POST['price'];
            $file = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $upload_dir = "images/";
            $file_path = $upload_dir . $file;

            if(move_uploaded_file($file_tmp, $file_path)){
                $url_image = $file_path;
            } else {
                echo "Upload file thất bại";
            }

            $data = array(
                "name" => $name,
                "content" => $describe,
                "url" => $url_image,
                "cost" => $price,
                "subcontent" => $subcontent
            );

            $db->add_data("services", $data);

            echo "Thêm sản phẩm thành công";

            header("location: addNew.php");
        }
        ?>

        <!-- info section -->
        <section class="info_section ">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info_info">
                            <h5>
                                Contact Us
                            </h5>
                        </div>
                        <div class="info_contact">
                            <a href="" class="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    334 Nguyễn Trãi, Thanh Xuân, Hà Nội
                                </span>
                            </a>
                            <a href="" class="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call : +84 1234567890
                                </span>
                            </a>
                            <a href="" class="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    support@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info_form ">
                            <h5>
                                Newsletter
                            </h5>
                            <form action="#">
                                <input type="email" placeholder="Enter your email">
                                <button>
                                    Subscribe
                                </button>
                            </form>
                            <div class="social_box">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
        <!-- end info_section -->

        <!-- footer section -->
        <footer class="container-fluid footer_section">
            <p>
                &copy; <span id="currentYear"></span> All Rights Reserved. Design by Admin
            </p>
        </footer>
        <!-- footer section -->

        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/custom.js"></script>

</body>

</html>
