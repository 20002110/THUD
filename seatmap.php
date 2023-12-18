
<?php
include_once 'handleDB.php';
$db = new HandleDB();

if (isset($_GET['seatID'])) {
    $seatID = $_GET['seatID'];
    $seats = $db->find_data('seats', 'seatID', $seatID);
    $seatMap = $seats['seat'];
    # decode json string to array
    $seatMap = json_decode($seatMap, true);
    # json [{"seatName":"A1","user_id":0,"status":0},....
    $theter = $db->find_data('theater', 'theaterID', $seats['theaterID']);
    $columns = $theter['col'];
    $rows = $theter['row'];


    foreach ($seatMap as $seat) {
        // check new row of seat by regex 1 in seatName
        if (preg_match('/1/', $seat['seatName'])) {
            echo "<div class=\"seat-row mb-3\">";
        }

        if ($seat['status'] == 0) {
            echo "<label class=\"seat btn btn-outline-secondary mx-3 \">
        <input type=\"checkbox\" name=\"selectedSeat[]\" value=\"$seat[seatName]\">
        <span class=\"seat-label mx-3\">$seat[seatName]</span>
        </label>";
        } else {
            echo "<label class=\"seat btn btn-outline-secondary mx-3\">
        <input type=\"checkbox\" value=\"$seat[seatName]\" disabled checked>
        <span class=\"seat-label mx-3\" style=\"color: red\">$seat[seatName]</span>
        </label>";
        }
        if(preg_match('/'.$columns.'/', $seat['seatName'])){
            echo "</div>";
            $check = false;
        }
    }

    echo '<input type="hidden" name="seatID" id="seatID" value="'.$seatID.'">';
    
}
?>
