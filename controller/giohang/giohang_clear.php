<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa giỏ hàng</title>
</head>
<body>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/api/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/api/db.php');
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    
    $username = $_SESSION['username'];
    
    $sql_get_user = "SELECT kh.makh 
                     FROM taikhoan tk
                     JOIN khachhang kh ON tk.matk = kh.makh
                     WHERE tk.tentk = '$username'";
    $result_user = mysqli_query($conn, $sql_get_user);
    
    if (!$result_user) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result_user) == 0) {
        echo "Không tìm thấy thông tin khách hàng";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }
    
    $row_user = mysqli_fetch_object($result_user);
    $makh = $row_user->makh;

    $sql_get_giohang = "SELECT magio FROM giohang WHERE makh = '$makh'";
    $result_giohang = mysqli_query($conn, $sql_get_giohang);
    
    if (!$result_giohang) {
        die("Lỗi truy vấn giỏ hàng: " . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($result_giohang) > 0) {
        $row_giohang = mysqli_fetch_object($result_giohang);
        $magio = $row_giohang->magio;

        $sql_delete_items = "DELETE FROM giohang_item WHERE magio = '$magio'";
        mysqli_query($conn, $sql_delete_items);
    }
    
    mysqli_close($conn);
    header("Location: giohang.php");
    exit();
    ?>
</body>
</html>
