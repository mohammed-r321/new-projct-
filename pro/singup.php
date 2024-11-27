<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="stylesheet" href="test.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حسابك</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    include 'header.php';
    $ms = '';
    $done = '';
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $uname = $_POST['username'];
        $pass1 = $_POST['password'];
        $pass2 = $_POST['confirm_password'];

        if ($pass1 !== $pass2) {
            $ms = "mismatched password";
        }

        if ($ms ==''){
            include 'conn.php';
            $sql = "insert into users (name,email,phone_num,uname,password,level) values ('$name','$email','$phone','$uname','$pass1',0)";
            $query = mysqli_query($conn,$sql);
            if ($query){
                $done = 'تم تسجيلك بنجاح';
            }
            mysqli_close($conn);
        }
    }
    ?>

<section class="login-form py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <h2 class="text-center mb-4">إنشاء حسابك</h2>
                    <form action="singup.php" method="post" class="p-4 border rounded shadow-sm">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">الإيميل</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">اسم المستخدم</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" id="confirm-password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg custom-btn" value="إرسال">
                        </div>
                        <?php if ($ms): ?>
                            <div class="alert alert-danger mt-3 text-center">
                                <?php echo $ms; ?>
                            </div>
                        <?php endif; ?>
                    </form>
                    <?php if ($done): ?>
                        <div class="alert alert-success mt-3 text-center">
                            <?php echo $done; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a></p>
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