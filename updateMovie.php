<?php

session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if ($_SESSION['username'] != "admin@gmail.com") {
    header("location: service.php");
}

include_once 'handleDB.php';
$db = new HandleDB();

$movieID = $_GET['updateid'];
$film = $db->find_data('Movies', 'movieID', $movieID);


?>

<?php


if (isset($_POST['submit'])) {


    if (empty($_FILES['file']['name'])) {
        $url_image = $film['image'];
    } else {
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $upload_dir = "images/";
        $file_path = $upload_dir . $file;
        if (move_uploaded_file($file_tmp, $file_path)) {
            $url_image = $file_path;
        } else {
            echo '<label style="color:red;">Add false image</label>';
        }
    }

    // $file = $_FILES['file']['name'];
    // $file_tmp = $_FILES['file']['tmp_name'];
    // $upload_dir = "images/";
    // $file_path = $upload_dir . $file;
    // if (move_uploaded_file($file_tmp, $file_path)) {
    //     $url_image = $file_path;
    // } else {
    //     echo '<label style="color:red;">Add false image</label>';
    // }


    $name = $_POST['name'];
    $director = $_POST['director'];
    $performer = $_POST['performer'];
    $category = $_POST['category'];
    $time = $_POST['time'];
    $language = $_POST['language'];
    $premiere = $_POST['premiere'];
    $describes = $_POST['describes'];
    $price = $_POST['price'];
    $image = $url_image;
    $url = $_POST['url'];

    if ($db->find_data('TypeMovie', 'typeName', $category) == false) {

        if ($db->add_data('TypeMovie', array('typeName' => $category))) {
            $typeID = $db->find_data('TypeMovie', 'typeName', $category)['typeID'];
        } else {
            echo '<label style="color:red;">Add false</label>';
            die();
        }

    } else {

        $typeID = $db->find_data('TypeMovie', 'typeName', $category)['typeID'];
    }





    $data = array(
        'Name' => $name,
        'director' => $director,
        'performer' => $performer,
        'typeID' => $typeID,
        'time' => $time,
        'language' => $language,
        'premiere' => $premiere,
        'describes' => $describes,
        'cost' => $price,
        'image' => $image,
        'url' => $url
    );




    if ($db->update_movie('Movies', $data, 'movieID', $movieID)) {

        // echo '<label style="color:green;">Add success</label>';
        header("location: service.php");
    } else {
        echo '<label style="color:red;">Add false</label>';
    }

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

    <title>Update Movie</title>

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
                <img src="images/manager_bg.jpg" alt="">
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
                                CGV*
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Theater
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="addTheater.php">Add Theater</a>
                                        <a class="dropdown-item" href="listTheater.php">List Theater</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Movies
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="addNew.php">Add Movies</a>
                                        <a class="dropdown-item" href="listMovies.php">List Movies</a>
                                    </div>
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
                        Update Movie
                    </h2>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-md-7 mx-auto">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="contact_form-container">
                                    <div>
                                        <div>
                                            <label for="name">Name Movie</label>
                                            <input type="text" placeholder="Name" name="name" id="name"
                                                value="<?php echo $film['Name'] ?>" />
                                        </div>
                                        <div>
                                            <label for="director">Director</label>
                                            <input type="text" placeholder="Director" name="director" id="director"
                                                value="<?php echo $film['director'] ?>" />
                                        </div>
                                        <!-- performer -->
                                        <div>
                                            <label for="performer">Performer</label>
                                            <input type="text" placeholder="Performer" name="performer" id="performer"
                                                value="<?php echo $film['performer'] ?>" />
                                        </div>
                                        <!-- category -->
                                        <div>
                                            <!-- dropbox -->
                                            <?php

                                            $typemovivie = $db->findAll('TypeMovie');

                                            // dropbox
                                            echo '<label for="category">Category</label>';
                                            echo '<select name="category" id="category" class="form-control">';
                                            $category = $db->find_data('TypeMovie', 'typeID', $film['typeID']);
                                            $category = $category['typeName'];

                                            echo '<option value="' . $category . '" selected>' . $category . '</option>';


                                            foreach ($typemovivie as $key => $value) {
                                                if ($value['typeName'] == $category) {
                                                    continue;
                                                }
                                                echo '<option value="' . $value['typeName'] . ' ">' . $value['typeName'] . '</option>';
                                            }
                                            echo '</select>';
                                            ?>
                                            <!-- add new category -->

                                            <button onclick="addGenre()" class="btn btn-primary"
                                                style="padding:5px;">Add new genre</button>

                                            <script>
                                                function addGenre() {
                                                    var genre = prompt("Nhập thể loại phim mới:");
                                                    if (genre != null) {
                                                        var select = document.getElementById("category");
                                                        var option = document.createElement("option");
                                                        option.text = genre;
                                                        option.value = genre.toLowerCase();
                                                        select.add(option);
                                                    }
                                                }
                                            </script>

                                        </div>

                                        <!-- time -->
                                        <div>
                                            <label for="time">Time</label>
                                            <input type="text" placeholder="Time" name="time" id="time"
                                                value="<?php echo $film['time'] ?>" />
                                        </div>

                                        <!-- language -->
                                        <div>
                                            <label for="language">Language</label>
                                            <input type="text" placeholder="Language" name="language" id="language"
                                                value="<?php echo $film['language'] ?>" />
                                        </div>

                                        <!-- premiere -->
                                        <div>
                                            <label for="premiere">Premiere</label>
                                            <input type="date" placeholder="Premiere" name="premiere" id="premiere"
                                                value="<?php echo $film['premiere'] ?>" />
                                        </div>

                                        <!-- describes -->
                                        <div>
                                            <label for="describes">Describes</label>
                                            <textarea name="describes" id="describes" cols="30" rows="10"
                                                class="form-control"
                                                placeholder="Describes movie"><?php echo $film['describes'] ?></textarea>
                                        </div>

                                        <!-- price -->
                                        <div>
                                            <label for="price">Price</label>
                                            <input type="text" placeholder="Price" name="price" id="price"
                                                value="<?php echo $film['cost'] ?>" />
                                        </div>

                                        <!-- price -->
                                        <div>
                                            <label for="price">url</label>
                                            <input type="text" placeholder="url" name="url" id="url" value="<?php echo $film['url'] ?>" />
                                        </div>


                                        <div class="img-box">
                                            <label for="file">URL Images</label>
                                            <input type="file" name="file" id="file" class="form-control">
                                            <img src="<?php echo $film['image'] ?>" id="image" class="img-fluid"
                                                alt="Ảnh sản phẩm">
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

                                                // Hiển thị ảnh
                                                image.src = url;
                                            };

                                            // Gắn sự kiện cho thẻ input
                                            document.getElementById('file').addEventListener('change', loadFile);
                                        </script>

                                        <div class="btn-box ">
                                            <button type="submit" class="btn btn-primary" name="submit">
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