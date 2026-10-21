
<?php
// Ham tinh diem tong ket
function finalScore(float $cc, float $mid, float $final): float
{
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

$cc = "";
$mid = "";
$final = "";
$ketQua = null;
$loi = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cc = trim($_POST["cc"] ?? "");
    $mid = trim($_POST["mid"] ?? "");
    $final = trim($_POST["final"] ?? "");

    if (
        $cc === "" || $mid === "" || $final === "" ||
        !is_numeric($cc) || !is_numeric($mid) || !is_numeric($final)
    ) {
        $loi = "Vui lòng nhập đầy đủ 3 điểm bằng số!";
    } elseif (
        $cc < 0 || $cc > 10 ||
        $mid < 0 || $mid > 10 ||
        $final < 0 || $final > 10
    ) {
        $loi = "Mỗi điểm phải nằm trong khoảng từ 0 đến 10!";
    } else {
        $ketQua = finalScore((float)$cc, (float)$mid, (float)$final);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính điểm tổng kết PHP</title>

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
            margin: 18px 0 8px;
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
            margin-top: 22px;
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

        .result, .error {
            margin-top: 20px;
            padding: 15px;
            border-radius: 6px;
            line-height: 1.7;
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
            margin-top: 22px;
            padding: 15px;
            background: #eaf3ff;
            border-radius: 8px;
            line-height: 1.8;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>TÍNH ĐIỂM TỔNG KẾT</h1>

    <form method="POST" action="">
        <label for="cc">Điểm chuyên cần (10%):</label>
        <input
            type="number" id="cc" name="cc"
            min="0" max="10" step="any"
            placeholder="Nhập điểm chuyên cần"
            value="<?php echo htmlspecialchars($cc, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="mid">Điểm giữa kỳ (30%):</label>
        <input
            type="number" id="mid" name="mid"
            min="0" max="10" step="any"
            placeholder="Nhập điểm giữa kỳ"
            value="<?php echo htmlspecialchars($mid, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="final">Điểm cuối kỳ (60%):</label>
        <input
            type="number" id="final" name="final"
            min="0" max="10" step="any"
            placeholder="Nhập điểm cuối kỳ"
            value="<?php echo htmlspecialchars($final, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">Tính điểm tổng kết</button>
    </form>

    <?php if ($ketQua !== null): ?>
        <div class="result">
            <strong>Kết quả tính điểm</strong><br>
            Chuyên cần: <?php echo htmlspecialchars($cc); ?> × 10%<br>
            Giữa kỳ: <?php echo htmlspecialchars($mid); ?> × 30%<br>
            Cuối kỳ: <?php echo htmlspecialchars($final); ?> × 60%<br>
            <hr>
            <strong>
                Điểm tổng kết:
                <?php echo number_format($ketQua, 2); ?>
            </strong>
        </div>
    <?php endif; ?>

    <?php if ($loi !== ""): ?>
        <div class="error">
            <?php echo htmlspecialchars($loi, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="note">
        <strong>Công thức tính:</strong><br>
        Điểm tổng kết = Chuyên cần × 0.10
        + Giữa kỳ × 0.30
        + Cuối kỳ × 0.60
    </div>
</div>
</body>
</html>
