
<?php
$diem = "";
$ketQua = "";
$loi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diem = trim($_POST["diem"] ?? "");

    // Kiem tra du lieu dau vao
    if ($diem === "" || !is_numeric($diem)) {
        $loi = "Vui lòng nhập điểm là một số!";
    } elseif ($diem < 0 || $diem > 10) {
        $loi = "Điểm phải nằm trong khoảng từ 0 đến 10!";
    } else {
        // Xep loai tu cao xuong thap
        if ($diem >= 8) {
            $ketQua = "Giỏi";
        } elseif ($diem >= 6.5) {
            $ketQua = "Khá";
        } elseif ($diem >= 5) {
            $ketQua = "Trung bình";
        } else {
            $ketQua = "Chưa đạt";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xếp loại điểm PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 35px 15px;
        }

        .container {
            max-width: 550px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #008b55;
        }

        label {
            display: block;
            margin: 22px 0 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 18px;
            border: none;
            border-radius: 6px;
            background: #00a65a;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #008b4b;
        }

        .result, .error {
            padding: 15px;
            margin-top: 20px;
            border-radius: 6px;
        }

        .result {
            background: #e8f7ee;
            color: #087443;
        }

        .error {
            background: #fff0f0;
            color: #c62828;
        }

        .note {
            margin-top: 25px;
            padding: 15px;
            background: #eaf3ff;
            border-radius: 8px;
            line-height: 1.8;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>XẾP LOẠI ĐIỂM HỌC TẬP</h1>

    <form method="POST" action="">
        <label for="diem">Nhập điểm (0 - 10):</label>

        <input
            type="number"
            id="diem"
            name="diem"
            min="0"
            max="10"
            step="any"
            placeholder="Ví dụ: 8.5"
            value="<?php echo htmlspecialchars($diem, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">Xếp loại điểm</button>
    </form>

    <?php if ($ketQua !== ""): ?>
        <div class="result">
            <strong>
                Điểm của bạn: <?php echo htmlspecialchars($diem, ENT_QUOTES, 'UTF-8'); ?>
            </strong>
            <br><br>
            Xếp loại:
            <strong><?php echo htmlspecialchars($ketQua, ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
    <?php endif; ?>

    <?php if ($loi !== ""): ?>
        <div class="error">
            <?php echo htmlspecialchars($loi, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="note">
        <strong>Quy tắc xếp loại:</strong><br>
        Điểm từ 8 đến 10: Giỏi<br>
        Điểm từ 6.5 đến dưới 8: Khá<br>
        Điểm từ 5 đến dưới 6.5: Trung bình<br>
        Điểm dưới 5: Chưa đạt
    </div>
</div>
</body>
</html>
