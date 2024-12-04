<?php
session_start();
include 'conn.php'; // الاتصال بقاعدة البيانات

// التحقق من تسجيل الدخول ومستوى المستخدم
if (!isset($_SESSION['uid']) || $_SESSION['level'] != 1) {
    header('Location: login.php');
    exit;
}

// استعلام لجلب جميع المستخدمين
$sql = "SELECT * FROM users";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المستخدمين</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- الهيدر -->
    <?php include 'header.php'; ?>

    <!-- قسم عرض المستخدمين -->
    <section class="users py-5">
        <div class="container">
            <h2 class="text-center mb-4">جميع المستخدمين</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">رقم المستخدم</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">البريد الإلكتروني</th>
                        <th scope="col">المستوى</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($query) {
                        $row_num = mysqli_num_rows($query);

                        if ($row_num > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["name"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . ($row["level"] == 1 ? "مدير" : "مستخدم") . "</td>
                                    <td>
                                        <a href='edit_user.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning'>تعديل</a>
                                        <a href='delete_user.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"هل أنت متأكد من حذف هذا المستخدم؟\")'>حذف</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>لا يوجد مستخدمون مسجلون.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>حدث خطأ أثناء جلب البيانات.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- الفوتر -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; صيانة الأجهزة الذكية. جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
