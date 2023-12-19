<?php
  session_start();
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

  <link rel="stylesheet" href="js/custom.js">

</head>

<body>
  <div class="hero_area">
    <!-- header section start -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="images/slider_bg.jpeg" alt="">
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

    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      <i>"THUD"</i> <br>
                      <span>
                        Cùng bạn trên mọi hành trình
                      </span>
                    </h1>
                    <p>
                      Trải nghiệm sự khác biệt của <i>"THUD"</i> với
                      <span class="text-primary">hơn 10000</span>
                      xe rộng khắp Hà Nội và TP.Hồ Chí Minh
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1"> Xe tự lái </a>
                      <a href="" class="btn-2">Xe có tài xế</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      Chương trình <br>
                      <span>
                        khuyến mãi
                      </span>
                    </h1>
                    <p>
                      Nhận nhiều
                      <span class="text-primary">ưu đãi</span>
                      hấp dẫn từ <i>"THUD"</i> với nhiều khuyến mãi trên tất cả các dịch vụ hiện có
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1">Tìm hiểu ngay</a>
                      <!-- <a href="" class="btn-2">Get A Quote</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">

                    <h1>
                      An toàn của bạn <br>
                      <span>
                        Trách nhiệm của chúng tôi
                      </span>
                    </h1>
                    <p>
                      Chúng tôi cam kết về an toàn của khách hàng trong quá trình trải nghiệm dịch vụ
                      <br>
                      Mọi thông tin chi tiết được nằm trong
                      <span class="text-primary">điều khoản dịch vụ</span>
                    </p>
                    <div class="btn-box">
                      <a href="" class="btn-1">Tìm hiểu ngay</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container idicator_container">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img_container">
            <div class="img-box">
              <img src="images/who_are_we.jpg" alt="" />
            </div>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="detail-box">
            <div class="heading_container ">
              <h2>
                <i>"THUD"</i> - slogan
              </h2>
            </div>
            <p>
              Chúng tôi quan niệm rằng, mỗi chuyến đi là một hành trình trải nghiệm và khám phá, là cơ hội để bản thân
              tìm hiểu
              những khoảnh khắc mới mẻ trong cuộc sống. Do đó, chất lượng dịch vụ, trải nghiệm người dùng là ưu tiên
              hàng đầu và
              là nguồn cảm hứng của chúng tôi xuyên suốt của trình hoạt động.
              <br><br>
              <i>"THUD"</i> là nền tảng cho thuê xe với đa dạng phân khúc, mẫu mã. Chúng tôi không chỉ dừng lại
              với việc kết nối với khách hàng một cách nhanh chóng, đảm bảo chất lượng xe an toàn, bên cạnh đó chúng tôi
              còn
              hướng tới trải nghiệm của khách hàng một cách tốt nhất trong quá trình trải nghiệm dịch vụ.

            </p>
            <!-- <div class="btn-box">
              <a href="">
                Read More
              </a>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="images/get_in_touch.jpg" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Get In touch
        </h2>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <form action="#">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Full Name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Email " />
                  </div>
                  <div>
                    <input type="text" placeholder="Phone Number" />
                  </div>
                  <div class="">
                    <input type="text" placeholder="Message" class="message_input" />
                  </div>
                  <div class="btn-box ">
                    <button type="submit">
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- team section -->
  <section class="team_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Dịch vụ của chúng tôi
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-6 mx-auto ">
          <div class="box">
            <div class="img-box">
              <img src="images/lux_A2_resize.jpg" alt="">
            </div>
            <div class="detail-box">
              <h3> Xe tự lái </h3>
              <p> Quận Thanh Xuân, Hà Nội </p>
              <div class="btn-box">
                <a href="service.php"> Thuê xe tự lái </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 mx-auto ">
          <div class="box">
            <div class="img-box">
              <img src="images/vf6_1_resize.jpg">
            </div>
            <div class="detail-box">
              <h3> Xe có tài xế </h3>
              <p> Quận 1, Hồ Chí Minh </p>
              <div class="btn-box">
                <a href="service.php"> Thuê xe có tài xế </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end team section -->

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