<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <style type="text/css">
        th, td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <table class="tg table table-striped table-bordered" id="xport">
        <tr>
            <th class="text-uppercase" colspan="13">Thống kê giờ giảng dạy lý thuyết, thực hành năm học ...</th>
        </tr>
        <tr>
            <th class="text-uppercase" colspan="13">Khoa công nghệ thông tin</th>
        </tr>
        <tr>
            <th rowspan="2">Số thứ tự</th>
            <th rowspan="2">Tên giảng viên</th>  
            <th colspan="5">Giờ lý thuyết</th>
            <th colspan="5">Giờ thực hành</th>
            <th rowspan="2">Tổng cộng</th>
        </tr>
        <tr>
            <th>Học kỳ</th>
            <th>Số tiết</th>
            <th>Số SV</th>
            <th>Hệ số</th>
            <th>Quy chuẩn ra</th>
            <th>Học kì</th>
            <th>Số tín chỉ</th>
            <th>Số SV</th>
            <th>Định mức/1sv</th>
            <th>Quy ra giờ chuẩn</th>
        </tr>


        <tr>
            <td rowspan="3">1</td>
            <td rowspan="3">Nguyễn Văn A</td>
            <td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td>
            <td rowspan="3">total</td>
        </tr>
        <tr>
            <td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td>
        </tr>
        <tr>
            <td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td><td>2</td>
        </tr>

    </table>

    <button onclick="exportToExcel()">Export to Excel</button>

    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/shim.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

    <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
    <script>
        function exportToExcel() {
            var tbl = document.getElementById("xport");
            const wb = XLSX.utils.table_to_book(tbl);
            XLSX.writeFile(wb, "HTMLTable.xlsx");
        }
    </script>

</body>

</html>
