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

$theaterID = $_GET['updateid'];
$theater= $db->find_data('theater', 'theaterID', $theaterID);


?>

<?php


if (isset($_POST['submit'])) {

    $theaterName = $_POST['theaterName'];
    $location = $_POST['location'];
    $rooms = $_POST['rooms'];
    $row = $_POST['row'];
    $col = $_POST['col'];

    $data = array(
        'theaterName' => $theaterName,
        'location' => $location,
        'rooms' => $rooms,
        'row' => $row,
        'col' => $col,
    );




    if ($db->update_movie('theater', $data, 'theaterID', $theaterID)) {

        // echo '<label style="color:green;">Add success</label>';
        header("location: manageTheater.php");
    } else {
        echo '<label style="color:red;">update false</label>';
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

    <title>Update Theater</title>

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
                                THUD
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
                                        <a class="dropdown-item" href="manageTheater.php">List Theater</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Movies
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="addNew.php">Add Movies</a>
                                        <a class="dropdown-item" href="manageMovie.php">List Movies</a>
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
                        Update Theater
                    </h2>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-md-7 mx-auto">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="contact_form-container">
                                    <div>
                                        <!-- Theater name -->
                                        <div>
                                            <label for="theaterName">Name Theater</label>
                                            <input type="text" placeholder="Name of Theater" name="theaterName" id="theaterName"
                                                value="<?php echo $theater['theaterName'] ?>" />
                                        </div>
                                        <!-- Location -->
                                        <div>
                                            <label for="location">Location</label>
                                            <input type="text" placeholder="Location" name="location" id="location"
                                                value="<?php echo $theater['location'] ?>" />
                                        </div>
                                        <!-- rooms -->
                                        <div>
                                            <label for="rooms">Rooms</label>
                                            <input type="text" placeholder="number of Rooms" name="rooms" id="rooms"
                                                value="<?php echo $theater['rooms'] ?>" />
                                        </div>

                                        <!-- row and col -->
                                        <div>
                                            <label for="seat">Number of seats</label>
                                            <input type="text" placeholder="number of row" name="row" id="row"
                                                value="<?php echo $theater['row'] ?>" />
                                            <input type="text" placeholder="number of column" name="col" id="col"
                                                value="<?php echo $theater['col'] ?>" />
                                        </div>

                                        <div class="btn-box ">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                                Update
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