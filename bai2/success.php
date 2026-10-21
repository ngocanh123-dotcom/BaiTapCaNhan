
<?php
session_start();

if (!isset($_SESSION['student'])) {
    header('Location: dangky.php');
    exit;
}

$student = $_SESSION['student'];

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành công</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 35px 15px;
            color: #243447;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,.08);
        }

        h1 {
            color: #008b55;
        }

        .result {
            background: #e8f7ee;
            padding: 20px;
            border-radius: 8px;
            line-height: 2;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #087443;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>ĐĂNG KÝ THÀNH CÔNG!</h1>

    <div class="result">
        <strong>Thông tin sinh viên</strong><br>
        Họ tên: <?= e($student['name']) ?><br>
        Email: <?= e($student['email']) ?><br>
        Ngày sinh: <?= e($student['birthday']) ?>
    </div>

    <a href="dangky.php">Quay lại trang đăng ký</a>
</div>
</body>
</html>
