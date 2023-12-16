<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Update Movie</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
    <style>
        /* Add custom CSS styles here if needed */

        .describes-column {
            max-width: 200px; /* Set your desired maximum width */
            word-wrap: break-word; /* Allow long words to break and wrap onto the next line */
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="images/vinfast.jpeg" alt="">
            </div>
        </div>

        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_link-container">
                        <a href="" class="contact_link1">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                334 Nguyễn Trãi, Thanh Xuân, Hà Nội
                            </span>
                        </a>
                        <a href="" class="contact_link2">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                Call : +84 123456789
                            </span>
                        </a>
                        <a href="" class="contact_link3">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                support@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="index.php">
                            <span>
                                THUD
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.php"> Services </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php ">Log out</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
    <!-- update movie -->
    <?php
    include_once 'HandleDB.php';

    $id = $_GET['updateid'];
    $db = new HandleDB();

    $film = $db->find('movies', "movieiD = $id");

    $name_movie = $film['Name'];
    $director = $film['director'];
    $performer = $film['performer'];
    $time = $film['time'];
    $language = $film['language'];
    $premiere = $film['premiere'];
    $describes = $film['describes'];
    $cost = $film['cost'];
    $image = $film['image'];


    if (isset($_POST['submit'])) {
        $name_movie = mysqli_real_escape_string($db->getConnection(), $_POST['Name']);
        $director  = mysqli_real_escape_string($db->getConnection(), $_POST['director']);
        $performer = mysqli_real_escape_string($db->getConnection(), $_POST['performer']);
        $category = mysqli_real_escape_string($db->getConnection(), $_POST['category']);
        if ($db->find_data('TypeMovie', 'typeName', $category) == false) {
            if ($db->update('TypeMovie', array('typeName' => $category),'movieID', $id)) {
                $typeID = $db->find_data('TypeMovie', 'typeName', $category)['typeID'];
            }
        } else {
            $typeID = $db->find_data('TypeMovie', 'typeName', $category)['typeID'];
        }
        $time  = mysqli_real_escape_string($db->getConnection(), $_POST['time']);
        $language = mysqli_real_escape_string($db->getConnection(), $_POST['language']);
        $premiere = mysqli_real_escape_string($db->getConnection(), $_POST['premiere']);
        $describes = mysqli_real_escape_string($db->getConnection(), $_POST['describes']);
        $cost  = mysqli_real_escape_string($db->getConnection(), $_POST['cost']);

        // Get image
        $image_name = $_FILES['movie_image']['name'];
        $image_size = $_FILES['movie_image']['size'];
        $image_tmp_name = $_FILES['movie_image']['tmp_name'];

        // Validate and sanitize file name
        $image_folder = 'images/' .$image_name;

        // Update movie details in the database
        $update_data = array(
            'Name' => $name_movie,
            'director' => $director,
            'performer' => $performer,
            'typeID' => $typeID,
            'time' => $time,
            'language' => $language,
            'premiere' => $premiere,
            'describes' => $describes,
            'cost' => $cost,
        );

        if (!empty($image_name)) {
            if ($image_size > 5000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $update_data['image'] = $image_folder;
            }
        }

        $update_result = $db->update('movies', $update_data, 'movieID', $id);

        if ($update_result) {
            $message[] = 'Update movie successfully';
            // header("location: manageMovie.php");
            echo "<script> window.location.href='manageMovie.php'; </script>";
            exit;
        } else {
            $message[] = 'Update movie failed!';
        }
    }
    ?>
    <!-- update end -->
    <!-- form -->
    <div class="container py-5">
    <form method="post" enctype="multipart/form-data">
                <!-- start echo message to user -->
                <?php
                    if(isset($message)) {
                        foreach($message as $message) {
                            echo '<div class="alert alert-danger" role="alert">
                                '.$message.'
                            </div>';
                        }
                    }
                ?>
                <!-- end echo mesaage to user -->
                <div class="form-group my-2">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?php echo $name_movie; ?>" placeholder="Enter name" name="Name" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Director</label>
                    <input type="text" class="form-control" value="<?php echo $director; ?>" placeholder="Enter director" name="director" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Performer</label>
                    <textarea rows="5" cols="40" class="form-control" placeholder="Enter performer" name="performer" autocomplete="off"><?php echo $performer; ?></textarea>
                </div>

                <div class="form-group my-2">
                    <?php
                    include_once 'handleDB.php';
                    $db = new HandleDB();

                    // Get the movieID from the URL or wherever you have it
                    $movieID = $_GET['updateid'];

                    // Get the current typeName for the specified movieID
                    $currentMovie = $db->find('movies', "movieID = $movieID");
                    $currentTypeName = $db->find_data('TypeMovie', 'typeID', $currentMovie['typeID'])['typeName'];

                    $typemovivie = $db->findAll('TypeMovie');

                    // Dropdown
                    echo '<label for="category">Category</label>';
                    echo '<select name="category" id="category" class="form-control">';
                    foreach ($typemovivie as $key => $value) {
                        // Set 'selected' if the typeName matches the current movie's typeName
                        $selected = ($value['typeName'] == $currentTypeName) ? 'selected' : '';
                        echo '<option value="' . $value['typeName'] . '" ' . $selected . '>' . $value['typeName'] . '</option>';
                    }
                    echo '</select>';
                    ?>
                </div>


                <div class="form-group my-2">
                    <label>Time</label>
                    <input type="text" class="form-control" value="<?php echo $time; ?>" placeholder="Enter time" name="time" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Language</label>
                    <input type="text" class="form-control" value="<?php echo $language; ?>" placeholder="Enter language" name="language" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Premiere</label>
                    <input type="date" class="form-control" value="<?php echo $premiere; ?>" placeholder="Enter premiere" name="premiere" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Describes</label>
                    <textarea rows="5" cols="40" class="form-control" placeholder="Enter describes" name="describes" autocomplete="off"><?php echo $describes; ?></textarea>
                </div>

                <div class="form-group my-2">
                    <label>Cost</label>
                    <input type="text" class="form-control" value="<?php echo $cost; ?>" placeholder="Enter cost" name="cost" autocomplete="off">
                </div>

                <div class="form-group my-2">
                    <label>Upload movie Image</label>
                    <input type="file" class="form-control" name="movie_image" autocomplete="off">
                </div>
                
                <button type="submit" class="btn btn-primary mt-4" name="submit">Update movie</button>
            </form>
    </div>
    <!-- form end -->
       <!-- info section -->
       <section class="info_section ">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info_info">
                            <h5>
                                Contact Us
                            </h5>
                        </div>
                        <div class="info_contact">
                            <a href="" class="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    334 Nguyễn Trãi, Thanh Xuân, Hà Nội
                                </span>
                            </a>
                            <a href="" class="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call : +84 1234567890
                                </span>
                            </a>
                            <a href="" class="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    support@gmail.com
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info_form ">
                            <h5>
                                Newsletter
                            </h5>
                            <form action="#">
                                <input type="email" placeholder="Enter your email">
                                <button>
                                    Subscribe
                                </button>
                            </form>
                            <div class="social_box">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end info_section -->

        <!-- footer section -->
        <footer class="container-fluid footer_section">
            <p>
                &copy; <span id="currentYear"></span> All Rights Reserved. Design by Admin
            </p>
        </footer>
        <!-- footer section -->

        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/custom.js"></script>

</body>

</html>