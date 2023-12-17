<?php

session_start();


if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$id = $_SESSION['userID'];


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

    <title>Manage Movie</title>

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
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.php"> Films </a>
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

       <!-- Body Start -->
<div class="container py-5">
    <a href="addNew.php" class="text-light"><button class="btn btn-primary my-5">Book Ticket</button></a>
        <!-- start echo message to user -->
        <?php
				if(isset($message)) {
					foreach($message as $message) {
						echo '<div class="alert alert-danger" role="alert">
							'.$message.'
						</div>';
					}
				}
		?>
		<!-- end echo mesaage to user -->
        <div>
        <table class="table align-middle table-striped  text-white">
            <thead class="table-success align-middle thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name Movie</th>
                    <th scope="col">Theater</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'handleDB.php';
                    $db = new HandleDB();
                    $tickets = $db->find_one('ticket', 'user_id', $id);
                    $status = 1;
                    foreach($tickets as $ticket) {
                        $seatID = $ticket['seatID'];
                        $seat = $db->find_data('seats', 'seatID', $seatID);
                        $movieID = $seat['MovieID'];
                        $theaterID = $seat['theaterID'];
                        $time = $seat['time'];
                        $date = $seat['date'];
                        $seatMap = $seat['seat'];
                        $seatMap = json_decode($seatMap, true);
                        $seatName = array();
                        foreach ($seatMap as $seat) {
                            if ($seat['user_id'] == $id) {
                                $seatName[] = $seat['seatName'];
                            }
                        }
                        $seatName = implode(', ', $seatName);
                        $movie = $db->find_data('Movies', 'MovieID', $movieID);
                        $name_movie = $movie['Name'];
                        $location = $db->find_data('theater', 'theaterID', $theaterID);
                        $location = $location['theaterName'];
                        $price = $movie['cost'];
                        $totalprice = 0;
                        // calculate price if user book more than 1 ticket
                        $seatName = explode(', ', $seatName);
                        foreach ($seatName as $seat) {
                            // check if seat is VIP or not by A,B character in seat name
                            if ($seat[0] == 'A' || $seat[0] == 'B') {
                                $totalprice += $price * 1.5;
                            } else {
                                $totalprice += $price;
                            }
                        }

                        echo '<tr>
                                <th scope="row">'.$status.'</th>
                                <td>'.$name_movie.'</td>
                                <td>'.$location.'</td>
                                <td>'.$date.'</td>
                                <td>'.$time.'</td>
                                <td>'.$totalprice. ' VND</td>
                                <td>
                                    <a href="show_ticket.php?id='.$ticket['ticketID'].'" class="text-light"><button class="btn btn-primary">Detail</button></a>
                                    <a href="delete_ticket.php?id='.$ticket['ticketID'].'" class="text-light"><button class="btn btn-danger">Delete</button></a>
                                </td>
                              </tr>';
                        
                        $status++;
                    }
                    
                ?>
                
            </tbody>
        </table>
    </div>
        
        
        
</div>
<!-- Body End -->


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