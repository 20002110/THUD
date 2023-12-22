<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

include_once 'handleDB.php';
$db = new HandleDB();
$id = $_GET['id'];


?>

<?php
if (isset($_POST['submit'])) {
    $selectedSeat = $_POST['selectedSeat'];
    $seatID = $_POST['seatID'];
    $userID = $_SESSION['userID'];

    $seatmap = $db->find_data('seats', 'seatID', $seatID);
    $seatMap = $seatmap['seat'];
    $seatMap = json_decode($seatMap, true);
    $newSeatMap = array();

    $ticket = $db->find_last_row('ticket', 'ticketID');
    // check empty ticket
    if (empty($ticket)) {
        $ticketID = 1;
    } else {
        $ticketID = $ticket['ticketID'] + 1;
    }
    foreach ($seatMap as $seat) {
        // if ($seat['seatName'] == $selectedSeat) {
        //     $seat['user_id'] = $userID;
        //     $seat['status'] = 1;
        // }
        foreach ($selectedSeat as $selected) {
            if ($seat['seatName'] == $selected) {
                $seat['user_id'] = $userID;
                $seat['status'] = 1;
                $seat['ticketID'] = $ticketID;
            }
        }
        $newSeatMap[] = $seat;
    }

    $newSeatMap = json_encode($newSeatMap);
    if ($db->update('seats', array('seat' => $newSeatMap), 'seatID', $seatID)) {

        $data = array(
            'user_id' => $userID,
            'seatID' => $seatID,
        );





        if ($db->add_data('ticket', $data)) {
            echo '
        <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <script>


        // emailjs
        emailjs.init("6VzQcCIDbGU-WvZ0L")

        function sendMail(email) {
            var receiver = email;

            var link = "https://danhnt.me/ticket_detail.php?id=" + ' . $ticketID . ';

            console.log(link);


            var message = "Your ticket has been booked successfully. Please click the link below to view your ticket: " + link;

            var templateParams = {
                title : "Xác nhận đặt vé thành công",
                from_name: "Cinema Admin",
                to_name: receiver,
                message: message,
            };

            emailjs.send("service_xs8w0pp", "template_06kpj9m", templateParams)
                .then(function (response) {
                    console.log("SUCCESS!", response.status, response.text);
                
                    // redirect to show_ticket.php
                    window.location.href = "ticket_detail.php?id=" + ' . $ticketID . ';
                
                }, function (error) {
                    console.log("FAILED...", error);
                });

        }


    </script>';

            echo '<script>sendMail("' . $_SESSION['username'] . '")</script>';
            // echo "<script>alert('Đặt vé thành công');</script>";

            // header("location: show_ticket.php?id=$ticketID");
        }
    } else {
        echo "<script>alert('Đặt vé thất bại');</script>";
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom CSS for button hover and active states */
        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-outline-secondary:hover,
        .btn-outline-secondary:active,
        .btn-outline-secondary:focus {
            background-color: #198754;
            border-color: #198754;
        }
    </style>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- <script src="js/custom.js"></script> -->

</head>

<body class="container  bg-dark text-center" style="color: whitesmoke">
    <!-- navbar -->
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

    <h1 class="text-center mb-4">Booking</h1>
    <form method="post">

        <div class="mb-3">
            <h3>Chọn ngày xem:</h3>
            <!-- <input type="date" id="date" name="date" class="form-control text-center  mx-auto" style="width: 218px"> -->
            <div class="form-check form-check-inline">
                <?php
                $today = date("Y-m-d");
                for ($i = 0; $i < 7; $i++) {
                    $date = date('Y-m-d', strtotime($today . ' + ' . $i . ' days'));
                    echo "<div class=\"form-check form-check-inline center\">
                <input class=\"form-check-input\" type=\"radio\" name=\"date\" id=\"date\" value=\"$date\">
                <label class=\"form-check-label\" for=\"date\">$date</label>
            </div>";
                }
                ?>
            </div>

        </div>
        <hr>
        <div class="mb-3">
            <h3>Chọn địa chỉ rạp phim:</h3>
            <div id="city">
                <select name="city" id="city" class="form-select" aria-label="Default select example"
                    onchange="getTheaters()">
                    <option value="" selected>Chọn địa chỉ rạp phim</option>
                    <?php
                    $Theater = $db->findAll('theater');
                    $cities = array();

                    foreach ($Theater as $theater) {
                        #split cities from location
                        $location = explode(',', $theater['location']);
                        $city = end($location);
                        # remove first space and convert to uppercase
                        $city = strtoupper(ltrim($city));
                        if (!in_array($city, $cities)) {
                            $cities[] = $city;
                            echo "<option value=\"$city\">$city</option>";
                        }
                    }

                    ?>
                </select>

            </div>
        </div>

        <hr>
        <div class="mb-3">
            <h3>Cụm rạp:</h3>
            <div id="theaters" class="text-center">

                <script>

                    function getTheaters() {
                        // get city from select 
                        var selectedCity = document.getElementsByName('city')[0].value;
                        // console.log(selectedCity);
                        // get date from radio button
                        var date = document.querySelector('input[name="date"]:checked').value;
                        var id = <?php echo $id ?>;

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("theaters").innerHTML = this.responseText;
                            }
                        };

                        xhttp.open("GET", "city.php?city=" + selectedCity + "&date=" + date + "&id=" + id, true);
                        xhttp.send();
                    }
                </script>


            </div>
        </div>

        <hr>
        <div class="mb-3">
            <h3>Chọn chỗ ngồi:</h3>
            <div id="seatMap">

                <script type="text/javascript">
                    function getSeatMap(selectedTime) {
                        var showingTime = selectedTime.id;
                        console.log(showingTime);

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("seatMap").innerHTML = this.responseText;
                                // console.log(this.responseText);
                            }
                        };

                        xhttp.open("GET", "seatmap.php?seatID=" + showingTime, true);
                        xhttp.send();
                    }

                </script>

            </div>
            <div>
                <label class="seat btn btn-outline-secondary mx-5">
                    (A,B)
                    <span class="seat-label" style="color: green">VIP</span>
                </label>
                <label class="seat btn btn-outline-secondary mx-5">
                    (C,D...)
                    <span class="seat-label" style="color: green">Normal</span>
                </label>
                <label class="seat btn btn-outline-secondary mx-5" style="color: red">
                    (RED)
                    <span class="seat-label" style="color: red">Booked</span>
                </label>

            </div>
        </div>
        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-success" name="submit">Đặt vé</button>
        </div>
    </form>
    <br>


</body>

<!-- footer
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Cinema &copy; 2021</p>
    </div>
</footer> -->


</html>