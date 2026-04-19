<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật giỏ hàng</title>
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
    
    $maitem = isset($_REQUEST["maitem"]) ? $_REQUEST["maitem"] : "";
    $soluong = isset($_REQUEST["soluong"]) ? $_REQUEST["soluong"] : 1;
    
    if (empty($maitem)) {
        echo "Không tìm thấy sản phẩm trong giỏ hàng";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }
    
    if ($soluong < 1) {
        echo "Số lượng phải lớn hơn 0";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }

    $sql_get_item = "SELECT gi.masp, sp.sl as sl_kho 
                     FROM giohang_item gi
                     JOIN sanpham sp ON gi.masp = sp.masp
                     WHERE gi.maitem = '$maitem'";
    $result_item = mysqli_query($conn, $sql_get_item);
    
    if (!$result_item || mysqli_num_rows($result_item) == 0) {
        echo "Không tìm thấy sản phẩm trong giỏ hàng";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }
    
    $row_item = mysqli_fetch_object($result_item);
    
    if ($soluong > $row_item->sl_kho) {
        echo "Số lượng yêu cầu vượt quá số lượng tồn kho (còn " . $row_item->sl_kho . " sản phẩm)";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }
    
    // Cập nhật số lượng
    $sql_update = "UPDATE giohang_item SET sl = '$soluong' WHERE maitem = '$maitem'";
    mysqli_query($conn, $sql_update);
    
    header("Location: giohang.php");
    ?>
</body>
</html>
