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
    $order_id = intval($_GET['onum']); // تحويل إلى عدد صحيح للحماية

    // جلب بيانات الطلب للتعديل
    $sql = "SELECT * FROM orders WHERE onum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc(); // جلب بيانات الطلب
    } else {
        echo "<script>
            alert('رقم الطلب غير موجود.');
            window.location.href = 'costmer.php';
        </script>";
        exit;
    }
} else {
    header('Location: costmer.php');
    exit;
}

// تحديث الطلب عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $phone = $_POST['phone'];
    $dsc_type = $_POST['dsc_type'];
    $case = $_POST['case'];

    $sql = "UPDATE orders SET brand = ?, phone = ?, dsc_type = ?, `case` = ? WHERE onum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $brand, $phone, $dsc_type, $case, $order_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('تم تحديث الطلب بنجاح.');
            window.location.href = 'costmer.php';
        </script>";
    } else {
        echo "<script>
            alert('حدث خطأ أثناء تحديث الطلب.');
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الطلب</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">تعديل الطلب</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="brand" class="form-label">اسم البراند</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $order['brand']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">نوع الجهاز</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $order['phone']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dsc_type" class="form-label">نوع المشكلة</label>
                <input type="text" class="form-control" id="dsc_type" name="dsc_type" value="<?php echo $order['dsc_type']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="case" class="form-label">حالة الطلب</label>
                <select class="form-select" id="case" name="case" required>
                    <option value="in_progress" <?php echo ($order['case'] == 'in_progress') ? 'selected' : ''; ?>>قيد التنفيذ</option>
                    <option value="completed" <?php echo ($order['case'] == 'completed') ? 'selected' : ''; ?>>مكتمل</option>
                    <option value="cancelled" <?php echo ($order['case'] == 'cancelled') ? 'selected' : ''; ?>>ملغي</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
            <a href="orders.php" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
