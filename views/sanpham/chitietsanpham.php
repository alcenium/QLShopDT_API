<?php
include($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/api/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/api/db.php');
include "../../includes/header.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$masp = isset($_REQUEST["masp"]) ? $_REQUEST["masp"] : 0;

$sql_sp = "SELECT * FROM sanpham WHERE masp = '$masp'";
$result_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_assoc($result_sp);

if (!$row_sp) {
    echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href='trangchu.php';</script>";
    exit();
}

$sql_ts = "SELECT * FROM thongso WHERE masp = '$masp'";
$result_ts = mysqli_query($conn, $sql_ts);

$username = $_SESSION['username'];
$sql_tk = "SELECT * FROM taikhoan WHERE tentk = '$username'";
$result_tk = mysqli_query($conn, $sql_tk);
$row_tk = mysqli_fetch_assoc($result_tk);
$matk = $row_tk['matk'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - <?php echo $row_sp['tensp']; ?></title>
    <link rel="stylesheet" href="../../assets/css/nv.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body>
    <br>
    <h1 align="center">CHI TIẾT SẢN PHẨM</h1>

    <table width="1200" align="center" border="1" cellpadding="10">
        <tr>
            <td width="400" align="center" valign="top">
                <!-- Hiển thị hình ảnh sản phẩm -->
                <?php if (!empty($row_sp['hinhanh'])): ?>
                    <img src="./img/<?php echo $row_sp['hinhanh']; ?>" 
                         alt="<?php echo $row_sp['tensp']; ?>" 
                         width="350">
                <?php else: ?>
                    <img src="<img src=./img/<?php echo $hinhanh; ?>"
                         alt="Không có hình ảnh" 
                         width="350">
                <?php endif; ?>
            </td>
            
            <td valign="top">
                <!-- Thông tin sản phẩm -->
                <h2><?php echo $row_sp['tensp']; ?></h2>
                
                <table width="100%" border="0">
                    <tr>
                        <th colspan="2">Thông tin sản phẩm</th>
                    </tr>
                    <tr>
                        <td><strong>Hãng:</strong></td>
                        <td><?php echo $row_sp['hang']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Giá:</strong></td>
                        <td style="color: red; font-size: 24px; font-weight: bold;">
                            <?php echo number_format($row_sp['gia'], 0, ',', '.'); ?> đ
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Bảo hành:</strong></td>
                        <td><?php echo $row_sp['baohanh']; ?> tháng</td>
                    </tr>
                    <tr>
                        <td><strong>Số lượng còn:</strong></td>
                        <td><?php echo $row_sp['sl']; ?> sản phẩm</td>
                    </tr>
                    <tr>
                        <td><strong>Ghi chú:</strong></td>
                        <td><?php echo $row_sp['ghichu']; ?></td>
                    </tr>
                </table>
                
                <br>
                
                <!-- Form thêm vào giỏ hàng -->
                <form method="post" action="./../giohang/giohang_insert.php?txt_masp=<?php echo $masp ?>">
                    <input type="hidden" name="masp" value="<?php echo $masp; ?>">
                    <table border="0">
                        <tr>
                            <td><strong>Số lượng:</strong></td>
                            <td>
                                <input type="number" name="soluong" value="1" min="1" 
                                       max="<?php echo $row_sp['sl']; ?>" style="width: 80px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                <input type="submit" value="THÊM VÀO GIỎ HÀNG" 
                                       style="padding: 10px 20px; font-size: 16px; cursor: pointer;">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        
        <!-- Phần thông số kỹ thuật -->
        <tr>
            <td colspan="2">
                <h2>THÔNG SỐ KỸ THUẬT</h2>
                <table width="100%" border="1" cellpadding="8">
                    <tr>
                        <th width="200">Tên thông số</th>
                        <th>Giá trị</th>
                    </tr>
                    <?php 
                    if (mysqli_num_rows($result_ts) > 0) {
                        while($row_ts = mysqli_fetch_assoc($result_ts)) {
                    ?>
                        <tr>
                            <td><strong><?php echo $row_ts['tents']; ?></strong></td>
                            <td><?php echo nl2br($row_ts['giatri']); ?></td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="2" align="center">Chưa có thông số kỹ thuật</td>
                        </tr>
                    <?php 
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>