<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- <link rel="stylesheet" href="styles/add.css"> -->
    <title>Thêm thuộc tính sản phẩm</title>
</head>

<body>
    <header class="header_section">
        <div class="header_top">
            <div class="container-fluid">
                <div class="contact_link-container">
                    <a href="" class="contact_link1">
                        <span>
                            334 Nguyen Trai, Thanh Xuan, Ha Noi
                        </span>
                    </a>
                    <a href="" class="contact_link2">

                        <span>
                            Call : +84123456789
                        </span>
                    </a>
                    <a href="" class="contact_link3">
                        <span>
                            service@gmail.com
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <nav>
            <ul class="navi">
                <li> <a href="#"> Contact </a> </li>
                <li> <a href="./service.php"> Service </a> </li>
                <li> <a href="./index.php"> Home </a> </li>
            </ul>
            </ul>

        </nav>

    </header>

    <form action="#" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="file">URL hình ảnh</label>
            <input type="file" name="file" id="file" class="form-control" required>
            <img src="" id="image" class="img-fluid" alt="Ảnh sản phẩm" required>

            <script>
                var loadFile = function (event) {
                    var image = document.getElementById('image');
                    var file = event.target.files[0];

                    // Kiểm tra file upload là file hình ảnh
                    var fileType = file.type;

                    if (fileType != 'image/jpeg' && fileType != 'image/png' && fileType != 'image/jpg') {
                        alert("Chỉ được upload file hình ảnh");
                        return;
                    }

                    // Tạo URL của file ảnh
                    var url = URL.createObjectURL(file);
                    console.log(url);

                    // Hiển thị ảnh
                    image.src = url;
                };

                // Gắn sự kiện cho thẻ input
                document.getElementById('file').addEventListener('change', loadFile);
            </script>
        </div>


        <div class="form-group">
            <label for="length">Chiều dài</label>
            <input type="number" name="length" id="length" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="width">Chiều rộng</label>
            <input type="number" name="width" id="width" class="form-control" required>
        </div>
        <!-- <div class="form-group">
            <label for="xilanh">Xilanh</label>
            <input type="number" name="xilanh" id="xilanh" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="momen">Mô-men xoắn</label>
            <input type="number" name="momen" id="momen" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gear">Hộp số</label>
            <input type="text" name="gear" id="gear" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="drive">Kiểu dẫn động</label>
            <input type="text" name="drive" id="drive" class="form-control" required>
        </div> -->
        <button type="submit" class="btn btn-primary">Thêm</button>

        <?php

        // include("<THUD>");
        $path = "/var/www/html/THUD/handleDB.php";
        if(file_exists($path)){
           include($path);
        } else{
           die("{$path} không tồn tại");
        }
        $db = new HandleDB();

        $conn = $db->connectDB();

        $db->use_DB($conn, "Admin");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // check submit button is clicked
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $file_name = $_FILES['file']['name'];
            $file_tmp_name = $_FILES['file']['tmp_name'];

            // Di chuyển file lên thư mục lưu trữ
            $upload_dir = 'images/';
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp_name, $file_path)) {
                $url_image = $file_path;
            } else {
                echo "Có lỗi xảy ra khi upload file";
                echo $file_name;
            }

            if (isset($_POST['name']) && isset($_POST['title']) && isset($_POST['length']) && isset($_POST['width']) && isset($_POST['xilanh']) && isset($_POST['momen']) && isset($_POST['gear']) && isset($_POST['drive'])) {
                $name = $_POST['name'];
                $title = $_POST['title'];
                $length = $_POST['length'];
                $width = $_POST['width'];
                $xilanh = $_POST['xilanh'];
                $momen = $_POST['momen'];
                $gear = $_POST['gear'];
                $drive = $_POST['drive'];

                $sql = "INSERT INTO Product (name, title, url, length, width, xilanh, momen, gear, drive) VALUES ('$name', '$title', '$url_image', '$length', '$width', '$xilanh', '$momen', '$gear', '$drive')";

                if ($conn->query($sql) === TRUE) {
                    echo "Sản phẩm đã được thêm thành công";
                    echo $url_image;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Vui lòng nhập đầy đủ thông tin";
            }

            $conn->close();

        }
        ?>
    </form>

</body>

</html>