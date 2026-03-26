<?php
// includes/footer.php
$current_year = date('Y');
?>
<footer class="admin-footer">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <div class="footer-inner">
        <div class="footer-brand">
            <span class="footer-logo">&#9644;</span>
            <span class="footer-name">QLShopDT</span>
        </div>
        <div class="footer-center">
            &copy; <?php echo $current_year; ?> Quản lý Shop Điện Thoại. All rights reserved.
        </div>
        <div class="footer-right">
            <?php if(isset($_SESSION['username'])): ?>
                Đăng nhập: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            <?php endif; ?>
        </div>
    </div>
</footer>