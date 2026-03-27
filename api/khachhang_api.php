<?php
header("Content-Type: application/json");

// Kết nối database
include "db.php";

// Đọc dữ liệu từ input
$data   = json_decode(file_get_contents("php://input"), true);
$action = isset($data['action']) ? $data['action'] : '';

// ===================== XEM TẤT CẢ KHÁCH HÀNG =====================
if ($action == 'getall') {
    $sql    = "SELECT kh.*, tk.tentk, tk.role 
               FROM khachhang kh 
               LEFT JOIN taikhoan tk ON kh.makh = tk.matk 
               ORDER BY kh.makh DESC";
    $result = $conn->query($sql);

    if ($result) {
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        echo json_encode([
            "status"  => true,
            "message" => "Lấy danh sách khách hàng thành công",
            "data"    => $customers,
            "total"   => count($customers)
        ]);
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi: " . $conn->error]);
    }
}

// ===================== XEM 1 KHÁCH HÀNG =====================
else if ($action == 'getone') {
    $makh = $conn->real_escape_string($data['makh']);

    $sql    = "SELECT kh.*, tk.tentk 
               FROM khachhang kh 
               LEFT JOIN taikhoan tk ON kh.makh = tk.matk 
               WHERE kh.makh = '$makh'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo json_encode([
            "status"  => true,
            "message" => "Lấy thông tin khách hàng thành công",
            "data"    => $result->fetch_assoc()
        ]);
    } else {
        echo json_encode(["status" => false, "message" => "Không tìm thấy khách hàng"]);
    }
}

// ===================== THÊM KHÁCH HÀNG =====================
else if ($action == 'add') {
    $tenkh  = $conn->real_escape_string($data['tenkh']  ?? '');
    $diachi = $conn->real_escape_string($data['diachi'] ?? '');
    $sdt    = $conn->real_escape_string($data['sdt']    ?? '');

    // Tạo tài khoản trước, dùng tenkh làm tentk, mật khẩu mặc định 123456, role 0
    $sql_tk = "INSERT INTO taikhoan VALUES (null, '$tenkh', '123456', '0')";

    if ($conn->query($sql_tk)) {
        $id = $conn->insert_id;

        $sql_kh = "INSERT INTO khachhang (makh, tenkh, diachi, sdt) 
                   VALUES ('$id', '$tenkh', '$diachi', '$sdt')";

        if ($conn->query($sql_kh)) {
            echo json_encode([
                "status"  => true,
                "message" => "Thêm khách hàng thành công",
                "makh"    => $id
            ]);
        } else {
            // Rollback tài khoản vừa tạo nếu insert khách hàng thất bại
            $conn->query("DELETE FROM taikhoan WHERE matk = $id");
            echo json_encode(["status" => false, "message" => "Lỗi thêm khách hàng: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi tạo tài khoản: " . $conn->error]);
    }
}

// ===================== CẬP NHẬT KHÁCH HÀNG =====================
else if ($action == 'update') {
    $makh   = $conn->real_escape_string($data['makh']);
    $tenkh  = $conn->real_escape_string($data['tenkh']  ?? '');
    $diachi = $conn->real_escape_string($data['diachi'] ?? '');
    $sdt    = $conn->real_escape_string($data['sdt']    ?? '');

    $sql = "UPDATE khachhang 
            SET tenkh = '$tenkh', diachi = '$diachi', sdt = '$sdt' 
            WHERE makh = '$makh'";

    if ($conn->query($sql)) {
        echo json_encode(["status" => true, "message" => "Cập nhật khách hàng thành công"]);
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi: " . $conn->error]);
    }
}

// ===================== XÓA KHÁCH HÀNG =====================
else if ($action == 'delete') {
    $makh = $conn->real_escape_string($data['makh']);

    // Xóa tài khoản sẽ tự động xóa khách hàng (CASCADE)
    $sql = "DELETE FROM taikhoan WHERE matk = '$makh'";

    if ($conn->query($sql)) {
        echo json_encode(["status" => true, "message" => "Xóa khách hàng thành công"]);
    } else {
        echo json_encode(["status" => false, "message" => "Lỗi: " . $conn->error]);
    }
}

else {
    echo json_encode([
        "status"  => false,
        "message" => "Action không hợp lệ. Sử dụng: getall, getone, add, update, delete"
    ]);
}

$conn->close();
?>