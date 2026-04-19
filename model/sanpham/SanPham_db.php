<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/model/DB.php';

class SanPham_db {
    public static function sanPhamTonTai($masp) {
        $db = new DB();
        $conn = $db->getConnection();

        $sql = "Select * from sanpham where masp=$masp";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
            return true;
        return false;
    }
}
?>