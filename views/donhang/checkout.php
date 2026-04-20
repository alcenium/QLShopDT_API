<?php
/**
 * Xác nhận đặt hàng - views/donhang/checkout.php
 * Render bởi DonHangController@create
 * Biến: $items, $total, $customer, $makh
 */
require_once BASE_PATH . '/includes/api_helper.php';

$extra_css = '<link rel="stylesheet" href="' . BASE_URL . '/assets/css/donhang.css">
<link rel="stylesheet" href="' . BASE_URL . '/assets/css/footer.css">';

include BASE_PATH . '/includes/header.php';

$imgBase = BASE_URL . '/includes/img/';
?>

<div class="dh-page-header">
    <div class="dh-page-header-inner">
        <div>
            <h1 class="dh-page-title">Xác nhận đặt hàng</h1>
            <p class="dh-page-subtitle">Kiểm tra lại thông tin trước khi đặt hàng</p>
        </div>
        <a href="<?= BASE_URL ?>/app.php/giohang" class="dh-cancel-btn">
            <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
        </a>
    </div>
</div>

<main class="container">
    <div style="display:grid; grid-template-columns:1fr 340px; gap:24px; margin-top:24px;">

        <!-- Danh sách sản phẩm -->
        <div class="dh-form-card">
            <div class="dh-form-card-header">
                <div class="dh-form-icon"><i class="fas fa-shopping-bag"></i></div>
                <h2>Sản phẩm đặt mua (<?= count($items) ?>)</h2>
            </div>
            <div class="dh-form-body" style="padding:0">
                <table class="dh-table" style="margin:0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>SL</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td style="display:flex;align-items:center;gap:10px">
                                <?php if (!empty($item['hinhanh'])): ?>
                                    <img src="<?= $imgBase . e($item['hinhanh']) ?>"
                                         alt="<?= e($item['tensp']) ?>"
                                         style="width:40px;height:40px;object-fit:cover;border-radius:6px">
                                <?php endif; ?>
                                <span><?= e($item['tensp']) ?></span>
                            </td>
                            <td><?= number_format($item['gia'], 0, ',', '.') ?>₫</td>
                            <td><?= (int)$item['sl'] ?></td>
                            <td style="color:var(--dh-accent);font-weight:600">
                                <?= number_format($item['thanhtien'], 0, ',', '.') ?>₫
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Thông tin & xác nhận -->
        <div style="display:flex;flex-direction:column;gap:16px">

            <!-- Thông tin giao hàng -->
            <div class="dh-form-card">
                <div class="dh-form-card-header">
                    <div class="dh-form-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <h2>Thông tin giao hàng</h2>
                </div>
                <div class="dh-form-body">
                    <p><strong><?= e($customer['tenkh'] ?? '') ?></strong></p>
                    <p style="color:var(--dh-muted);margin-top:4px">
                        <?= e($customer['sdt'] ?? '') ?>
                    </p>
                    <p style="color:var(--dh-muted);margin-top:4px">
                        <?= e($customer['diachi'] ?? 'Chưa có địa chỉ') ?>
                    </p>
                </div>
            </div>

            <!-- Tổng tiền & đặt hàng -->
            <div class="dh-form-card">
                <div class="dh-form-body">
                    <div style="display:flex;justify-content:space-between;margin-bottom:12px">
                        <span style="color:var(--dh-muted)">Tạm tính</span>
                        <span><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:16px;padding-top:12px;border-top:1px solid var(--dh-border)">
                        <span style="font-weight:700;font-size:1.05rem">Tổng cộng</span>
                        <span style="font-weight:700;font-size:1.15rem;color:var(--dh-accent)">
                            <?= number_format($total, 0, ',', '.') ?>₫
                        </span>
                    </div>
                    <form method="POST" action="<?= BASE_URL ?>/app.php/donhang/create">
                        <?= csrf_field() ?>
                        <button type="submit" class="dh-save-btn" style="width:100%;justify-content:center;font-size:1rem;padding:14px">
                            <i class="fas fa-check-circle"></i> Xác nhận đặt hàng
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include BASE_PATH . '/includes/footer.php'; ?>
