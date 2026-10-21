
<?php
// 1. MANG CHI SO
$monHoc = ["PHP", "HTML", "CSS"];

// 2. MANG KET HOP: 3 SINH VIEN
$students = [
    ["name" => "An",   "score" => 8.0],
    ["name" => "Binh", "score" => 6.5],
    ["name" => "Chi",  "score" => 4.5]
];

// 3. HAM XEP LOAI
function xepLoai($diem)
{
    if ($diem >= 8) {
        return "Giỏi";
    } elseif ($diem >= 6.5) {
        return "Khá";
    } elseif ($diem >= 5) {
        return "Trung bình";
    } else {
        return "Chưa đạt";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mảng sinh viên PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 30px 15px;
        }

        .container {
            max-width: 750px;
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
            margin-top: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #dbe3ec;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #00a65a;
            color: white;
        }

        tr:nth-child(even) {
            background: #f4f8fb;
        }

        .note {
            background: #eaf3ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 22px;
            line-height: 1.8;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>QUẢN LÝ DANH SÁCH SINH VIÊN</h1>

    <h2>1. Mảng chỉ số</h2>
    <p>Danh sách môn học:</p>

    <ul>
        <?php foreach ($monHoc as $mon): ?>
            <li>
                <?php echo htmlspecialchars($mon, ENT_QUOTES, 'UTF-8'); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>2. Mảng kết hợp – Thông tin sinh viên</h2>

    <table>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Điểm</th>
            <th>Xếp loại</th>
        </tr>

        <?php foreach ($students as $index => $student): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>

                <td>
                    <?php
                    echo htmlspecialchars(
                        $student["name"],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>
                </td>

                <td>
                    <?php echo $student["score"]; ?>
                </td>

                <td>
                    <?php echo xepLoai($student["score"]); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="note">
        <strong>Kiến thức áp dụng:</strong><br>
        - Mảng chỉ số: lưu danh sách môn học.<br>
        - Mảng kết hợp: mỗi sinh viên có khóa name và score.<br>
        - foreach: duyệt lần lượt từng sinh viên.<br>
        - Hàm xepLoai(): phân loại sinh viên theo điểm.
    </div>
</div>
</body>
</html>
