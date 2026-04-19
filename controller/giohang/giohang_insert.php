<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm vào giỏ hàng</title>
</head>
<body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/api/db.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/giohang/GioHang_db.php');
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }

    $masp = isset($_REQUEST["masp"]) ? $_REQUEST["masp"] : "";
    $sl_them = isset($_REQUEST["soluong"]) ? $_REQUEST["soluong"] : 1;


    $username = $_SESSION['username'];

    // Tìm mã khách hàng theo tên tài khoản
    $makh = GioHang_db::timMaKH($username);

    if (!$makh) {
        echo "Không tìm thấy thông tin khách hàng. Vui lòng đăng ký trước.";
        echo "<br><a href='/QLShopDT_API/view/register.php'>Quay lại</a>";
        exit();
    }

    
    // Kiểm tra người dùng có giỏ hàng không
    $magio = GioHang_db::giohangTonTai($makh);
    if (!$magio)
    {
        $magio = GioHang_db::taoGioHang($makh);
    }


    // Kiểm tra sự tồn tại của sản phẩm trong giỏ hàng :v
    $sanPham = GioHang_db::sanphamTonTai($magio, $masp);

    if (!$listSanPham) {
        $sl_sp = $sanPham[0]['sl'];
        $sl_moi = $sl_sp + $sl_them;

        if ($soluong_moi > $sl_sp) {
            echo "Không thể thêm. Tổng số lượng vượt quá số lượng trong kho (còn " . $sl_sp . " sản phẩm)";
            echo "<br><a href='giohang_add.php'>Quay lại</a>";
            exit();
        }
        
        GioHang_db::suaSoLuong($magio, $masp, $soluong_moi);
    } else {
        GioHang_db::themSanPham($magio, $masp, $sl_them);
    }

    header("Location: giohang.php");
    ?>
</body>
</html>
