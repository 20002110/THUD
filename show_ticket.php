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
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/detail.css" rel="stylesheet" />
    <style>
        body {
            background-color: #212529;
            color: whitesmoke;
        }

        .ticket-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: #343a40;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .ticket-heading {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .ticket-detail {
            margin-bottom: 15px;
        }

        .ticket-detail h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script> 
    <!-- <script src="js/custom.js"></script> -->
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

    <div class="ticket-container mt-5">
        <h1 class="text-center ticket-heading">VÉ XEM PHIM <i class="fa-solid fa-film"></i></h1>

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
            $seatName = 'Đặt vé thất bại, thử lại';
            $name_movie = 'Đặt vé thất bại, thử lại';
            $totalprice = 'Đặt vé thất bại, thử lại';
            $date = 'Đặt vé thất bại, thử lại';
            $time = 'Đặt vé thất bại, thử lại';
        }


        echo '<hr>
    <div class="ticket-detail">
        <h3>Tên khách hàng: ' . $username . '</h3>
    </div>

    <div class="ticket-detail">
        <h3>Email: ' . $_SESSION['username'] . '</h3>
    </div>

    <div class="ticket-detail">
        <h3>Tên phim: ' . $name_movie . '</h3>
    </div>

    <div class="ticket-detail">
        <h3>Giá vé: ' . $totalprice . ' VND</h3>
    </div>


    <div class="ticket-detail">
        <h3>Ngày xem: ' . $date . '</h3>
    </div>

    <div class="ticket-detail">
         <h3>Giờ chiếu: ' . $time . '</h3>
    </div>

    <div class="ticket-detail">
        <h3>Chỗ ngồi: ' . $seatName . '</h3>
    </div>


    <div class="ticket-detail">
        <h3>Cụm rạp: ' . $theaterName . '</h3>
    </div>

    <div class="ticket-detail">
       <h3>Địa chỉ: ' . $location . '</h3>
    </div>



    <hr>';

        ?>

        <div class="ticket-footer text-center">
            <h6><i class="fa-solid fa-ticket" style="font-size: 30px"></i></h6>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>