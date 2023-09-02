<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
</head>
<style>
    .parallelogram-button {
        /* width: 150px;
        height: 50px; */
        background-color: #4CAF50;
        color: white;
        border: none;
        transform: skewX(-20deg);
    }

    .parallelogram-button:hover {
        background-color: #45a049;
    }
</style>

<body>
    <div class="" style="display: flex">
        <input type="file" id="input" required>
        <form action="/doc-file-excel" method="post" id="sendExcelFileData">
            <input name="excelFileData" id="inputSend" type="hidden">
            <button type="button" class="parallelogram-button" onclick="readFile()">OK</button><br>
            @csrf
        </form>
    </div>
    <script>
        var readFileExcelResult = [];
        var fileInput = document.getElementById('input');
        fileInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, {
                    type: 'array'
                });

                workbook.SheetNames.forEach(function(sheetName) {
                    var worksheet = workbook.Sheets[sheetName];
                    var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    });

                    // console.log('Sheet Name:', sheetName);
                    // console.log('Sheet Data:', jsonData);

                    readFileExcelResult = readFileExcelResult.concat("|" + sheetName);
                    readFileExcelResult = readFileExcelResult.concat("//" + jsonData);
                });
            };
            reader.readAsArrayBuffer(file);

        });

        function readFile() {
            var fileInput = document.getElementById("input");
            if (fileInput.files.length === 0) {
                alert("Vui lòng chọn một file!");
                return false;
            } else {
                console.log(JSON.stringify(readFileExcelResult));
                document.getElementById("inputSend").value = JSON.stringify(readFileExcelResult).replace(/["\[\]]/g, '');
                readFileExcelResult = [];
                document.getElementById("sendExcelFileData").submit();
            }

        }
    </script>

</body>

</html>
