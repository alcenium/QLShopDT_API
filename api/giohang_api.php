<?php
    header("Content-Type: application/json; charset: utf-8");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/DB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/giohang/GioHang_db.php');

    $post_data = json_decode(file_get_contents("php://input"), true);

    $action = isset($post_data["action"]) ? $post_data["action"] : '';

    switch ($action){
        case "getall":
            $db = new DB();
            $conn = $db->getConnection();
            $sql = "SELECT gi.maitem, gi.magio, gi.masp, gi.sl,
                    sp.tensp, sp.gia, sp.hinhanh, sp.hang, sp.gia*gi.sl AS thanhtien
                    FROM giohang_item gi
                    JOIN sanpham sp ON gi.masp = sp.masp";
            $result = $conn->query($sql);

            if ($result)
                echo json_encode([
                    "status" => true,
                    "data" => $result->fetch_all(MYSQLI_ASSOC)
            ]);
            else {
                echo json_encode([
                    "status" => false,
                    "message" => "Không tìm thấy bản ghi nào trong table giỏ hàng."
                ]);
            }
        break;


        case "get":
            if (isset($post_data["makh"]))
                $makh = $post_data["makh"];
            else {
                echo json_encode(["status" => false, "message" => "Không tìm thấy giá trị makh trong dữ liệu nhận được"]);
                exit();
            }

            $db = new DB();
            $conn = $db->getConnection();
            $sql = "SELECT ghi.maitem, ghi.magio, ghi.masp, ghi.sl, 
                    sp.tensp, sp.gia, sp.hinhanh, sp.hang, sp.gia*ghi.sl AS thanhtien
                    FROM giohang gh
                    JOIN giohang_item ghi ON gh.magio = ghi.magio
                    JOIN sanpham sp ON ghi.masp = sp.masp
                    WHERE gh.makh = $makh";
            $result = $conn->query($sql);

            if ($result) {
                echo json_encode([
                    "status" => true,
                    "data" => $result->fetch_all(MYSQLI_ASSOC)
                ]);
            } else {
                echo json_encode(["status" => false, "message" => "Query thất bại"]);
            }
        break;


        case "add":
            if (!isset($post_data["magio"]) || !isset($post_data["masp"]) || !isset($post_data["sl"])){
                echo json_encode(["status" => false, "message" => "Chưa điền đầy đủ thông tin: magio, masp, sl"]);
                exit();
            }

            $magio = $post_data["magio"];
            $masp = $post_data["masp"];
            $sl = $post_data["sl"];

            $db = new DB();
            $conn = $db->getConnection();

            // Kiểm tra người dùng có giỏ hàng không
            $magio = GioHang_db::giohangTonTai($makh);
            if (!$magio)
                $magio = GioHang_db::taoGioHang($makh);


            // Kiểm tra sự tồn tại của sản phẩm trong giỏ hàng :v
            $sanPham = GioHang_db::sanphamTonTai($magio, $masp);

            if (!$sanPham) {
                $sl_sp = $sanPham[0]['sl'];
                $sl_moi = $sl_sp + $sl_them;

                if ($soluong_moi > $sl_sp) {
                    echo json_encode(["status" => false, "message" => "Lỗi! số lượng vượt quá số còn trong kho ($sl_sp)"]);
                    exit();
                }
                
                $result = GioHang_db::suaSoLuong($magio, $masp, $soluong_moi);
            } else
                $result = GioHang_db::themSanPham($magio, $masp, $sl_them);

            if ($result)
                echo json_encode(["status" => true, "message" => "Thêm sản phẩm thành công"]);
            else
                echo json_encode(["status" => true, "message" => "Thêm sản phẩm thành công"]);
        break;


        default:
            echo json_encode([
                "status" => false,
                "message" => "Hành động không tồn tại"
            ]);
            break;
    }
?>