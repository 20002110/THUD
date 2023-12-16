<?php
include_once 'handleDB.php';
$db = new HandleDB();

if (isset($_GET['city'])) {
    // $city = $_GET['city'];
    $city = 'Hà Nội';
    $theaters = $db->find_one('theater', 'location', $city);
    foreach ($theaters as $theater) {
        echo "<div class=\"mb-3\">
                <span class=\"fw-bold\">$theater[theaterName]</span><br>
                <div id=\"showing-time1\" class=\"btn-group\" role=\"group\" style=\"color: whitesmoke\">";
        $theaterID = $theater['theaterID'];
        $date = $_GET['date'];
        $showingTimes = $db->find_by_array('seats', array('theaterID' => $theaterID, 'date' => $date));
        foreach ($showingTimes as $showingTime) {
            echo '<input type="radio" class="btn-check " name="showingTime" id="' . $showingTime['seatID'] . '" value="' . $showingTime['time'] . '" autocomplete="off" required>
                            <label class="btn btn-outline-secondary " for="showingTime1">' . $showingTime['time'] . '</label>';

        }

        echo "</div>
            </div>";

    }

}

?>