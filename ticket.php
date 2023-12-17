<?php
if (isset($_POST['submit'])) {
    $selectedSeat = $_POST['selectedSeat'];
    $seatID = $_POST['seatID'];
    $userID = $_SESSION['userID'];

    $seatmap = $db->find_data('seats', 'seatID', $seatID);
    $seatMap = $seatmap['seat'];
    $seatMap = json_decode($seatMap, true);
    $newSeatMap = array();
    foreach ($seatMap as $seat) {
        // if ($seat['seatName'] == $selectedSeat) {
        //     $seat['user_id'] = $userID;
        //     $seat['status'] = 1;
        // }
        foreach ($selectedSeat as $selected) {
            if ($seat['seatName'] == $selected) {
                $seat['user_id'] = $userID;
                $seat['status'] = 1;
            }
        }

        $newSeatMap[] = $seat;
    }

    $newSeatMap = json_encode($newSeatMap);
   if( $db->update('seats', 'seatID', $seatID, array('seat' => $newSeatMap))){
         echo "<script>alert('Đặt vé thành công 1111');</script>";
   }
   else{
    echo "<script>alert('Đặt vé thất bại 11111');</script>";
    }

    $data = array(
        'user_id' => $userID,
        'seatID' => $seatID,
    );
    $db->add_data('ticket', $data);

    $tiketID = $db->find_by_array('ticket', array('user_id' => $userID, 'seatID' => $seatID));

    // header("location: ticket.php?id=$tiketID");
    echo "<script>alert('Đặt vé thành công!');</script>";

}

?>