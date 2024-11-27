<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conn.php'; // الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول ومستوى المستخدم
if (!isset($_SESSION['uid']) || $_SESSION['level'] != 1) {
    header('Location: login.php');
    exit;
}

// التحقق من وجود رقم الطلب في الرابط
if (isset($_GET['onum'])) {
    $order_id = intval($_GET['onum']); // تحويل إلى عدد صحيح للحماية من الهجمات

    // حذف الطلب
    $sql = "DELETE FROM orders WHERE onum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('تم حذف الطلب بنجاح.');
            window.location.href = 'costmer.php';
        </script>";
    } else {
        echo "<script>
            alert('حدث خطأ أثناء حذف الطلب.');
            window.location.href = 'costmer.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: costmer.php');
    exit;
}
