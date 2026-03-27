<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa khách hàng</title>
</head>
<body>
    <?php
    include "../../includes/api_helper.php";

    $makh = $_GET['makh'] ?? 0;

    // Gọi API để xóa khách hàng
    $result = callKhachhangAPI([
        "action" => "delete",
        "makh"   => $makh
    ]);

    if ($result && $result['status']) {
        header("Location: khachhang.php");
        exit();
    } else {
        echo "<h3>Xóa thất bại</h3>";
        echo "<p>" . ($result['message'] ?? 'Lỗi không xác định') . "</p>";
        echo "<p><a href='khachhang.php'>Quay lại</a></p>";
    }
    ?>
</body>
</html>