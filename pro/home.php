<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صيانة الأجهزة الذكية</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ملف CSS المخصص -->
    <link rel="stylesheet" href="test.css">

    <style>
        header {
            background-color: #343a40;
        }

        header .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        header .logo span {
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            margin-right: 10px;
        }

        header .nav-link {
            color: white;
            transition: color 0.3s;
        }

        header .nav-link:hover {
            color: #ffcc00;
        }
    </style>
    
</head>

<body dir="rtl" class="bg-light">

    <!-- الهيدر -->
    <?php include 'header.php'; ?>
    <style>
        .hero {
            background-image: url('https://t3.ftcdn.net/jpg/05/19/73/36/360_F_519733648_tSMSHwqxw3TrbgFSXNKJVKncdkC0siTq.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

  
    </style>




    <!-- قسم البطل (Hero Section) -->
    <section class="hero text-center text-white">
        <div class="container">
            <h2 class="display-4 mb-4">إصلاح وصيانة جميع أنواع الأجهزة الذكية</h2>
            <p class="lead mb-5">نقدم خدمات عالية الجودة لإصلاح الهواتف الذكية، الأجهزة اللوحية والمزيد.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="order.php" class="btn btn-primary btn-lg px-4">احجز الآن</a>
                <a href="costmer.php" class="btn btn-primary btn-lg px-4">عرض الطلبات</a>
            </div>
        </div>
    </section>

    <!-- قسم الخدمات -->
    <section class="services py-5">
        <div class="container">
            <h2 class="text-center mb-4">خدماتنا</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 service-card">
                        <div class="card-body text-center">
                            <h3 class="card-title text-primary mb-3">إصلاح الشاشات</h3>
                            <p class="card-text">إصلاح واستبدال شاشات الهواتف الذكية التالفة بأعلى جودة.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 service-card">
                        <div class="card-body text-center">
                            <h3 class="card-title text-primary mb-3">صيانة البطارية</h3>
                            <p class="card-text">استبدال وصيانة البطاريات لضمان أفضل أداء لجهازك.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 service-card">
                        <div class="card-body text-center">
                            <h3 class="card-title text-primary mb-3">إصلاح مشاكل النظام</h3>
                            <p class="card-text">حل مشاكل البرمجيات والتحديثات لضمان عمل جهازك بكفاءة.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم شهادات العملاء -->
    <section class="testimonials py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">ماذا يقول عملاؤنا</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <blockquote class="blockquote bg-white p-4 rounded shadow-sm">
                        <p class="mb-0">خدمة رائعة وسريعة! تم إصلاح هاتفي في ساعة واحدة.</p>
                        <footer class="blockquote-footer mt-2">عميل سعيد</footer>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="blockquote bg-white p-4 rounded shadow-sm">
                        <p class="mb-0">أفضل مكان لصيانة الأجهزة، خدمات ممتازة  .</p>
                        <footer class="blockquote-footer mt-2">عميل راضٍ</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- الفوتر -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 صيانة الأجهزة الذكية. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
