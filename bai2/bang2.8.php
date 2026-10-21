
<?php
// 1. Tao mang 3 sinh vien
$students = [
    [
        "name" => "Nguyen Van An",
        "midterm" => 7.5,
        "final" => 8.0
    ],
    [
        "name" => "Tran Thi Binh",
        "midterm" => 4.0,
        "final" => 5.0
    ],
    [
        "name" => "Le Van Chi",
        "midterm" => 6.0,
        "final" => 5.5
    ]
];

// 2. Ham tinh diem trung binh
function calculateAverage(float $midterm, float $final): float
{
    return ($midterm + $final) / 2;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm 3 sinh viên</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            color: #243447;
            padding: 35px 15px;
        }

        .container {
            max-width: 850px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        h1 {
            text-align: center;
            color: #008b55;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dbe3ec;
            padding: 14px 10px;
            text-align: center;
        }

        th {
            background: #00a65a;
            color: white;
        }

        tr:nth-child(even) {
            background: #f4f8fb;
        }

        .pass {
            color: #087443;
            font-weight: bold;
        }

        .fail {
            color: #c62828;
            font-weight: bold;
        }

        .note {
            margin-top: 22px;
            padding: 15px;
            background: #e8f7ee;
            border-radius: 8px;
            line-height: 1.8;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>BẢNG ĐIỂM 3 SINH VIÊN</h1>

    <p>
        Điểm trung bình = (Điểm giữa kỳ + Điểm cuối kỳ) / 2
    </p>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ tên sinh viên</th>
                <th>Giữa kỳ</th>
                <th>Cuối kỳ</th>
                <th>Trung bình</th>
                <th>Kết quả</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($students as $index => $student): ?>
                <?php
                    $average = calculateAverage(
                        $student["midterm"],
                        $student["final"]
                    );

                    $result = ($average >= 5) ? "Đạt" : "Chưa đạt";
                ?>

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

                    <td><?php echo $student["midterm"]; ?></td>

                    <td><?php echo $student["final"]; ?></td>

                    <td><?php echo number_format($average, 2); ?></td>

                    <td class="<?php echo $average >= 5 ? 'pass' : 'fail'; ?>">
                        <?php echo $result; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="note">
        <strong>Quy tắc:</strong><br>
        - Điểm trung bình từ 5 trở lên: Đạt.<br>
        - Điểm trung bình dưới 5: Chưa đạt.
    </div>
</div>
</body>
</html>
