
<?php
    include 'handleDB.php';

    $db = new handleDB();

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($db->find_data("Users", "username",$email) == false) {
            if ($password == $confirm_password) {


                $password = password_hash($password, PASSWORD_DEFAULT);

                $data = array(
                    "username" => $email,
                    "password" => $password,
                );

                if ($db->add_data("Users", $data)) {
                    // display success message
                    echo "Thêm thành công";
                    header("Location: login.php");
                    

                } else {
                    echo "<script>alert('Thêm thất bại')</script>";
                }
            } else {
                echo "<script>alert('Mật khẩu không khớp')</script>";
            }
        } else {
            echo "<script>alert('Email đã tồn tại')</script>";
        }
    }

    $db->__destruct();

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

    <title>Register</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>

    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="images/hero-bg.jpg" alt="">
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
                                suppost@gmail.com
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="index.html">
                            <span>
                                
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
                            <ul class="navbar-nav  ">
                                <li class="nav-item ">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="service.php"> Services </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="login.php">Log in</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>


    <section class="contact_section layout_padding">
        <div class="contact_bg_box">
            <div class="img-box">
                <img src="images/contact-bg.jpg" alt="">
            </div>
        </div>
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Register
                </h2>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-7 mx-auto">
                        <form method="post">
                            <div class="contact_form-container">
                                <div>
                                    <div>
                                        <input type="email" placeholder="Email " id = "email" name = "email" required />
                                    </div>
                                    <div>
                                        <input type="password" placeholder="New Password" id = "password" name = "password" required />
                                    </div>
                                    <div>
                                        <input type="password" placeholder="Confirm Password" id = "confirm_password" name="confirm_password" required />
                                    </div>
                                    <div>
                                        <label id="otp" style="display: none"></label>
                                    </div>
                                    <div>
                                        <input type="number" placeholder="OTP" id = "in_otp" name="in_otp" style= "display: none" required />
                                    </div>
                                    <div class="btn-box ">
                                        <button type="submit" name="send_otp" onclick="sendMail()" id = "send_otp">
                                            Send OTP
                                        </button>
                                    </div>
                                    <div class="btn-box ">
                                        <button type="submit" name="submit" id="submit" style="display: none">
                                            Register
                                        </button>
                                    </div>
                                            
                                    <script>
                                        var password = document.getElementById("password")
                                            , confirm_password = document.getElementById("confirm_password");

                                        function validatePassword() {
                                            if (password.value != confirm_password.value) {
                                                confirm_password.setCustomValidity("Passwords Don't Match");
                                            } else {
                                                confirm_password.setCustomValidity('');
                                            }
                                        }

                                        password.onchange = validatePassword;
                                        confirm_password.onkeyup = validatePassword;

                                    </script>

                                    <script>
                                        // emailjs
                                        emailjs.init("6VzQcCIDbGU-WvZ0L")

                                        function sendMail(contactForm) {
                                            document.getElementById("send_otp").style.display = "none";
                                            var receiver = document.getElementById("email").value;

                                            var otp = Math.floor(Math.random() * 1000000);

                                            //  set otp to variable php


                                            var message = "Your OTP to veryfy is " + otp;

                                            var templateParams = {
                                                from_name: "Admin",
                                                to_name: receiver,
                                                message: message,
                                            };

                                            emailjs.send("service_xs8w0pp", "template_06kpj9m", templateParams)
                                                .then(function (response) {
                                                    console.log("SUCCESS!", response.status, response.text);
                                                    //  notice "please check your email to get OTP" in a label
                                                    document.getElementById("otp").style.display = "block";
                                                    document.getElementById("otp").innerHTML = "Please check your email to get OTP";
                                                    document.getElementById("in_otp").style.display = "block";
                                                    // check otp match and display submit button
                                                    document.getElementById("in_otp").onkeyup = function () {
                                                        var get_otp = document.getElementById("in_otp").value;
                                                        if (get_otp == otp) {
                                                            document.getElementById("send_otp").style.display = "none";
                                                            document.getElementById("otp").style.color = "green";
                                                            document.getElementById("otp").innerHTML = "OTP matched";
                                                            document.getElementById("submit").style.display = "block";
                                                        }
                                                        else {
                                                            document.getElementById("send_otp").style.display = "block";
                                                            document.getElementById("send_otp").innerHTML = "Send OTP again";
                                                            document.getElementById("otp").style.color = "red";
                                                            document.getElementById("otp").innerHTML = "OTP does not match";
                                                            document.getElementById("submit").style.display = "none";
                                                        }
                                                    }
                                                }, function (error) {
                                                    console.log("FAILED...", error);
                                                });

                                        }


                                    </script>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                Call : +84 1234567890
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


