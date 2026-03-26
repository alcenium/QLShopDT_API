<?php
session_start();

$page_title = 'Trang Chủ';
$active_nav = 'trangchu';
$extra_css  = '<link rel="stylesheet" href="/QLShopDT_API/assets/css/trangchu.css">';

require_once "../includes/header.php";
require_once "../includes/footer.php";
// $conn đã có từ header.php

// ── Xử lý tìm kiếm ──────────────────────────────────────────
$search        = '';
$section_title = 'SẢN PHẨM NỔI BẬT';

if (isset($_GET['search']) && trim($_GET['search']) !== '') {
    $search        = trim($_GET['search']);
    $esc           = mysqli_real_escape_string($conn, $search);
    $section_title = 'KẾT QUẢ TÌM KIẾM: "' . htmlspecialchars($search) . '"';
    $sql = "SELECT * FROM sanpham
            WHERE tensp  LIKE '%$esc%'
               OR hang   LIKE '%$esc%'
               OR ghichu LIKE '%$esc%'
            ORDER BY masp DESC";
} else {
    $sql = "SELECT * FROM sanpham ORDER BY masp DESC LIMIT 12";
}

$result = mysqli_query($conn, $sql);
?>

<!-- ===== HERO (chỉ hiện khi không tìm kiếm) ===== -->
<?php if ($search === ''): ?>
<section class="ps-hero">
    <div class="ps-hero-text">
        <h1>Công nghệ đỉnh cao<br>— <em>Giá tốt nhất</em></h1>
        <p>Khám phá hàng ngàn sản phẩm điện thoại, laptop, phụ kiện chính hãng với giá cả cạnh tranh nhất thị trường.</p>
        <div class="ps-hero-cta">
            <a href="#products" class="ps-cta-primary">Mua ngay</a>
            <a href="/sanpham/sanpham.php" class="ps-cta-secondary">Xem tất cả</a>
        </div>
        <div class="ps-hero-stats">
            <div class="ps-stat"><div class="num">1.200+</div><div class="lbl">Sản phẩm</div></div>
            <div class="ps-stat"><div class="num">15k+</div><div class="lbl">Khách hàng</div></div>
            <div class="ps-stat"><div class="num">99%</div><div class="lbl">Hài lòng</div></div>
        </div>
    </div>
    <div class="ps-hero-visual">
        <div class="ps-phone-mock">
            <div class="ps-phone-icon">📱</div>
            <div class="ps-hot-tag">HOT DEAL</div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ===== SẢN PHẨM ===== -->
<div class="ps-filter-bar" id="products">
    <h2 class="ps-section-title" style="margin:0"><?php echo $section_title; ?></h2>
</div>

<div class="ps-products">
    <div class="ps-product-grid">
        <?php if ($result && mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
                $masp    = $row['masp'];
                $tensp   = htmlspecialchars($row['tensp']);
                $gia     = number_format($row['gia'], 0, ',', '.');
                $hinhanh = !empty($row['hinhanh']) ? '/img/' . $row['hinhanh'] : '';
        ?>
            <div class="ps-product-card">
                <span class="ps-badge">Hot</span>
                <div class="ps-product-img">
                    <?php if ($hinhanh): ?>
                        <img src="<?php echo htmlspecialchars($hinhanh); ?>"
                             alt="<?php echo $tensp; ?>"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="ps-img-placeholder" style="display:none">📦</div>
                    <?php else: ?>
                        <div class="ps-img-placeholder">📦</div>
                    <?php endif; ?>
                </div>
                <div class="ps-product-body">
                    <div class="ps-product-name"><?php echo $tensp; ?></div>
                    <div class="ps-product-price"><?php echo $gia; ?>đ</div>
                </div>
                <div class="ps-product-action">
                    <a href="./sanpham/chitietsanpham.php?masp=<?php echo $masp; ?>"
                       class="ps-btn ps-btn-primary"
                       style="width:100%;justify-content:center">
                        <i class="fa fa-eye"></i> Xem chi tiết
                    </a>
                </div>
            </div>
        <?php endwhile;
        else: ?>
            <div class="ps-empty" style="grid-column:1/-1">
                <div class="ps-empty-icon">🔍</div>
                <p>Không tìm thấy sản phẩm nào!</p>
            </div>
        <?php endif;
        mysqli_close($conn); ?>
    </div>
</div>

</body>
</html>
