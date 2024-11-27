<?php
session_start();
session_unset();
session_destroy();
header("Location: home.php"); // إعادة توجيه المستخدم إلى الصفحة الرئيسية
exit();
?>