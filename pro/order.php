<!DOCTYPE html>
<html lang="ar">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}
?>

<head>
    <link rel="stylesheet" href="test.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>احجز طلب الصيانة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .booking-form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .custom-btn {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .hero {
            background-image: linear-gradient(rgba(0, 123, 255, 0.8), rgba(0, 123, 255, 0.8)), url('path/to/your/image.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>
    <style>
        .hero {
            background-image: url('https://t3.ftcdn.net/jpg/05/19/73/36/360_F_519733648_tSMSHwqxw3TrbgFSXNKJVKncdkC0siTq.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h2,
        .hero p {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .hero .btn {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>

    <section class="hero text-center text-white">
        <div class="container">
            <h2 class="display-4">احجز موعد لصيانة جهازك الآن</h2>
            <p class="lead">املأ النموذج أدناه لطلب خدمة الصيانة لجهازك بسهولة.</p>
        </div>
    </section>
    <section class="booking-form py-5">
        <div class="container">
            <h2 class="text-center mb-4">نموذج حجز الخدمة</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                class="p-4 border rounded shadow-sm">
                <!-- ماركة الجهاز ونوع الجهاز -->
                <div class="mb-3">
                    <label for="device-brand" class="form-label">ماركة الجهاز</label>
                    <select class="form-select" id="device-brand" name="device_brand" required>
                        <option value="" disabled selected>اختر ماركة الجهاز</option>
                        <option value="apple">أبل</option>
                        <option value="samsung">سامسونج</option>
                        <option value="huawei">هواوي</option>
                        <option value="xiaomi">شاومي</option>
                        <option value="oneplus">ون بلس</option>
                        <option value="other">ماركة أخرى</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="device-type" class="form-label">نوع الجهاز</label>
                    <input type="text" id="device-type" name="device_type" class="form-control" placeholder="نوع الجهاز" required>
                </div>

                <!-- نوع المشكلة -->
                <div class="mb-3">
                    <label for="issue-type" class="form-label">نوع المشكلة</label>
                    <select class="form-select" id="issue-type" name="issue_type" required>
                        <option value="" disabled selected>اختر نوع المشكلة</option>
                        <option value="screen_replacement">تغيير شاشة</option>
                        <option value="battery_replacement">تبديل بطارية</option>
                        <option value="software_issue">مشاكل البرمجيات</option>
                        <option value="camera_issue">مشكلة في الكاميرا</option>
                        <option value="circuit_damage">تلف لوحة الدوائر</option>
                        <option value="charging_issue">مشكلة في الشحن</option>
                        <option value="other_repair">صيانة أخرى</option>
                    </select>
                </div>

                <!-- تفاصيل المشكلة -->
                <div class="mb-3">
                    <label for="issue" class="form-label">تفاصيل المشكلة</label>
                    <textarea class="form-control" id="issue" name="issue" rows="4"
                        placeholder="أدخل وصفًا للمشكلة التي تواجهها" required></textarea>
                </div>

                <!-- زر الإرسال -->
                <button type="submit" name="submit"
                    class="btn btn-primary btn-lg btn-custom mx-auto d-block">إرسال</button>
            </form>
        </div>
    </section>
    <?php
    // معالجة النموذج عند الإرسال
    if (isset($_POST["submit"])) {
        include 'conn.php';
        $device_brand = mysqli_real_escape_string($conn, $_POST['device_brand']);
        $device_type = mysqli_real_escape_string($conn, $_POST['device_type']);
        $issue_type = mysqli_real_escape_string($conn, $_POST['issue_type']);
        $issue = mysqli_real_escape_string($conn, $_POST['issue']);
        $cid = $_SESSION['uid'];
        $case = 'in_progress';

        $sql = "INSERT INTO orders (brand, phone, dsc_type, dsc, cnum, `case`) 
                VALUES ('$device_brand', '$device_type', '$issue_type', '$issue', '$cid', '$case')";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="alert alert-success text-center mt-4" role="alert">تم إرسال طلبك بنجاح</div>';
        } else {
            echo '<div class="alert alert-danger text-center mt-4" role="alert">خطأ: ' . mysqli_error($conn) . '</div>';
        }

        mysqli_close($conn);
    }
    ?>

    <!-- الفوتر -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 صيانة الأجهزة الذكية. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
