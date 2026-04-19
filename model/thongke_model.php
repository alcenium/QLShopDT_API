<?php
include_once "../../includes/api_helper.php";

// Thêm constant vào api_helper.php
// define('THONGKE_API_URL', 'http://localhost/dienthoai/QLShopDT_API/api/thongke_api.php');

class ThongKe {
    public static function getThongKe($filters = []) {
        $data = array_merge(['action' => 'getthongke'], $filters);
        $result = callAPI(THONGKE_API_URL, $data);
        return ($result && $result['status']) ? $result['data'] : [];
    }
}