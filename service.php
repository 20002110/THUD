<?php
session_start();

include 'handleDB.php';
$db = new HandleDB();
?>

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

  <title> Films </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/background.jpg" alt="">
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
                Call : +84 1234567890
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
                CGV*
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">

                <!-- filter dropdown -->

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Filter
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item" href="service.php">All</a>
                    <a class="dropdown-item" href="service.php?filter=Porsche">Porsche</a>
                    <a class="dropdown-item" href="service.php?filter=Vinfast">Vinfast</a>
                    <a class="dropdown-item" href="service.php?filter=Ferrari">Ferrari</a> -->
                    <?php
                    $result = $db->findAll('TypeMovie');
                    foreach ($result as $type) {
                      echo '<a class="dropdown-item" href="service.php?filter=' . $type['typeID'] . '">' . $type['typeName'] . '</a>';
                    }

                    ?>
                  </div>
                </li>

                <!-- search bar -->
                <li class="nav-item">
                  <div class="search-container">
                    <form method="post" action="">
                      <input type="text" placeholder="Search.." name="search">
                      <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                      <!-- <input type ="submit"  class="fa fa-search"  value=""> -->
                    </form>
                  </div>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="service.php"> Films </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="ticket.php"> my ticket </a>
                </li>
                <?php
                if ($_SESSION['username'] == 'admin@gmail.com') {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="addNew.php"> Manager </a>
                </li>';
                }
                ?>
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                  echo '  <li class="nav-item dropdown ">  
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ' . $_SESSION['username'] . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view_profile.php">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </li>';

                } else {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="login.php"> Login </a>
                </li>';
                }
                ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->

    <!-- product line section -->
    <section class="team_section layout_padding">
      <div class="container">
        <div class="row">
          <?php




          if (isset($_POST['submit'])) {
            $search = $_POST['search'];

            $result = $db->find_by_data('Movies', $search);

            if ($result) {
              foreach ($result as $service) {
                echo '<div class = "col-md-6 col-lg-4 mx-auto ">
                <div class = "box" style="background-color: #ffff; border-radius: 10px">
                  <div class = "img-box" >
                    <img src = "' . $service['image'] . '" alt = "..." style="min-width: 265px; min-height: 390px; object-fit: cover;"  />
                  </div>
                  <div class = "detail-box ">
                    <h5>
                      ' . $service['Name'] . '
                    </h5>
                    <p>
                      ' . $service['director'] . ' 
                    </p>
                    <a href = "detail.php?id=' . $service['movieID'] . '" class = "btn btn-outline-primary" >
                      Read More
                    </a>

  
  
                  </div>
                  <script>
                  // auto resize image to fit the box 265x390

                  </script>
                </div>  
              </div>';

              }
            } else {
              echo "<p style='color: red'>Không có dữ liệu</p>";

            }


          } elseif (isset($_GET['filter'])) {
            $filter = $_GET['filter'];

            $result = $db->find_movie('Movies', 'typeID', $filter);

            if ($result) {
              foreach ($result as $service) {
                echo '<div class = "col-md-6 col-lg-4 mx-auto ">
                <div class = "box" style="background-color: #ffff; border-radius: 10px">
                  <div class = "img-box" >
                    <img src = "' . $service['image'] . '" alt = "..." style="min-width: 265px; min-height: 390px; object-fit: cover;"  />
                  </div>
                  <div class = "detail-box ">
                    <h5>
                      ' . $service['Name'] . '
                    </h5>
                    <p>
                      ' . $service['director'] . '
                    </p>
                    <a href = "detail.php?id=' . $service['movieID'] . '" class = "btn btn-outline-primary" >
                      Read More
                    </a>
  
  
                  </div>
                </div>
              </div>';

              }
            } else {
              echo "<p style='color: red'>Không có dữ liệu</p>";

            }

          } else {
            $result = $db->find_by_data('Movies', '');

            if ($result) {
              foreach ($result as $service) {
                echo '<div class = "col-md-6 col-lg-4 mx-auto ">
                <div class = "box" style="background-color: #ffff; border-radius: 10px">
                  <div class = "img-box" >
                    <img src = "' . $service['image'] . '" alt = "" style="min-width: 265px; min-height: 390px; object-fit: cover;"  />
                  </div>
                  <div class = "detail-box ">
                    <h5>
                      ' . $service['Name'] . '
                    </h5>
                    <p>
                      ' . $service['director'] . '
                    </p>
                    <a href = "detail.php?id=' . $service['movieID'] . '" class = "btn btn-outline-primary" >
                      Chi tiết
                    </a>
  
                  </div>
                </div>
              </div>';

              }
            } else {
              echo "<p style='color: red'>Không có dữ liệu</p>";
            }
          }

          ?>

        </div>

      </div>

    </section>
    <!-- end product line section -->

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