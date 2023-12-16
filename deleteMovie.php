<?php
include_once("HandleDB.php");

$db = new HandleDB();

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    // Retrieve information about the movie before deleting it
    $movie = $db->find('movies', "movieID = $id");

    if ($movie) {
        $image_folder = "images/" . $movie['image'];

        // Check if the image file exists before attempting to delete it
        if (file_exists($image_folder)) {
            unlink($image_folder);
        }

        // Use the delete function from HandleDB to delete the record
        $delete_result = $db->delete('movies', 'movieID', $id);

        if($delete_result) {
            $message[] = 'Delete movie successfully';
            header("location: manageMovie.php");
        } else {
            $message[] = 'Delete failed';
        }
    }
}
?>