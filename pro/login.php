<?php
include 'header.php';

// تحقق مما إذا كانت الجلسة قد بدأت بالفعل
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ms = '';
if (isset($_POST['submit'])) {

    $uname = $_POST['username'];
    $pass = $_POST['password'];

    include 'conn.php';
    $sql = "select * from users where (uname='$uname' or email='$uname') and password='$pass'";
    $query = mysqli_query($conn, $sql);
    $rslt = mysqli_fetch_assoc($query);
    $row_num = mysqli_num_rows($query);

    if ($row_num == 1) {

        $_SESSION['uid'] = $rslt['id'];
        $_SESSION['name'] = $rslt['name'];
        $_SESSION['level'] = $rslt['level'];

        mysqli_close($conn);
        header('location:home.php');
    } else {
        $ms = 'username or password not correct';
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    
    <link rel="stylesheet" href="test.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-section {
            background-image: url('https://t3.ftcdn.net/jpg/05/19/73/36/360_F_519733648_tSMSHwqxw3TrbgFSXNKJVKncdkC0siTq.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

  

    </style>
</head>

<body dir="rtl">

<section class="login-section">
    <div class="login-form">
        <h2 class="text-center mb-4">تسجيل الدخول</h2>
        <form action="login.php" method="post">
            <!-- حقل اسم المستخدم -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class='bx bxs-user'></i></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="اسم المستخدم أو البريد الإلكتروني" required>
            </div>

            <!-- حقل كلمة المرور -->
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class='bx bxs-lock-alt'></i></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
            </div>

            <!-- رسالة خطأ -->
            <?php if (!empty($ms)): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $ms; ?>
                </div>
            <?php endif; ?>

            <!-- زر تسجيل الدخول -->
            <div class="d-flex justify-content-center">
                <button type="submit" name="submit" class="btn btn-primary btn-lg custom-btn">تسجيل دخول</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>ليس لديك حساب؟ <a href="singup.php">إنشاء حساب</a></p>
        </div>
    </div>
</section>


<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p>&copy; 2024 صيانة الأجهزة الذكية. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
