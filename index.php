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

  <title>HOME</title>

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

<body>
  <div class="hero_area">
    <!-- header section start -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/slide_background.jpg" alt="">
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
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
              <span>
                <i>"THUD"</i>
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="service.php"> Films </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ticket.php"> My ticket </a>
                </li>
                <?php
                session_start();
                if ($_SESSION['username'] == 'admin@gmail.com') {
                  echo '<li class="nav-item">
                  <a class="nav-link" href="addNew.php"> Manager </a>
                </li>';
                }
                ?>
                <?php      
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

    <!-- slider section -->
    <section class=" slider_section  text-center">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-10">
                  <img src="images/slide1.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-10">
                  <img src="images/slide2.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-10">
                  <img src="images/slide3.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="container idicator_container ">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div> -->
      </div>
    </section>
    <!-- end slider section -->
  </div>


  <!-- team section -->
  <section class="py-5 team_section layout_padding" style="background-color: #101010;">
    <div class="container px-4 px-lg-5 mt-5">
      <h2 class="fw-bolder mb-4 text-center text-white">Phim Hot</h2>
      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <!-- <div class="col mb-5">
          <div class="card h-100">
            
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
            
            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
            
            <div class="card-body p-4">
              <div class="text-center">
                
                <h5 class="fw-bolder">New Film</h5>
              </div>
            </div>
            
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
              <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Xem phim</a></div>
            </div>
          </div>
        </div> -->

        <?php
        include_once('handleDB.php');
        $db = new handleDB();
        $films = $db->findALL('Movies');

        $i = 0;

        foreach ($films as $film) {
          echo '<div class = "col-md-6 col-lg-4 mx-auto ">
                <div class = "box" style="background-color: #ffff; border-radius: 10px">
                  <div class = "img-box" >
                    <img src = "' . $film['image'] . '" alt = "..." style="width: 265px; height: 390px; object-fit: cover;"  />
                  </div>
                  <div class = "detail-box ">
                    <h5>
                      ' . $film['Name'] . '
                    </h5>
                    <p>
                      ' . $film['director'] . ' 
                    </p>
                    <a href = "detail.php?id=' . $film['movieID'] . '" class = "btn btn-outline-primary" >
                      Book ticket
                    </a>

  
  
                  </div>
                  <script>
                  // auto resize image to fit the box 265x390

                  </script>
                </div>  
              </div>';

          $i++;

          if ($i == 3) {
            break;
          }
        }

        ?>
      </div>
    </div>
  </section>
  <!-- end team section -->
  <section style="background-color: #101010;" class="py-5 team_section layout_padding text-center">
    <div class="container bg-dark info_section" style="min-height:100px;">
      <h1 class="text-center">Các cụm rạp</h1>
      <hr color="white" />
      <?php
      include_once('handleDB.php');
      $db = new handleDB();
      $theaters = $db->findALL('theater');

      $cities = array();
      foreach ($theaters as $theater) {
        #split cities from location
        $location = explode(',', $theater['location']);
        $city = end($location);
        # remove first space and convert to uppercase
        $city = strtoupper(ltrim($city));

        if (!in_array($city, $cities)) {
          $cities[] = $city;
        }

      }
      foreach ($cities as $c) {
        $theaters = $db->find_one('theater', 'location', $c);
        echo '<div class="row">
                <div class="col-md-3">
                  <h6>' . $c . ' : </h6>
                </div>';
        foreach ($theaters as $theater) {
          echo '
                  <div class="col-md-3">
                    <p>' . $theater['theaterName'] . '</p>
                  </div>';
        }
        echo '</div>';
      }

      ?>

    </div>
  </section>

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
                Call : +84 123456789
              </span>
            </a>
            <a href="" class="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                suppost@gmail.com
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