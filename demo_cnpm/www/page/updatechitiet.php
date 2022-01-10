<?php 
    session_start(); 
    require_once "connectDB.php"; 
    if(isset($_SESSION['username']) && isset($_SESSION['id_role']))
    {
        $user = user($_SESSION['username']);
        $nameuser = '';
        $nameuser = $user['fullname'];
        if ($_SESSION['id_role'] == 1) {
            echo "Bạn không đủ quyền truy cập vào trang này<br>";
            echo "<a href='./khachhang.php'> Click để về lại trang chủ</a>";
            exit();
        }
    }
    else
    {
        header("Location: ./login.php");
        exit;
    }
    $conn  = open_database();
    $array_soluong = []; 
    $longtext ='';
    if(isset($_POST['updatephong']) && isset($_POST['id_dondat']))
    {
        $hoten = $_POST['name'];
        $sdt = $_POST['sdt'];
        $cmnd = $_POST['cmnd'];
        $id_dondat = $_POST['id_dondat'];
        if(mysqli_query($conn,"SELECT * from monan where available = 1"))
        {
            $count= mysqli_query($conn,"SELECT * from monan where available = 1");
            $datanuoc = $count->fetch_all(MYSQLI_ASSOC);
        }
        foreach($datanuoc as $data) 
        {
            $id = $data['id_monan'];
            $tenmon = monan($id)['Tenmon'];
            if(isset($_POST["soluong?$id"]))
            {
                if($_POST["soluong?$id"] ==0)
                    continue;
                $soluongid = $_POST["soluong?$id"]."?"."$id"."?"."$tenmon";
                array_push($array_soluong, $soluongid);
            }
        }
        foreach($array_soluong as $data) 
        {
            $longtext = $longtext.$data.'/';
        }
        $longtext = rtrim($longtext, "/ ");
        $sql = "UPDATE phonghoatdong
        SET hoten = '$hoten', sdt = '$sdt',cmnd = '$cmnd',sdt = '$sdt',monan = '$longtext'
        WHERE id_hoatdong = '$id_dondat'";

        if(mysqli_query($conn,$sql))
        {
            $link ="?checkdat=1"."&idhd=".$id_dondat;
            header("Location: ./chitiethoatdong.php$link");
        }
        else
        {
            $link ="?checkdat=0"."&idhd=".$id_dondat;
            header("Location: ./chitiethoatdong.php$link");
        }
    }
    mysqli_close($conn);
?>