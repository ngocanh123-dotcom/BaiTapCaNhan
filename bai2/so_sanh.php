
<?php
// 1. KHAI BAO CAC GIA TRI
$a = 0;
$b = "0";
$c = false;

// 2. SO SANH LONG ==
$kq1 = ($a == $b);
$kq2 = ($a == $c);
$kq3 = ($c == $a);

// 3. SO SANH CHAT ===
$kq4 = ($a === $b);
$kq5 = ($a === $c);
$kq6 = ($c === $a);

// Ham hien thi ket qua
function hienThi($ketQua) {
    return $ketQua ? "true" : "false";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>So sánh == và === trong PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 30px 15px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #008b55;
        }

        h2 {
            color: #087443;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            border: 1px solid #dbe3ec;
            padding: 13px;
            text-align: center;
        }

        th {
            background: #008b55;
            color: white;
        }

        .true {
            color: #087443;
            font-weight: bold;
        }

        .false {
            color: #d62828;
            font-weight: bold;
        }

        .note {
            background: #eaf3ff;
            padding: 16px;
            border-radius: 8px;
            margin-top: 20px;
            line-height: 1.7;
        }

        code {
            background: #f1f5f9;
            padding: 3px 6px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>PHÂN BIỆT == VÀ ===</h1>

    <h2>1. Kết quả so sánh</h2>

    <table>
        <tr>
            <th>Biểu thức</th>
            <th>Kết quả</th>
            <th>Giải thích</th>
        </tr>

        <tr>
            <td>0 == "0"</td>
            <td class="<?php echo $kq1 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq1); ?>
            </td>
            <td>Giá trị bằng nhau sau khi chuyển kiểu</td>
        </tr>

        <tr>
            <td>0 === "0"</td>
            <td class="<?php echo $kq4 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq4); ?>
            </td>
            <td>Khác kiểu dữ liệu</td>
        </tr>

        <tr>
            <td>0 == false</td>
            <td class="<?php echo $kq2 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq2); ?>
            </td>
            <td>PHP coi hai giá trị tương đương khi so sánh lỏng</td>
        </tr>

        <tr>
            <td>0 === false</td>
            <td class="<?php echo $kq5 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq5); ?>
            </td>
            <td>Số nguyên khác kiểu Boolean</td>
        </tr>

        <tr>
            <td>false == 0</td>
            <td class="<?php echo $kq3 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq3); ?>
            </td>
            <td>Hai giá trị tương đương khi so sánh lỏng</td>
        </tr>

        <tr>
            <td>false === 0</td>
            <td class="<?php echo $kq6 ? 'true' : 'false'; ?>">
                <?php echo hienThi($kq6); ?>
            </td>
            <td>Boolean khác kiểu số nguyên</td>
        </tr>
    </table>

    <div class="note">
        <h2>2. Ghi nhớ</h2>

        <p><code>==</code> chỉ so sánh giá trị theo quy tắc chuyển đổi kiểu của PHP.</p>

        <p><code>===</code> so sánh cả giá trị và kiểu dữ liệu.</p>

        <p>
            Ví dụ: <code>0 == "0"</code> cho kết quả
            <strong>true</strong>, còn <code>0 === "0"</code>
            cho kết quả <strong>false</strong>.
        </p>
    </div>
</div>
</body>
</html>
