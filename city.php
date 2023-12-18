<?php
include_once 'handleDB.php';
$db = new HandleDB();
if (isset($_GET['city'])) {
    $city = $_GET['city'];
    // $city = 'Hà Nội';
    $theaters = $db->find_one('theater', 'location', $city);
    foreach ($theaters as $theater) {
        echo "<div class=\"mb-3\">
                <span class=\"fw-bold\">$theater[theaterName]</span><br>
                <div id=\"showing-time1\" class=\"btn-group\" role=\"group\" style=\"color: whitesmoke\">";
        $theaterID = $theater['theaterID'];
        $date = $_GET['date'];
        $showingTimes = $db->find_by_array('seats', array('theaterID' => $theaterID, 'date' => $date, 'movieID' => $_GET['id']));
        foreach ($showingTimes as $showingTime) {
            echo '<div class="form-check form-check-inline">
                   <input class="form-check-input" type="radio" name="showingTime" id="' . $showingTime['seatID'] . '" value="' . $showingTime['time'] . '" aria-label="time1" onclick="getSeatMap(this)" required>
                    <label class="form-check-label" for="'. $showingTime['time'].'">' . $showingTime['time'] . '</label>
               </div>';
        }

        echo "</div>
            </div>";

    }

}



?>