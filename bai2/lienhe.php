
<?php
$errors = [];
$success = "";
$name = "";
$email = "";
$subject = "";
$message = "";
$avatarName = "";

// Xu ly form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // 1. Kiem tra ho ten
    if ($name === "") {
        $errors[] = "Vui lòng nhập họ tên.";
    }

    // 2. Kiem tra email
    if ($email === "") {
        $errors[] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không đúng định dạng.";
    }

    // 3. Kiem tra chu de
    $allowedSubjects = [
        "Ho tro ky thuat",
        "Gop y",
        "Tu van",
        "Khac"
    ];

    if (!in_array($subject, $allowedSubjects, true)) {
        $errors[] = "Vui lòng chọn chủ đề hợp lệ.";
    }

    // 4. Kiem tra noi dung
    $messageLength = function_exists("mb_strlen")
        ? mb_strlen($message, "UTF-8")
        : strlen($message);

    if ($message === "") {
        $errors[] = "Vui lòng nhập nội dung liên hệ.";
    } elseif ($messageLength < 10 || $messageLength > 500) {
        $errors[] = "Nội dung phải từ 10 đến 500 ký tự.";
    }

    // 5. Kiem tra anh dai dien
    if (
        !isset($_FILES["avatar"]) ||
        $_FILES["avatar"]["error"] === UPLOAD_ERR_NO_FILE
    ) {
        $errors[] = "Vui lòng chọn ảnh đại diện.";
    } elseif ($_FILES["avatar"]["error"] !== UPLOAD_ERR_OK) {
        $errors[] = "Không thể tải ảnh lên. Vui lòng thử lại.";
    } else {
        $file = $_FILES["avatar"];
        $maxSize = 2 * 1024 * 1024;

        // Kiem tra dung luong
        if ($file["size"] > $maxSize) {
            $errors[] = "Ảnh không được vượt quá 2 MB.";
        }

        // Kiem tra dinh dang anh thuc te
        $imageInfo = @getimagesize($file["tmp_name"]);
        $allowedTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ];

        $mime = $imageInfo["mime"] ?? "";

        if (
            $imageInfo === false ||
            !isset($allowedTypes[$mime])
        ) {
            $errors[] = "Ảnh phải có định dạng JPG, PNG hoặc WEBP.";
        }
    }

    // Neu hop le thi luu anh va thong bao thanh cong
    if (empty($errors)) {
        $uploadDir = __DIR__ . "/uploads/";

        if (
            !is_dir($uploadDir) &&
            !mkdir($uploadDir, 0755, true)
        ) {
            $errors[] = "Không thể tạo thư mục lưu ảnh.";
        }

        if (empty($errors)) {
            $extension = $allowedTypes[$mime];
            $avatarName = bin2hex(random_bytes(16))
                . "." . $extension;

            if (
                !move_uploaded_file(
                    $_FILES["avatar"]["tmp_name"],
                    $uploadDir . $avatarName
                )
            ) {
                $errors[] = "Không thể lưu ảnh. Vui lòng thử lại.";
            } else {
                $success = "Gửi liên hệ thành công!";
            }
        }
    }
}

// Ham hien thi du lieu an toan
function e($value) {
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form liên hệ</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
        }

        .container {
            max-width: 650px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,.08);
        }

        h1 {
            margin-top: 0;
            text-align: center;
            color: #246da5;
        }

        .description {
            text-align: center;
            color: #64748b;
            margin-bottom: 28px;
        }

        label {
            display: block;
            margin: 17px 0 8px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus, select:focus, textarea:focus {
            outline: 2px solid #b9d9f5;
            border-color: #2676b8;
        }

        .hint {
            margin-top: 7px;
            font-size: 13px;
            color: #64748b;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 13px;
            border: none;
            border-radius: 6px;
            background: #2676b8;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #185b91;
        }

        .errors, .success {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 7px;
            line-height: 1.7;
        }

        .errors {
            color: #b42318;
            background: #fff0f0;
        }

        .success {
            color: #087443;
            background: #e8f7ee;
        }

        .avatar {
            display: block;
            max-width: 150px;
            max-height: 150px;
            margin-top: 12px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Liên hệ</h1>
    <p class="description">
        Vui lòng nhập đầy đủ thông tin bên dưới.
    </p>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <strong>Vui lòng kiểm tra lại:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success !== ""): ?>
        <div class="success">
            <strong><?= e($success) ?></strong><br>
            Họ tên: <?= e($name) ?><br>
            Email: <?= e($email) ?><br>
            Chủ đề: <?= e($subject) ?><br>
            Nội dung: <?= e($message) ?><br>
            Ảnh đại diện: <?= e($avatarName) ?>
            <img
                class="avatar"
                src="<?= e("uploads/" . $avatarName) ?>"
                alt="Ảnh đại diện"
            >
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" action="">
        <label for="name">Họ tên</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Nhập họ tên"
            value="<?= e($name) ?>"
            required
        >

        <label for="email">Email</label>
        <input
            type="text"
            id="email"
            name="email"
            placeholder="example@gmail.com"
            value="<?= e($email) ?>"
            required
        >

        <label for="subject">Chủ đề</label>
        <select id="subject" name="subject" required>
            <option value="">-- Chọn chủ đề --</option>
            <option value="Ho tro ky thuat"
                <?= $subject === "Ho tro ky thuat" ? "selected" : "" ?>>
                Hỗ trợ kỹ thuật
            </option>
            <option value="Gop y"
                <?= $subject === "Gop y" ? "selected" : "" ?>>
                Góp ý
            </option>
            <option value="Tu van"
                <?= $subject === "Tu van" ? "selected" : "" ?>>
                Tư vấn
            </option>
            <option value="Khac"
                <?= $subject === "Khac" ? "selected" : "" ?>>
                Khác
            </option>
        </select>

        <label for="message">Nội dung</label>
        <textarea
            id="message"
            name="message"
            minlength="10"
            maxlength="500"
            placeholder="Nhập nội dung liên hệ..."
            required
        ><?= e($message) ?></textarea>
        <div class="hint">Nội dung phải từ 10 đến 500 ký tự.</div>

        <label for="avatar">Ảnh đại diện</label>
        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,.webp"
            required
        >
        <div class="hint">
            Chỉ nhận JPG, PNG, WEBP; dung lượng tối đa 2 MB.
        </div>

        <button type="submit">Gửi liên hệ</button>
    </form>
</div>
</body>
</html>
