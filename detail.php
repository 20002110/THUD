<?php

session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  header("location: login.php");
  exit;
}

include_once 'handleDB.php';
$db = new HandleDB();

$id = $_GET['id'];
// $id = 3;

$film = $db->find_data('Movies', 'movieID', $id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Shop Film - Start Bootstrap Template</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/detail.css" rel="stylesheet" />
</head>

<body class="bg-dark" style="color:whitesmoke">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
           <div class="container px-4 px-lg-5">
               <a class="navbar-brand" href="#!">THUD</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                       <li class="nav-Film"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                       <li class="nav-Film"><a class="nav-link" href="#!">About</a></li>
                   </ul>
               </div>
           </div>
       </nav>
  <!-- Product section -->
  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-Films-center">
        <!-- <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
            src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div> -->
          <?php
          echo '<div class="col-md-6" ><img class="card-img-top mb-5 mb-md-0" id = "img" src="' . $film['image'] . '" alt="..." /></div>';
          ?>

<script>
//        auto resize image to 600x700

            var image = document.getElementById('img');

            // auto resize image to fit content image
            var reader = new FileReader();

            reader.onload = function () {
                var dataURL = reader.result;
                var output = new Image();
                output.src = dataURL;
                output.onload = function () {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(output, 0, 0);

                    var MAX_WIDTH = 600;
                    var MAX_HEIGHT = 700;
                    var width = output.width;
                    var height = output.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    var ctx = canvas.getContext("2d");
                    ctx.drawImage(output, 0, 0, width, height);

                    var dataurl = canvas.toDataURL(fileType);
                    image.src = dataurl;
                }
            };

            reader.readAsDataURL(file);



          </script>




        <div class="col-md-6 text-center text-md-start">
          <!-- <h1 class="display-5 fw-bolder">Movie Name</h1 -->
          
          <?php
          echo '<h1 class="display-5 fw-bolder">' . $film['Name'] . '</h1>';

          $category = $db->find_data('TypeMovie', 'typeID', $film['typeID']);

          echo '<p class="lead">' . $film['describes'] . '</p>';
          echo '<div class="small mb-1">Diễn viên: ' . $film['performer'] . '</div>';
          echo '<div class="small mb-1">Thể loại: ' . $category['typeName'] . '</div>';
          echo '<div class="small mb-1">Đạo diễn: ' . $film['director'] . '</div>';
          echo '<div class="small mb-1">ngôn ngữ: ' . $film['language'] . '</div>';
          echo '<div class="small mb-1">Ngày công chiếu: ' . $film['premiere'] . '</div>';
          echo '<div class="small mb-1">Thời lượng: ' . $film['time'] . '</div>';


          ?>

          <div class="d-flex">
            <button class="btn btn-outline-light flex-shrink-0" type="button">
              <i class="bi-cart-fill me-1"></i>
              Mua vé
            </button>
          </div><br>
          <div class="d-xxl-inline-flexex">
            <button class="btn btn-outline-light flex-shrink-0" type="button">
              <i class="bi-cart-fill me-1"></i>
              Yêu thích
            </button>
            <button class="btn btn-outline-light flex-shrink-0" type="button">
              <i class="bi-cart-fill me-1"></i>
              Chia sẻ
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Related Films section-->
  <section class="py-5 bg-light" style="color: black">
    <div class="container px-4 px-lg-5 mt-5">
      <h2 class="fw-bolder mb-4">Related movies</h2>
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
        $typeID = $film['typeID'];
        $films = $db->find_movie('Movies', 'typeID', $typeID);
        
        $i = 0;

        foreach ($films as $film) {
          if ($film['movieID'] == $id) {
            continue;
          }
          echo '<div class="col mb-5">';
          echo '<div class="card h-100">';
          echo '<img class="card-img-top" src="' . $film['image'] . '" alt="..." />';
          echo '<div class="card-body p-4">';
          echo '<div class="text-center">';
          echo '<h5 class="fw-bolder">' . $film['Name'] . '</h5>';
          echo '</div>';
          echo '</div>';
          echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
          echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/detail.php?id=' . $film['movieID'] . '">Xem phim</a></div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          $i++;

          if ($i == 3) {
            break;
          }
        }

        ?>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>