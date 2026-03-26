<?php
define('KHACHHANG_API_URL', 'http://localhost/QLShopDT_API/api/khachhang_api.php');

/**
 * Gọi API danh mục
 * @param array $data - Dữ liệu gửi đi (phải có 'action')
 * @return array - Kết quả trả về từ API
 */
function callDanhmucAPI($data) {
    $post_data = json_encode($data);
    
    $options = [
        "http" => [
            "method"  => "POST",
            "header"  => "Content-Type: application/json",
            "content" => $post_data
        ]
    ];
    
    $context = stream_context_create($options);
    $response = file_get_contents(KHACHHANG_API_URL, false, $context);
    
    return json_decode($response, true);
}
?>
