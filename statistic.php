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

$sum_ticket = 0;


$filter = $_GET['filter'];
if (empty($filter)) {
    $filter = 'day';
}

if ($filter == 'day') {
    $today = date("Y-m");
    $data = $db->find_statistic('seats', 'date', $today);


    $labels = [];
    $values = [];

    foreach ($data as $value) {
        $seats = json_decode($value['seat'], true);
        $totalprice = 0;
        $price = $db->find_data('Movies', 'movieID', $value['MovieID'])['cost'];

        foreach ($seats as $seat) {
            if ($seat['status'] == 1) {
                $sum_ticket++;
                if ($seat['seatName'] == 'A' || $seat['seatName'] == 'B') {
                    $totalprice += $price * 1.5;
                } else {
                    $totalprice += $price;
                }
            }
        }

        $labels[] = $value['date'];
        $values[] = $totalprice;
    }
} else if ($filter == 'month') {
    $today = date("Y");

    $labels = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
        '11', '12'];
    $values = [];

    foreach ($labels as $months) {
        $month = $today . '-' . $months;
        $data = $db->find_statistic('seats', 'date', $month);

        $totalprice = 0;

        foreach ($data as $value) {
            $seats = json_decode($value['seat'], true);
            $price = $db->find_data('Movies', 'movieID', $value['MovieID'])['cost'];
            foreach ($seats as $seat) {
                if ($seat['status'] == 1) {
                    $sum_ticket++;
                    if ($seat['seatName'] == 'A' || $seat['seatName'] == 'B') {
                        $totalprice += $price * 1.5;
                    } else {
                        $totalprice += $price;
                    }
                }
            }
        }
        $values[] = $totalprice;

    }



}





?>

<!DOCTYPE html>
<html lang="en">

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

    <title> Films </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- Thư viện Bootstrap và Chart.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="sub_page">
    <div class="hero_area">
        <header class="header_section">
            <!-- header section strats -->
            <!-- <div class="hero_bg_box">
                <div class="img-box">
                    <img src="images/background.jpg" alt="">
                </div>
            </div> -->
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
                                Call : +84 1234567890
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
            <div class="header_bottom" style="background-color: #424242">
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
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Statistic
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="statistic.php?filter=day">Statistic by day</a>
                                        <a class="dropdown-item" href="statistic.php?filter=month">Statistic by
                                            month</a>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
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
                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo '  <li class="nav-item dropdown ">  
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . $_SESSION['username'] . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view_profile.php">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </li>';

                                } else {
                                    echo '<li class="nav-item">
                  <a class="nav-link" href="login.php"> Login </a>
                </li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <!-- statistic section -->
        <section>
            <div class="container mt-4">
                <!-- Thông số -->
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tổng số vé</h5>
                                <p class="card-text">
                                    <?php echo $sum_ticket; ?> vé
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tổng doanh thu</h5>
                                <p class="card-text">
                                    <?php echo array_sum($values); ?> VND
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Biểu đồ -->
                <div class="row mt-4">
                    <div class="col-md-12 text-white">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <script>
                // Vẽ biểu đồ
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            label: 'Sales',
                            data: <?php echo json_encode($values); ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.4)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value, index, values) {
                                        return value + ' VND';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>


        </section>

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