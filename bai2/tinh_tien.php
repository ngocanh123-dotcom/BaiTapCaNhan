
<?php
$tenTaiLieu = "";
$soLuong = "";
$donGia = "";
$thanhTien = null;
$loi = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tenTaiLieu = trim($_POST["tenTaiLieu"] ?? "");
    $soLuong = trim($_POST["soLuong"] ?? "");
    $donGia = trim($_POST["donGia"] ?? "");

    if ($tenTaiLieu === "") {
        $loi = "Vui lòng nhập tên tài liệu!";
    } elseif (
        $soLuong === "" || !is_numeric($soLuong) ||
        $donGia === "" || !is_numeric($donGia)
    ) {
        $loi = "Số lượng và đơn giá phải là số!";
    } elseif (
        $soLuong <= 0 || $soLuong != (int)$soLuong ||
        $donGia < 0
    ) {
        $loi = "Số lượng phải là số nguyên dương, đơn giá không được âm!";
    } else {
        $thanhTien = (float)$soLuong * (float)$donGia;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tiền tài liệu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 35px 15px;
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
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.8;
        }

        .result {
            background: #e8f7ee;
            color: #087443;
        }

        .error {
            background: #fff0f0;
            color: #c62828;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>TÍNH TIỀN TÀI LIỆU</h1>

    <form method="POST" action="">
        <label for="tenTaiLieu">Tên tài liệu:</label>
        <input
            type="text"
            id="tenTaiLieu"
            name="tenTaiLieu"
            placeholder="Ví dụ: Lập trình web"
            value="<?php echo htmlspecialchars($tenTaiLieu, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="soLuong">Số lượng:</label>
        <input
            type="number"
            id="soLuong"
            name="soLuong"
            min="1"
            step="1"
            placeholder="Nhập số lượng"
            value="<?php echo htmlspecialchars($soLuong, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="donGia">Đơn giá (đồng):</label>
        <input
            type="number"
            id="donGia"
            name="donGia"
            min="0"
            step="any"
            placeholder="Nhập đơn giá"
            value="<?php echo htmlspecialchars($donGia, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">Tính thành tiền</button>
    </form>

    <?php if ($thanhTien !== null): ?>
        <div class="result">
            <strong>Kết quả tính tiền</strong><br>
            Tên tài liệu:
            <?php echo htmlspecialchars($tenTaiLieu, ENT_QUOTES, 'UTF-8'); ?><br>

            Số lượng: <?php echo number_format((float)$soLuong); ?><br>
            Đơn giá: <?php echo number_format((float)$donGia, 0, ',', '.'); ?> đồng<br>

            <hr>

            <strong>
                Thành tiền:
                <?php echo number_format($thanhTien, 0, ',', '.'); ?> đồng
            </strong>
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
