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
    $conn = open_database();
    $limit = 10;
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $type = isset($_GET['type'])? $_GET['type'] : 0;
    $del_id = isset($_GET['delid'])? $_GET['delid'] : null;
    $res_id = isset($_GET['resid'])? $_GET['resid'] : null;
    $start = ($page -1 ) * $limit;
    $them = isset($_GET['them'])? $_GET['them'] : 0;
    $chinhsua = isset($_GET['chinhsua'])? $_GET['chinhsua'] : 0;

   

  

    if(mysqli_query($conn,"SELECT * from phong LIMIT $start, $limit"))
    {
        $count= mysqli_query($conn,"SELECT * from phong LIMIT $start, $limit");
        $data = $count->fetch_all(MYSQLI_ASSOC);
    }
    else
    {
        exit;
    }
    $count= mysqli_query($conn,"SELECT count(*) as total from phong");
    $total = $count->fetch_assoc();
    $pages = ceil($total['total']/$limit);

  
    $previous = $page - 1;
    $next = $page + 1;
    mysqli_close($conn);
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
                            <span>Quản lý Phòng hát</span>
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
                <?php 
                if($them ==1)
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Thành công!</strong>   Thêm Phòng thành công!   
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
    
             ?>
             <?php 
                if($chinhsua ==1)
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Thành công!</strong>  Chỉnh Sửa Phòng thành công!   
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
             ?>
                    <div class="list-header">
                        <div class="header-title">
                            <h4>Danh sách Phòng hát<h6>- <?php echo $total['total'] ?></h6></h4>
                        </div>
                        <div class="header-choose">
                            <a href="./themphong.php" class="user-add" style="text-decoration: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path class="icon-adduser-vector-first" d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.9"/>
                                            <path class="icon-adduser-vector-last" d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                    <span>Thêm Phòng hát</span>
                                </a>
                        </div>
                        
                    </div>
                    <div class="header-content-table">
                        <div class="table-data-list">
                            <div class="list-management-user">
                                <table class="user-table">
                                    <tr class="title-table">
                                        <th>Tên Phòng</th>
                                        <th>Giá Phòng</td>
                                        <th>Trạng thái</th>
                                        <th>Loại</th>
                                        <th>Chỉnh sửa</td>
                                    </tr>          
                                    <?php 
                                        foreach($data as $userinfor) : ?>
                                                <tr class="title-content">
                                                <td>
                                                    <div class="infor-employ">
                                                        <div><?= $userinfor['tenphong'] ?> </div>
                                                    </div>
                                                </td>
                                                <td><?= $userinfor['giaphong']."K" ?></td>
                                                <td> <?php 
                                                    if($userinfor['active'] == 1)
                                                        echo "Đang hoạt động";
                                                    else if($userinfor['active'] == 0)
                                                        echo "Không hoạt động";
                                                ?></td>
                                                <td><?php 
                                                    if($userinfor['check_room'] == 1)
                                                        echo "Phòng Vip";
                                                    else if($userinfor['check_room'] == 0)
                                                        echo "Phòng Thường";
                                                ?></td>
                                                <td class="see-edit-delete">
                                                    <a href="./suaphong.php?idmon=<?=$userinfor['id_phong']?>" class="link-edit bd-rd-rem" onclick="showModalEdituser()">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19.5px" height="19.5px" viewBox="0 0 24 24" version="1.1">										
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											
                                                                <rect x="0" y="0" width="24" height="24"></rect>											
                                                                <path class="icon-edit-vector-first" d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) " opacity="0.9"></path>											
                                                                <path class="icon-edit-vector-last" d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.5"></path>										
                                                            </g>									
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                           
                                    <?php endforeach; ?>
                                </table>
                            </div>
                            <ul class="list-user-page">
                                <div>
                                    <li class="arrow-back-list-user">
                                    <a <?php if($page == 1)
                                                echo "";
                                            else
                                                echo "href=./quanlyphonghat.php?page=1";               
                                        ?>>
                                        <div><i class="fas fa-angle-double-left"></i></div>
                                    </a>
                                    </li>
                                    <li class="arrow-back-list-user">
                                        <a <?php if($previous<1)
                                                echo "";
                                            else
                                                echo "href=./quanlyphonghat.php?page=".$previous;  
                                        ?>>
                                            <div><i class="fas fa-angle-left"></i></div>
                                        </a>
                                    </li>
                                    <?php 
                                        for($i=1;$i<=$pages;$i++) : ?>
                                    <li class="number-page-list-user">
                                    <a <?php if($i==$page)
                                                echo "";
                                            else
                                                echo "href=./quanlyphonghat.php?page=".$i;  
                                        ?>>
                                        <div>
                                             <?= $i; ?>
                                        </div>
                                     </a>
                                    </li>
                                    <?php endfor; ?>
                                    <li class="arrow-arrive-list-user">
                                    <a <?php if($next>$pages)
                                                echo "";
                                            else
                                                echo "href=./quanlyphonghat.php?page=".$next;               
                                        ?>>
                                        <div><i class="fas fa-angle-right"></i></div>
                                    </a>
                                    </li>
                                    <li class="arrow-arrive-list-user">
                                    <a <?php if($page == $pages)
                                                echo "";
                                            else
                                                echo "href=./quanlyphonghat.php?page=".$pages;               
                                        ?>>
                                        <div><i class="fas fa-angle-double-right"></i></div>
                                    </a>
                                    </li>
                                </div>
                                <div class="show-total-page">
                                    <span>Đang xem Trang <?= $page?></span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script var id = false src="../main.js"></script>

</body>
</html>