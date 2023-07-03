<?php 

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once "connectDB.php"; 

    if(!isset($_SESSION['username']))
    {
        header("Location: login.php");
        exit;
    }
    else
    {
        $user = user($_SESSION['username']);
        $nameuser = '';
        $nameuser = $user['fullname'];
        $validate = validate($_SESSION['username']);
        if ($_SESSION['id_role'] == 1) {
            echo "Bạn không đủ quyền truy cập vào trang này<br>";
            echo "<a href='./khachhang.php'> Click để về lại trang chủ</a>";
            exit();
        }
    }
    $name = $nameError= '';
    $loai = -1;
    $chucvuerro = '';
    $tinhtrang = -1;
    $tinhtrangerr = '';
    $gia = $giaerr = '';
    $error = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $name = $_POST['name'];
        $gia = $_POST['gia'];
        $tinhtrang = (int) $_POST['tinhtrang'];
        $loai = (int) $_POST['loai'];
        if(empty($name)){
            $nameError = "Nhập Tên món";
            array_push($error,$nameError);
        }

        if(empty($gia))
        {
            $giaerr = "Nhập Giá";
            array_push($error,$giaerr);
        }

        if($loai == -1)
        {
            $chucvuerro = "Chọn Loại món ăn";
            array_push($error,$chucvuerro);
        }

        if($tinhtrang == -1)
        {
            $tinhtrangerr = "Chọn Tình trạng món ăn";
            array_push($error,$tinhtrangerr);
        }

        if(empty($error)) 
        {
            $idimg = lastrowmonan();
            $sql = "INSERT INTO monan(hinhanh,giamon,available,Tenmon,phanloai)
            VALUES ('','$gia','$tinhtrang','$name','$loai')";
            $mysqli = open_database();
            $query = mysqli_query($mysqli,$sql);
            if($query){
                if(isset($_FILES['input-img']))
                {
                    $mysqli = open_database();
                    $file_name = $_FILES['input-img']['name'];
                    $file_tmp =$_FILES['input-img']['tmp_name'];
                    $idimgt = $idimg.".png";
                    $path = "../imgmonan/$idimgt";
                    if (file_exists( $path)) {
                        unlink($path);
                    }
                    $sql = "UPDATE monan SET hinhanh = '$idimg' WHERE id_monan = '$idimg'";
        
                    $query = mysqli_query($mysqli,$sql);
                    $_POST = array();
                    if($query)
                    {
                        move_uploaded_file($file_tmp,"../imgmonan/".$idimgt);
                    }
                }
                header("Location: ./quanlymonan.php?them=1");
            }
            mysqli_close($mysqli);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../style.css">
    <title>List User</title>
</head>

<body>
    <div id="main" class="js-main">
        <!-- Sidebar -->
        <?php require_once "./sidebarnhanvien.php";?>


            <!-- Header -->
            <div class="header-sidebar">
        <span>Members</span>
        <svg class="show-sidebar-ipad" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path class="icon-showsidebar-vector-first" d="M2 11.5C2 12.3284 2.67157 13 3.5 13H20.5C21.3284 13 22 12.3284 22 11.5V11.5C22 10.6716 21.3284 10 20.5 10H3.5C2.67157 10 2 10.6716 2 11.5V11.5Z" fill="black"/>
                <path class="icon-showsidebar-vector-last" opacity="1" fill-rule="evenodd" clip-rule="evenodd" d="M9.5 20C8.67157 20 8 19.3284 8 18.5C8 17.6716 8.67157 17 9.5 17H20.5C21.3284 17 22 17.6716 22 18.5C22 19.3284 21.3284 20 20.5 20H9.5ZM15.5 6C14.6716 6 14 5.32843 14 4.5C14 3.67157 14.6716 3 15.5 3H20.5C21.3284 3 22 3.67157 22 4.5C22 5.32843 21.3284 6 20.5 6H15.5Z" fill="black"/>
            </g>
        </svg>
        </div>
        <div id="header-main" class="js-header header">
                    <div id="header-menu-main" class="js-header-menu header-menu">
                        <div class="menu-search js-hide-header" >
                            <span>Quản lý món ăn</span>
                        </div>
                        <ul class="menu-itmes js-menu-itmes">
                            <li class="items-icon items-icon-hover js-items-icon" >
                                <span class="icon-name">
                                    <img  src="https://media.istockphoto.com/photos/young-man-arms-outstretched-by-the-sea-at-sunrise-enjoying-freedom-picture-id1285301614" alt="">
                                    <span>
                                        <?=$nameuser?>
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="20" height="20">
                                            <path class="icon-arrow-vector-only" style="font-size: 12px;" d="M18.71,8.21a1,1,0,0,0-1.42,0l-4.58,4.58a1,1,0,0,1-1.42,0L6.71,8.21a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l4.59,4.59a3,3,0,0,0,4.24,0l4.59-4.59A1,1,0,0,0,18.71,8.21Z"/>
                                        </svg>
                                    </span>
                                </span>
                                <ul class="icon-setting-pic js-icon-setting-show bd-rd-rem">
                                    <li class="setting-items"><a href="./profile.php" class="items-link">Profile</a></li>
                                    <li class="setting-items"><a href="./logout.php" class="items-link">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            <!-- Header -->
            <!--  management-user -->
            <!-- start -->
            <div class="management-user">
                <div class="user-list">
                <div class="add-user-header">
                        <div class="add-user-content">
                            <h2 class="add-user-title">Thêm Món</h2>
                    <form id="change-img" method="post" enctype="multipart/form-data" >
                            <div class="img-profile">
                                    <?php 
                                            $imgt = "../imgmonan/default.png";
                                    ?> 
                                    <img id ="anh" src=<?=$imgt?>>
                                    <div class="btn-yes-profile">
                                    <label class="custom-file-upload">
                                        <input name="input-img" type="file" onchange="loadimg(event)"/>
                                        <i class="fas fa-pen"></i>
                                    </label>
                                    </div>
                            </div>
                            <div class="alert alert-danger error-file" id="error-file"style="display:none">Định dạng file không hợp lệ</div>
                                <div class="form-input">
                                    <label for="username">Tên món</label>
                                    <input class="bd-rd-rem" id="name" type="text" value="<?=$name?>"  placeholder="Nhập Tên món" name="name">
                                </div>
                                <div class="alert alert-danger error-fullname" style="display:none">
                                    <?php
                                        if(!empty($nameError))
                                        {
                                            echo "<script>document.querySelector('.error-fullname').style.display = 'block'</script>";
                                            echo $nameError;
                                        }
                                    ?>
                                </div>
                                <div class="form-input">
                                    <label for="cmnd">Giá món</label>
                                    <input class="bd-rd-rem" id="gia" name = "gia" type="number"  value="<?=$gia?>" placeholder="Giá món">
                                </div>
                                <div class="alert alert-danger error-gia" style="display:none">
                                    <?php
                                        if(!empty($giaerr))
                                        {
                                            echo "<script>document.querySelector('.error-gia').style.display = 'block'</script>";
                                            echo $giaerr;
                                        }
                                    ?>
                                </div>
                                <div class="form-input-add">
                                    <label for="phongban">Phân loại</label>
                                    <select class = "chon-phongban" name="loai">
                                        <option value= "-1">Chọn Phân loại</option>
                                        <option value= "1">Nước Uống</option>
                                        <option value= "0">Món ăn</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger error-chucvu" style="display:none">
                                    <?php
                                        if(!empty($chucvuerro))
                                        {
                                            echo "<script>document.querySelector('.error-chucvu').style.display = 'block'</script>";
                                            echo $chucvuerro;
                                        }
                                    ?>
                                </div>
                                <div class="form-input-add">
                                    <label for="phongban">Tình trạng</label>
                                    <select class = "chon-phongban" name="tinhtrang">
                                        <option value= "-1">Chọn Tình trạng</option>
                                        <option value= "1">Còn hàng</option>
                                        <option value= "0">hết hàng</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger error-tinhtrang" style="display:none">
                                    <?php
                                        if(!empty($tinhtrangerr))
                                        {
                                            echo "<script>document.querySelector('.error-tinhtrang').style.display = 'block'</script>";
                                            echo $tinhtrangerr;
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <button onclick="luuanh()" name="adduser" type="button"class="btn-login bd-rd-rem">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script var id = false src="../main.js"></script>

</body>
</html>