<?php
    header("Content-Type: application/json; charset: utf-8");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/DB.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/giohang/GioHang_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/sanpham/SanPham_db.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/giohang/GioHang_check.php');

    $post_data = json_decode(file_get_contents("php://input"), true);

    $action = isset($post_data["action"]) ? $post_data["action"] : '';

    switch ($action){
        case "getall":
            $result = GioHang_db::fetchGioHang();

            if ($result)
                echo json_encode([
                    "status" => true,
                    "data" => $result
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

            $result = GioHang_db::fetchGioHangTheoMaKH($makh);

            if ($result) {
                echo json_encode([
                    "status" => true,
                    "data" => $result
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

            $magio = $post_data["makh"];
            $masp = $post_data["masp"];
            $sl_them = $post_data["sl"];

            // Kiểm tra dữ liệu đầu vào
            if (!GioHang_check::laSoLonHon0($makh)){
                echo json_encode(["status" => false, "message" => "Mã khách hàng phải là số nguyên lớn hơn 0"]);
                exit();
            }
            if (!GioHang_check::laSoLonHon0($masp)){
                echo json_encode(["status" => false, "message" => "Mã sản phẩm phải là số nguyên lớn hơn 0"]);
                exit();
            }
            if (!GioHang_check::laSoLonHon0($sl)){
                echo json_encode(["status" => false, "message" => "Số lượng phải là số nguyên lớn hơn 0"]);
                exit();
            }


            // Kiểm tra khách hàng có giỏ hàng không
            $magio = GioHang_db::nguoiDungCoGioHang($makh);
            if (!$magio)
            {
                $magio = GioHang_db::taoGioHang($makh);
            }


            // Kiểm tra sản phẩm có tồn tại hay không
            if (!SanPham_db::sanPhamTonTai($masp)){
                echo json_encode(["status" => false, "message" => "Sản phẩm không tồn tại trong csdl"]);
                exit();
            }

            // Kiểm tra sự tồn tại của sản phẩm trong giỏ hàng
            $sanPham = GioHang_db::sanphamTonTai($magio, $masp);
            $sl_sp = $sanPham[0]['sl_sp'];

            if ($sanPham) {
                $sl_gio = $sanPham[0]['sl_gio'];
                $sl_moi = $sl_gio + $sl_them;

                if ($sl_moi > $sl_sp) {
                    echo json_encode(["status" => false, "message" => "Lỗi! số lượng vượt quá số còn trong kho ($sl_sp)"]);
                    exit();
                }
                
                $result = GioHang_db::suaSoLuong($magio, $masp, $sl_moi);
            }
            else if ($sl_sp > $sl_them) {
                $result = GioHang_db::themSanPham($magio, $masp, $sl_them);
            }
            else {
                echo json_encode(["status" => false, "message" => "Lỗi! số lượng vượt quá số còn trong kho ($sl_sp)"]);
                exit();
            }

            if ($result)
                echo json_encode(["status" => true, "message" => "Thêm sản phẩm thành công"]);
            else
                echo json_encode(["status" => false, "message" => "Thêm sản phẩm thất bại"]);
        break;


        default:
            echo json_encode([
                "status" => false,
                "message" => "Hành động không tồn tại"
            ]);
            break;
    }
?>