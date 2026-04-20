<?php
session_start();

// Kiểm tra đã đăng nhập
if (!isset($_SESSION['username'])) {
    header('Location: /QLShopDT_API/views/auth/login.php');
    exit;
}

include($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/includes/api_helper.php');

$username = $_SESSION['username'];
$user_id  = $_SESSION['userid'] ?? 0;
$role     = $_SESSION['role']   ?? 0;
$message  = '';
$error    = '';

// Lấy thông tin chi tiết từ API
$profile_data = [];
$result = callAPI('GET', '/api/profile');

if ($result && $result['status']) {
    $profile_data = $result['data'];
}

// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']     ?? '');
    $phone    = trim($_POST['phone']    ?? '');
    $address  = trim($_POST['address']  ?? '');
    $birthday = trim($_POST['birthday'] ?? '');

    if (empty($name)) {
        $error = 'Tên không được để trống!';
    } else {
        if ($role == 0) {
            $update_data = [
                'tenkh'  => $name,
                'sdt'    => $phone,
                'diachi' => $address,
            ];
        } else {
            $update_data = [
                'tennv'  => $name,
                'sdt'    => $phone,
                'diachi' => $address,
            ];
            if ($birthday !== '') {
                $update_data['ns'] = $birthday;
            }
        }

        $result = callAPI('PUT', '/api/profile', $update_data);

        if ($result && $result['status']) {
            $message = 'Cập nhật thông tin cá nhân thành công!';
            $refresh = callAPI('GET', '/api/profile');
            if ($refresh && $refresh['status']) {
                $profile_data = $refresh['data'];
            }
        } else {
            $error = $result['message'] ?? 'Cập nhật thất bại. Vui lòng thử lại!';
        }
    }
}

$page_title = 'Thông tin cá nhân';
$active_nav = '';
$extra_css = '<link rel="stylesheet" href="/QLShopDT_API/assets/css/profile.css">';
include($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/includes/header.php');
?>

<html>
        <link rel="stylesheet" href="/QLShopDT_API/assets/css/footer.css">
</html>

<main class="ps-main">
    <div class="ps-container">
        <div class="ps-profile-wrapper">
            <div class="ps-profile-header">
                <h1><i class="fa fa-user-circle"></i> Thông tin cá nhân</h1>
                <p class="ps-profile-role">
                    <?php 
                    echo ($role == 0) ? 'Khách hàng' : (($role == 1) ? 'Quản trị viên' : 'Nhân viên');
                    ?>
                </p>
            </div>

            <?php if ($message): ?>
                <div class="ps-alert ps-alert-success">
                    <i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="ps-alert ps-alert-error">
                    <i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="ps-profile-form">
                <div class="ps-form-group">
                    <label for="username" class="ps-label">Tên tài khoản</label>
                    <input type="text" id="username" value="<?php echo htmlspecialchars($username); ?>" class="ps-input" disabled>
                    <small class="ps-help-text">Không thể thay đổi</small>
                </div>

                <div class="ps-form-group">
                    <label for="name" class="ps-label">Họ tên <span class="ps-required">*</span></label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($profile_data['tenkh'] ?? $profile_data['tennv'] ?? ''); ?>" class="ps-input" required>
                </div>

                <div class="ps-form-group">
                    <label for="phone" class="ps-label">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($profile_data['sdt'] ?? ''); ?>" class="ps-input" placeholder="0123456789">
                </div>

                <div class="ps-form-group">
                    <label for="address" class="ps-label">Địa chỉ</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($profile_data['diachi'] ?? ''); ?>" class="ps-input" placeholder="Số nhà, đường phố, thành phố">
                </div>

                <?php if ($role != 0 && isset($profile_data['ns'])): ?>
                <div class="ps-form-group">
                    <label for="birthday" class="ps-label">Ngày sinh</label>
                    <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($profile_data['ns'] ?? ''); ?>" class="ps-input">
                </div>
                <?php endif; ?>

                <div class="ps-form-actions">
                    <button type="submit" class="ps-btn ps-btn-primary">
                        <i class="fa fa-save"></i> Lưu thay đổi
                    </button>
                    <a href="/QLShopDT_API/views/trangchu.php" class="ps-btn ps-btn-secondary">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>

            <div class="ps-profile-section">
                <h2>Bảo mật tài khoản</h2>
                <div class="ps-security-info">
                    <p><i class="fa fa-info-circle"></i> Để đổi mật khẩu, vui lòng liên hệ với quản trị viên.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/QLShopDT_API/includes/footer.php'); ?>
