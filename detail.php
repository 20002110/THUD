<?php

// session_start();

// if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
//   header("location: login.php");
//   exit;
// }

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
  <title><?php echo $film['Name'] ?></title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/detail.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class=" mt-5 bg-dark" style="color:whitesmoke">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top container">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav float-end" style="margin-left: auto!important;">
                    <li class="nav-item ">
                        <a class="nav-link" href="service.php"> Films</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="ticket.php">My Tickets</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['username'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="view_profile.php">Profile</a>
                            <a class="dropdown-item" href="logout.php">Log out</a>
                        </div>
                    </li>

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
          echo '<div class="col-md-6" ><img class="card-img-top mb-5 mb-md-0" id = "img" src="' . $film['image'] . '" alt="..."  style="min-width: 500px; min-height: 715px; object-fit: cover;" /></div>';
          ?>

        <div class="col-md-6 text-center text-md-start">
          <!-- <h1 class="display-5 fw-bolder">Movie Name</h1 -->
          
          <?php
          echo '<h1 class="display-5 fw-bolder">' . $film['Name'] . '</h1>';

          $category = $db->find_data('TypeMovie', 'typeID', $film['typeID']);

          echo '<p class="lead">' . $film['describes'] . '</p>';
          echo '<div class="small mb-1"><span >Diễn viên:  </span>' . $film['performer'] . '</div> ';
          echo '<div class="small mb-1"><span >Thể loại:  </span>' . $category['typeName'] . '</div>';
          echo '<div class="small mb-1"><span >Đạo diễn:  </span>' . $film['director'] . '</div>';
          echo '<div class="small mb-1"><span >Ngôn ngữ:  </span>' . $film['language'] . '</div>';
          echo '<div class="small mb-1"><span >Ngày khởi chiếu:  </span> ' . $film['premiere'] . '</div>';
          echo '<div class="small mb-1"><span>Thời lượng:  </span>' . $film['time'] . '</div>';


          ?>

          <div class="d-flex">
            <button class="btn btn-outline-light flex-shrink-0" type="button" >
            <i class="fa-solid fa-ticket"></i>
              <a href="book.php?id=<?php echo $film['movieID'] ?>" class = "text-decoration-none" style="color: white">Đặt vé</a>
            </button>
          </div><br>
          <div class="d-xxl-inline-flexex">
            <button class="btn btn-outline-light flex-shrink-0" type="button">
            <i class="fa-solid fa-heart"></i>
              Yêu thích
            </button>
            <button class="btn btn-outline-light flex-shrink-0" type="button">
            <i class="fa-solid fa-share"></i>
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
  <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>