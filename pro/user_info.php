<?php
session_start();
include 'conn.php'; // الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

// التحقق من أن المستخدم Admin
if ($_SESSION['level'] != 1) {
    echo "<script>
        alert('ليس لديك الصلاحية للوصول إلى هذه الصفحة.');
        window.location.href = 'orders.php';
    </script>";
    exit;
}

// التحقق من وجود رقم المستخدم في الرابط
if (isset($_GET['uid'])) {
    $user_id = intval($_GET['uid']); // تحويل إلى عدد صحيح للحماية

    // جلب بيانات المستخدم
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // جلب بيانات المستخدم
    } else {
        echo "<script>
            alert('رقم المستخدم غير موجود.');
            window.location.href = 'orders.php';
        </script>";
        exit;
    }
} else {
    header('Location: orders.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معلومات المستخدم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .user-info-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-info-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-info-container .info {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .user-info-container .info span {
            font-weight: bold;
        }

        .btn-back {
            display: block;
            margin: 20px auto 0;
        }
    </style>
</head>

<body>
    <div class="user-info-container">
        <h2>معلومات المستخدم</h2>
        <div class="info"><span>رقم المستخدم:</span> <?php echo $user['id']; ?></div>
        <div class="info"><span>الاسم:</span> <?php echo $user['name']; ?></div>
        <div class="info"><span>البريد الإلكتروني:</span> <?php echo $user['email']; ?></div>
        <div class="info"><span>رقم الهاتف:</span> <?php echo $user['phone_num']; ?></div>
        <div class="info"><span>مستوى المستخدم:</span> <?php echo ($user['level'] == 1) ? 'مدير' : 'مستخدم'; ?></div>
        <a href="costmer.php" class="btn btn-primary btn-back">العودة إلى الطلبات</a>
    </div>
</body>

</html>
