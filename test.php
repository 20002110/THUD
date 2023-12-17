<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
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
<body class="container mt-5 bg-dark" style="color: whitesmoke">

<h1 class="text-center mb-4">Booking</h1>
<form action="booking.php" method="post">

    <div class="mb-3">
        <h3>Chọn ngày xem:</h3>
        <input type="date" id="date" name="date" class="form-control text-center  mx-auto"
               style="width: 218px">
    </div>
    <hr>
    <div class="mb-3">
        <h3>Thành phố:</h3>
        <div id="city">
            <button type="button" class="btn btn-primary mr-2">Hà Nội</button>
            <button type="button" class="btn btn-primary mr-2">Đà Nẵng</button>
            <button type="button" class="btn btn-primary mr-2">HCM</button>
        </div>
    </div>

    <hr>
    <div class="mb-3">
    <h3>Cụm rạp:</h3>
    <div id="theaters" class="text-center">
        <div class="mb-3">
            <span class="fw-bold">CGV 1</span><br>
            <!-- Chọn giờ xem -->
            <div id="showing-time1" class="btn-group" role="group" style="color: whitesmoke">
                <!-- Thêm radio button cho mỗi giờ xem -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="showingTime" id="time1-1" value="10:00 AM">
                    <label class="form-check-label" for="time1-1">10:00 AM</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="showingTime" id="time1-2" value="2:00 PM">
                    <label class="form-check-label" for="time1-2">2:00 PM</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="showingTime" id="time1-3" value="5:00 PM">
                    <label class="form-check-label" for="time1-3">5:00 PM</label>
                </div>
                <!-- Thêm radio button cho mỗi giờ xem -->
            </div>
            <!-- #endregion -->
        </div>
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
        <!-- decribe seat type vip or nomal -->
        <div>
            <label class="seat btn btn-outline-secondary">
                (A,B)
                <span class="seat-label" style="color: red">VIP</span>
            </label>
            <label class="seat btn btn-outline-secondary">
                (C,D...)
                <span class="seat-label" style="color: red">Normal</span>
            </label>
            <label class="seat btn btn-outline-secondary" style="color: red">
                (RED)
                <span class="seat-label" style="color: red">Booked</span>
            </label>

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