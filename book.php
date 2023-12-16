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
</head>

<body class="container mt-5 bg-dark text-center" style="color: whitesmoke">

    <h1 class="text-center mb-4">Booking</h1>
    <form action="booking.php" method="post">

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
            <h3>Thành phố:</h3>
            <div id="city">
                <select name="city" id="city" class="form-select" aria-label="Default select example"
                    onchange="getTheaters()">
                    <option value="" selected>Chọn thành phố</option>
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
                        var selectedCity = document.getElementById("city").value;
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
                <?php
                $totalRows = 5;
                $seatsPerRow = 10;

                for ($row = 1; $row <= $totalRows; $row++) {
                    echo "<div class=\"seat-row\">";
                    for ($seat = 1; $seat <= $seatsPerRow; $seat++) {
                        echo "<label class=\"seat btn btn-outline-secondary\">
            <input type=\"radio\" name=\"selectedSeat\" value=\"$row-$seat\">
            <span class=\"seat-label\">$row-$seat</span>
            </label>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Đặt vé</button>
        </div>

    </form>
    <br>
</body>

</html>