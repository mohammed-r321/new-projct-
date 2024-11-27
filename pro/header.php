<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <h1 class="h3">
                <img src="img/design_2.jpg" alt="شعار الموقع" class="logo">
            </h1>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="home.php" class="nav-link text-white">الرئيسية</a></li>
                <?php
                // تحقق مما إذا كانت الجلسة قد بدأت بالفعل
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // تحقق من حالة تسجيل الدخول
                if (isset($_SESSION['uid'])) {
                    echo '<li class="nav-item"><a href="logout.php" class="nav-link text-white">تسجيل الخروج</a></li>';
                } else {
                    echo '<li class="nav-item"><a href="login.php" class="nav-link text-white">تسجيل الدخول</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
