
<?php
// Ham dinh dang tien
function money(float $value): string {
    return number_format($value, 0, ',', '.') . ' đ';
}

// Khoi tao du lieu
$name = "";
$qty = "";
$price = "";
$total = null;
$error = "";

// Doc du lieu tu POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $qtyInput = trim($_POST["qty"] ?? "");
    $priceInput = trim($_POST["price"] ?? "");

    // Kiem tra du lieu
    if ($name === "") {
        $error = "Vui lòng nhập tên tài liệu!";
    } elseif (
        $qtyInput === "" || !ctype_digit($qtyInput) ||
        $priceInput === "" || !is_numeric($priceInput)
    ) {
        $error = "Số lượng phải là số nguyên dương và đơn giá phải là số!";
    } elseif ((int)$qtyInput < 1 || (float)$priceInput < 0) {
        $error = "Số lượng phải từ 1 trở lên, đơn giá không được âm!";
    } else {
        // Ep kieu va tinh thanh tien
        $qty = (int)$qtyInput;
        $price = (float)$priceInput;
        $total = $qty * $price;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn học liệu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 35px 15px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
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
            margin-top: 22px;
            padding: 18px;
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
    <h1>HÓA ĐƠN HỌC LIỆU</h1>

    <form method="post" action="">
        <label for="name">Tên tài liệu:</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Ví dụ: Lập trình web"
            value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="qty">Số lượng:</label>
        <input
            type="number"
            id="qty"
            name="qty"
            min="1"
            step="1"
            placeholder="Nhập số lượng"
            value="<?php echo htmlspecialchars((string)$qty, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <label for="price">Đơn giá (đồng):</label>
        <input
            type="number"
            id="price"
            name="price"
            min="0"
            step="any"
            placeholder="Nhập đơn giá"
            value="<?php echo htmlspecialchars((string)$price, ENT_QUOTES, 'UTF-8'); ?>"
            required
        >

        <button type="submit">Tính hóa đơn</button>
    </form>

    <?php if ($error !== ""): ?>
        <div class="error">
            <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if ($total !== null): ?>
        <div class="result">
            <strong>KẾT QUẢ HÓA ĐƠN</strong><br>
            Tên tài liệu:
            <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?><br>

            Số lượng: <?php echo $qty; ?><br>
            Đơn giá: <?php echo money($price); ?><br>

            <hr>

            <strong>Thành tiền: <?php echo money($total); ?></strong>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
