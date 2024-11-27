<?php
// معالجة النموذج عند الإرسال
session_start();

if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST["submit"])) {

        include 'conn.php';
        $device_brand = $_POST['device_brand'];
        $device_type = $_POST['device_type'];
        $issue_type = $_POST['issue_type'];
        $issue = $_POST['issue'];
        $cid = $_SESSION['uid'];

        $sql = "insert into orders (brand,phone,dsc_type,dsc,cnum) values('$device_brand','$device_type','$issue_type','$issue','$cid')";
        if (mysqli_query($conn, $sql)) {
            echo "تم ارسال طلبك بنجاح";
        }

        else {
            echo "error";
        }

        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="ar">

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

    <?php include 'header.php' ?>
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
</head>

    <section class="hero text-center text-white">
        <div class="container">
            <h2 class="display-4">احجز موعد لصيانة جهازك الآن</h2>
            <p class="lead">املأ النموذج أدناه لطلب خدمة الصيانة لجهازك بسهولة.</p>
        </div>
    </section>
    <section class="booking-form py-5">
    <div class="container">
        <h2 class="text-center mb-4">نموذج حجز الخدمة</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="p-4 border rounded shadow-sm">
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
                <select class="form-select" id="device-type" name="device_type" required>
                    <option value="" disabled selected>اختر نوع الجهاز</option>
                    <option value="apple_iphone_14">أبل آيفون 14</option>
                    <option value="apple_iphone_13">أبل آيفون 13</option>
                    <option value="apple_iphone_12">أبل آيفون 12</option>
                    <option value="apple_ipad">أبل آيباد</option>
                    <option value="samsung_galaxy_s23">سامسونغ جالكسي S23</option>
                    <option value="samsung_galaxy_s22">سامسونغ جالكسي S22</option>
                    <option value="samsung_galaxy_a52">سامسونغ جالكسي A52</option>
                    <option value="huawei_p50">هواوي P50</option>
                    <option value="huawei_mate_40">هواوي ميت 40</option>
                    <option value="xiaomi_redmi_note_10">شاومي ريدمي نوت 10</option>
                    <option value="xiaomi_mi_11">شاومي مي 11</option>
                    <option value="oneplus_9">ون بلس 9</option>
                    <option value="oneplus_nord">ون بلس نورد</option>
                </select>
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
                <textarea class="form-control" id="issue" name="issue" rows="4" placeholder="أدخل وصفًا للمشكلة التي تواجهها" required></textarea>
            </div>

            <!-- زر الإرسال -->
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-custom mx-auto d-block">إرسال</button>
        </form>
    </div>
</section>

<!-- الفوتر -->
<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p>&copy; 2024 صيانة الأجهزة الذكية. جميع الحقوق محفوظة.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
