<?php

session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include_once 'handleDB.php';
$db = new HandleDB();

$id = $_GET['id'];
$userID = $_SESSION['userID'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/detail.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/custom.js"></script> -->
    <style>
        body {
            background-color: #222;

        }
        .ticket-cardWrap {
            width: 30em;
            margin: 3em auto;
            color: #fff;
            font-family: sans-serif;
            margin-bottom: 100px;
        }

        .ticket-card {
            background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
            height: 15em;
            float: left;
            position: relative;
            padding: 1em;
            margin-top: 100px;
        }

        .ticket-cardLeft {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            width: 20em;
            height: 16.9em;          
        }

        .ticket-cardRight {
            width: 6.5em;
            border-left: 0.18em dashed #fff;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            height: 16.9em;
        }

        .ticket-cardRight:before,
        .ticket-cardRight:after {
            content: "";
            position: absolute;
            display: block;
            width: 0.9em;
            height: 0.9em;
            background: #fff;
            border-radius: 50%;
            left: -0.5em;
        }

        .ticket-cardRight:before {
            top: -0.4em;
        }

        .ticket-cardRight:after {
            bottom: -0.4em;
        }

        h1 {
            font-size: 1.1em;
            margin-top: 0;
        }

        h1 span {
            font-weight: normal;
        }

        .title,
        .name,
        .location,
        .time {
            text-transform: uppercase;
            font-weight: normal;
        }

        .title h2,
        .name h2,
        .time h2 {
            font-size: 0.75em;
            color: #525252;
            margin: 0;
        }

        .location h2{
            font-size: 0.7em;
            color: #525252;
            margin: 0;
        }

        .title span,
        .name span,
        .location span,
        .time span {
            font-size: 0.7em;
            color: #a2aeae;
        }

        .title {
            margin: 2em 0 0 0;
        }

        .name,
        .location {
            margin: 0.1em 0 0 0;
        }

        .time {
            margin: 0.1em 0 0 1em;
        }

        .location,
        .time {
            margin: 0.1em 0 0 0;
        }

        .eye {
            position: relative;
            width: 2em;
            height: 1.5em;
            background: #fff;
            margin: 0 auto;
            border-radius: 1em/0.6em;
            z-index: 1;
        }

        .eye:before,
        .eye:after {
            content: "";
            display: block;
            position: absolute;
            border-radius: 50%;
        }

        .eye:before {
            width: 1em;
            height: 1em;
            background: #e84c3d;
            z-index: 2;
            left: 8px;
            top: 4px;
        }

        .eye:after {
            width: 0.5em;
            height: 0.5em;
            background: #fff;
            z-index: 3;
            left: 12px;
            top: 8px;
        }

        .number {
            text-align: center;
            text-transform: uppercase;
        }

        .number h3 {
            color: #e84c3d;
            margin: 1.7em 0 0 0;
            font-size: 2em;
        }

        .number span {
            display: block;
            color: #a2aeae;
        }

        .barcode {
            height: 2em;
            width: 0;
            margin: 1.2em 0 0 0.8em;
            box-shadow: 1px 0 0 1px #343434, 5px 0 0 1px #343434, 10px 0 0 1px #343434, 11px 0 0 1px #343434, 15px 0 0 1px #343434, 18px 0 0 1px #343434, 22px 0 0 1px #343434, 23px 0 0 1px #343434, 26px 0 0 1px #343434, 30px 0 0 1px #343434, 35px 0 0 1px #343434, 37px 0 0 1px #343434, 41px 0 0 1px #343434, 44px 0 0 1px #343434, 47px 0 0 1px #343434, 51px 0 0 1px #343434, 56px 0 0 1px #343434, 59px 0 0 1px #343434;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top container">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav float-end" style="margin-left: auto!important;">
                <li class="nav-item ">
                    <a class="nav-link" href="service.php"> Films</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="ticket.php">My Tickets</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['username'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view_profile.php">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

<section>
<div class="ticket-container mt-3">

    <?php
    $ticket = $db->find_data('ticket', 'ticketID', $id);
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
        if ($seat['user_id'] == $userID && $seat['ticketID'] == $id) {
            $seatName[] = $seat['seatName'];
        }
    }
    $seatName = implode(', ', $seatName);
    $movie = $db->find_data('Movies', 'MovieID', $movieID);
    $name_movie = $movie['Name'];
    $theater = $db->find_data('theater', 'theaterID', $theaterID);
    $theaterName = $theater['theaterName'];
    $location = $theater['location'];
    $location = explode(',', $location);
    $location = $location[0];
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
    $seatName = implode(', ', $seatName);

    $userinfor = $db->find_data('userInfor', 'user_id', $userID);
    $username = $userinfor['fullName'];


    // check if seatName is empty or not
    if (empty($seatName)) {
        $seatName = 'err';
        $name_movie = 'err';
        $totalprice = 'err';
        $date = 'err';
        $time = 'err';
    }
    echo '
        <div class="ticket-cardWrap">
            <div class="ticket-card ticket-cardLeft">
                <h1 class="text-center"> <strong>CGV </strong> <span>Vé xem phim</span></h1>
                <div class="title">
                <span>Tên phim</span>
                    <h2>' . $name_movie . '</h2>
                </div>
               
                <div class="name">
                <span>Khách hàng</span>
                    <h2>' . $username . '</h2>

                </div>
                <div class="location">
                <span>Cụm rạp</span>
                    <h2>' . $theaterName . ', ' . $location . '</h2>

                </div>
                <div class="time">
                <span>Giờ xem</span>
                    <h2>' . $time . ', ' . $date . '</h2>

                </div>
                <div class="name">
                <span>Tổng tiền</span>
                    <h2>' . $totalprice . ' VND</h2>
                </div>
            </div>
            <div class="ticket-card ticket-cardRight">
                <div class="eye"></div>
                <div class="number text-center">
                
                    <h3>' . $seatName . '</h3>
                    <span>seat</span>

                </div>
                <div class="barcode text-center"></div>
            </div>
        </div>';
    ?>

</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>