<?php
session_start();

$page_title = 'Đăng nhập';
$extra_css = '<link rel="stylesheet" href="/QLShopDT_API/assets/css/login.css">';

include "../includes/header.php";

$error = "";

// Nếu đã đăng nhập rồi thì không hiển thị form login
if (isset($_SESSION['username'])) {
    header("Location: trangchu.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM taikhoan WHERE tentk = '$username' AND mk = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        header("Location: trangchu.php");
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>

<div class="login-container">
    <h2><i class="fa fa-user-circle"></i> ĐĂNG NHẬP</h2>
    
    <?php if ($error): ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label><i class="fa fa-user"></i> Tên đăng nhập</label>
            <input type="text" name="username" required autofocus>
        </div>
        
        <div class="form-group">
            <label><i class="fa fa-lock"></i> Mật khẩu</label>
            <input type="password" name="password" required>
        </div>
        
        <button type="submit" class="btn-login">
            <i class="fa fa-sign-in-alt"></i> Đăng nhập
        </button>
    </form>
    
    <div class="register-link">
        Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
    </div>
</div>

</body>
</html>
