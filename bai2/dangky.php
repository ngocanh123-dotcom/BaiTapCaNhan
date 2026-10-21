
<?php
$errors = [];
$data = [
    'name' => '',
    'email' => '',
    'birthday' => ''
];

// Xu ly khi gui form bang POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // Kiem tra ho ten
    if ($data['name'] === '') {
        $errors['name'] = 'Vui long nhap ho ten!';
    }

    // Kiem tra email
    if ($data['email'] === '') {
        $errors['email'] = 'Vui long nhap email!';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email khong hop le!';
    }

    // Kiem tra ngay sinh
    if ($data['birthday'] === '') {
        $errors['birthday'] = 'Vui long nhap ngay sinh!';
    } else {
        $date = DateTime::createFromFormat('!Y-m-d', $data['birthday']);

        if (!$date || $date->format('Y-m-d') !== $data['birthday']) {
            $errors['birthday'] = 'Ngay sinh khong hop le!';
        } elseif ($date > new DateTime('today')) {
            $errors['birthday'] = 'Ngay sinh khong duoc o tuong lai!';
        }
    }

    // Khong co loi thi chuyen trang
    if (empty($errors)) {
        session_start();
        $_SESSION['student'] = $data;

        header('Location: success.php');
        exit;
    }
}

// Ham hien thi du lieu an toan
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký sinh viên</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 35px 15px;
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
            text-align: center;
        }

        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #00a65a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #008b4b;
        }

        .error {
            color: #c62828;
            font-size: 14px;
            margin-top: 6px;
        }

        .notice {
            padding: 12px;
            background: #fff0f0;
            border-radius: 6px;
            color: #c62828;
            margin-top: 18px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>FORM ĐĂNG KÝ SINH VIÊN</h1>

    <p>Vui lòng nhập đầy đủ thông tin bên dưới.</p>

    <form method="post" action="">
        <label for="name">Họ và tên:</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Nhập họ và tên"
            value="<?= e($data['name']) ?>"
        >
        <?php if (isset($errors['name'])): ?>
            <div class="error"><?= e($errors['name']) ?></div>
        <?php endif; ?>

        <label for="email">Email:</label>
        <input
            type="text"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            value="<?= e($data['email']) ?>"
        >
        <?php if (isset($errors['email'])): ?>
            <div class="error"><?= e($errors['email']) ?></div>
        <?php endif; ?>

        <label for="birthday">Ngày sinh:</label>
        <input
            type="date"
            id="birthday"
            name="birthday"
            max="<?= date('Y-m-d') ?>"
            value="<?= e($data['birthday']) ?>"
        >
        <?php if (isset($errors['birthday'])): ?>
            <div class="error"><?= e($errors['birthday']) ?></div>
        <?php endif; ?>

        <button type="submit">ĐĂNG KÝ</button>
    </form>

    <?php if (!empty($errors)): ?>
        <div class="notice">
            Vui lòng kiểm tra và sửa các thông tin chưa hợp lệ.
        </div>
    <?php endif; ?>
</div>
</body>
</html>
