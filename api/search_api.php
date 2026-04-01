<?php
header("Content-Type: application/json");

include "db.php";

$data   = json_decode(file_get_contents("php://input"), true);
$action = isset($data['action']) ? $data['action'] : '';

// ===================== TÌM KIẾM SẢN PHẨM =====================
if ($action == 'search') {
    $keyword = $conn->real_escape_string(trim($data['keyword'] ?? ''));
    $madm    = intval($data['madm'] ?? 0);

    // Xây điều kiện WHERE động
    $conditions = [];

    if ($keyword !== '') {
        $conditions[] = "(tensp LIKE '%$keyword%' OR hang LIKE '%$keyword%' OR ghichu LIKE '%$keyword%')";
    }

    if ($madm > 0) {
        $conditions[] = "madm = $madm";
    }

    $where = !empty($conditions) ? 'WHERE ' . implode(' AND ', $conditions) : '';

    $sql    = "SELECT * FROM sanpham $where ORDER BY masp DESC";
    $result = $conn->query($sql);

    if ($result) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode([
            "status"  => true,
            "message" => "Tìm kiếm thành công",
            "keyword" => $keyword,
            "madm"    => $madm,
            "data"    => $rows,
            "total"   => count($rows)
        ]);
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi: " . $conn->error]);
    }
}

// ===================== LẤY SẢN PHẨM NỔI BẬT (trang chủ) =====================
else if ($action == 'featured') {
    $limit = intval($data['limit'] ?? 12);

    $sql    = "SELECT * FROM sanpham ORDER BY masp DESC LIMIT $limit";
    $result = $conn->query($sql);

    if ($result) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode([
            "status"  => true,
            "message" => "Lấy sản phẩm nổi bật thành công",
            "data"    => $rows,
            "total"   => count($rows)
        ]);
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi: " . $conn->error]);
    }
}

else {
    echo json_encode([
        "status"  => false,
        "message" => "Action không hợp lệ. Sử dụng: search, featured"
    ]);
}

$conn->close();
?>