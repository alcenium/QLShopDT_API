<?php
define('DANHMUC_API_URL',  'http://localhost/QLShopDT_API/api/danhmuc_api.php');
define('SANPHAM_API_URL',  'http://localhost/QLShopDT_API/api/sanpham_api.php');
define('KHACHHANG_API_URL','http://localhost/QLShopDT_API/api/khachhang_api.php');

/**
 * Hàm gọi API chung qua POST (JSON body)
 * @param string $url  - Endpoint API
 * @param array  $data - Dữ liệu gửi đi (phải có 'action')
 * @return array       - Kết quả trả về từ API
 */
function callAPI($url, $data) {
    $options = [
        "http" => [
            "method"  => "POST",
            "header"  => "Content-Type: application/json",
            "content" => json_encode($data)
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

/** Gọi API danh mục */
function callDanhmucAPI($data) {
    return callAPI(DANHMUC_API_URL, $data);
}

/** Gọi API sản phẩm */
function callSanphamAPI($data) {
    return callAPI(SANPHAM_API_URL, $data);
}

/** Gọi API khách hàng */
function callKhachhangAPI($data) {
    return callAPI(KHACHHANG_API_URL, $data);
}
?>