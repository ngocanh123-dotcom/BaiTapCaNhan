
<?php
$diem = "";
$thongBao = "";
$loi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diem = trim($_POST["diem"] ?? "");

    if ($diem === "" || !is_numeric($diem)) {
        $loi = "Vui lòng nhập điểm là một số!";
    } elseif ($diem < 0 || $diem > 10) {
        $loi = "Điểm không hợp lệ! Điểm phải từ 0 đến 10.";
    } else {
        $thongBao = "Điểm hợp lệ: " . $diem;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiểm tra điểm PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 40px 15px;
            color: #243447;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #008b55;
        }

        label {
            display: block;
            margin: 20px 0 8px;
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
            margin-top: 18px;
            padding: 12px;
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

        .result {
            margin-top: 20px;
            padding: 12px;
            border-radius: 6px;
            background: #e8f7ee;
            color: #087443;
        }

        .error {
            margin-top: 20px;
            padding: 12px;
            border-radius: 6px;
            background: #fff0f0;
            color: #c62828;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>KIỂM TRA ĐIỂM</h1>

        <form method="POST" action="">
            <label for="diem">Nhập điểm của bạn (0 - 10):</label>

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

            <button type="submit">Kiểm tra điểm</button>
        </form>

        <?php if ($thongBao !== ""): ?>
            <div class="result">
                <?php echo htmlspecialchars($thongBao, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if ($loi !== ""): ?>
            <div class="error">
                <?php echo htmlspecialchars($loi, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
