<?php
session_start();
include 'conn.php'; // الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

// جلب بيانات المستخدم من الجلسة
$user_id = $_SESSION['uid'];
$user_level = $_SESSION['level'];

// التحقق من وجود رقم الطلب في الرابط
if (isset($_GET['onum'])) {
    $order_id = intval($_GET['onum']); // تحويل إلى عدد صحيح للحماية

    // التحقق من الطلب بناءً على مستوى المستخدم
    if ($user_level == 1) {
        // إذا كان المستخدم Admin، يمكنه الوصول إلى أي طلب
        $sql = "SELECT * FROM orders WHERE onum = ?";
    } else {
        // إذا كان المستخدم عادي، يمكنه الوصول إلى طلباته فقط
        $sql = "SELECT * FROM orders WHERE onum = ? AND cnum = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($user_level == 1) {
        $stmt->bind_param("i", $order_id); // ربط رقم الطلب فقط
    } else {
        $stmt->bind_param("ii", $order_id, $user_id); // ربط رقم الطلب ورقم المستخدم
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc(); // جلب بيانات الطلب
    } else {
        echo "<script>
            alert('لا يمكنك الوصول إلى تفاصيل هذا الطلب.');
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
    <title>تفاصيل الطلب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .details-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .details-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .details-container .detail {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .details-container .detail span {
            font-weight: bold;
        }

        .btn-back,
        .btn-user-info {
            display: block;
            margin: 20px auto 0;
        }
        body {
        direction: rtl;
        text-align: right;
        font-family: 'Arial', sans-serif;
    }
    </style>
</head>

<body>
    <div class="details-container">
        <h2>تفاصيل الطلب</h2>
        <div class="detail"><span>رقم الطلب:</span> <?php echo $order['onum']; ?></div>
        <div class="detail"><span>اسم البراند:</span> <?php echo $order['brand']; ?></div>
        <div class="detail"><span>نوع الجهاز:</span> <?php echo $order['phone']; ?></div>
        <div class="detail"><span>نوع المشكلة:</span> <?php echo $order['dsc_type']; ?></div>
        <div class="detail"><span>تفاصيل المشكلة:</span> <?php echo $order['dsc']; ?></div>
        <div class="detail"><span>رقم العميل:</span> <?php echo $order['cnum']; ?></div>
        <div class="detail"><span>حالة الطلب:</span> <?php echo $order['case']; ?></div>

        <!-- زر العودة -->
        <a href="costmer.php" class="btn btn-primary btn-back">العودة إلى الطلبات</a>

        <!-- زر معلومات المستخدم يظهر فقط للـ Admin -->
        <?php if ($user_level == 1) { ?>
            <a href="user_info.php?uid=<?php echo $order['cnum']; ?>" class="btn btn-info btn-user-info">عرض معلومات المستخدم</a>
        <?php } ?>
    </div>
</body>

</html>