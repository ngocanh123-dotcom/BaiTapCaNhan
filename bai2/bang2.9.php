
<?php
// Khoi tao du lieu
$name = "";
$attendance = "";
$midterm = "";
$final = "";
$errors = [];
$total = null;
$classification = "";

// Ham kiem tra diem tu 0 den 10
function isValidScore($score): bool
{
    return $score !== ""
        && is_numeric($score)
        && $score >= 0
        && $score <= 10;
}

// Ham tinh diem tong ket
function finalScore(float $cc, float $mid, float $final): float
{
    return $cc * 0.10 + $mid * 0.30 + $final * 0.60;
}

// Xu ly form POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $attendance = trim($_POST["attendance"] ?? "");
    $midterm = trim($_POST["midterm"] ?? "");
    $final = trim($_POST["final"] ?? "");

    if ($name === "") {
        $errors[] = "Vui lòng nhập họ tên sinh viên.";
    }

    if (!isValidScore($attendance)) {
        $errors[] = "Điểm chuyên cần phải từ 0 đến 10.";
    }

    if (!isValidScore($midterm)) {
        $errors[] = "Điểm giữa kỳ phải từ 0 đến 10.";
    }

    if (!isValidScore($final)) {
        $errors[] = "Điểm cuối kỳ phải từ 0 đến 10.";
    }

    // Neu khong co loi thi tinh diem
    if (empty($errors)) {
        $total = finalScore(
            (float)$attendance,
            (float)$midterm,
            (float)$final
        );

        if ($total >= 8.5) {
            $classification = "Giỏi";
        } elseif ($total >= 7.0) {
            $classification = "Khá";
        } elseif ($total >= 5.0) {
            $classification = "Trung bình";
        } else {
            $classification = "Chưa đạt";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy tính điểm học phần</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 35px 15px;
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            color: #008b55;
            margin-top: 0;
        }

        .description {
            text-align: center;
            color: #64748b;
            line-height: 1.6;
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

        .errors {
            background: #fff0f0;
            color: #c62828;
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .result {
            background: #e8f7ee;
            color: #087443;
            padding: 20px;
            border-radius: 8px;
            margin-top: 22px;
            line-height: 1.9;
        }

        .result h2 {
            margin-top: 0;
        }

        .formula {
            background: #eef5ff;
            padding: 14px;
            border-radius: 8px;
            margin-top: 20px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>MÁY TÍNH ĐIỂM HỌC PHẦN</h1>

    <p class="description">
        Nhập điểm các thành phần để tính điểm tổng kết học phần.
    </p>

    <div class="formula">
        <strong>Công thức tính:</strong><br>
        Tổng kết = Chuyên cần × 10% + Giữa kỳ × 30% + Cuối kỳ × 60%
    </div>

    <form method="post" action="">
        <label for="name">Họ tên sinh viên:</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Nhập họ tên"
            value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="attendance">Điểm chuyên cần (0–10):</label>
        <input
            type="number"
            id="attendance"
            name="attendance"
            min="0"
            max="10"
            step="any"
            placeholder="Ví dụ: 9"
            value="<?php echo htmlspecialchars($attendance, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="midterm">Điểm giữa kỳ (0–10):</label>
        <input
            type="number"
            id="midterm"
            name="midterm"
            min="0"
            max="10"
            step="any"
            placeholder="Ví dụ: 7.5"
            value="<?php echo htmlspecialchars($midterm, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="final">Điểm cuối kỳ (0–10):</label>
        <input
            type="number"
            id="final"
            name="final"
            min="0"
            max="10"
            step="any"
            placeholder="Ví dụ: 8"
            value="<?php echo htmlspecialchars($final, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">TÍNH ĐIỂM HỌC PHẦN</button>
    </form>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <strong>Vui lòng kiểm tra lại:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($total !== null): ?>
        <div class="result">
            <h2>KẾT QUẢ HỌC PHẦN</h2>

            Sinh viên:
            <strong>
                <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>
            </strong>
            <br>

            Điểm chuyên cần: <?php echo $attendance; ?>
            <br>

            Điểm giữa kỳ: <?php echo $midterm; ?>
            <br>

            Điểm cuối kỳ: <?php echo $final; ?>
            <br>

            Điểm tổng kết:
            <strong><?php echo number_format($total, 2); ?></strong>
            <br>

            Xếp loại:
            <strong><?php echo $classification; ?></strong>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
