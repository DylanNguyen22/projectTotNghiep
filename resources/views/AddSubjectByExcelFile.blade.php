@extends('Layout.Layout')

@section('content')
    {{-- <div class="input-group">
        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
            aria-label="Upload">
        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
    </div> --}}
    <div class="pt-4">
        <div class="input-group px-3">
            <input type="file" class="form-control border-primary" id="readExcelFile_Input">
            {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
        </div>
    </div>
    <div id="excelFileContent" class="d-flex justify-content-center align-items-center px-3"
        style="min-height: 75vh!important">
        <h3 class="text-secondary"><---Nội dung file excel của bạn sẽ hiển thị ở đây---></h3>
    </div>
    <div id="submitionSection" class="d-flex justify-content-end pb-2 pe-3">
        <button class="btn btn-secondary">Lưu</button>
    </div>

    <script>
        var originalContent = document.getElementById("submitionSection").innerHTML;

        var h3 = document.getElementById("excelFileContent").innerHTML;
        var readFileExcelResult = [];
        var fileInput = document.getElementById('readExcelFile_Input');
        fileInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            var fileType = file.name.split('.').pop().toLowerCase();
            if (fileType === "xls" || fileType === "xlsx") {
                // console.log("OK \n");
                // console.log(file.name.split('.').pop().toLowerCase());

                var reader = new FileReader();

                var submitionSection = document.getElementById("submitionSection");
                submitionSection.innerHTML = "";

                form = document.createElement('form');
                form.action = "/monhoc/xu-ly-them-mon-hoc-bang-excel-file";
                form.method = "GET"

                input = document.createElement("input");
                input.id = "excelFileData";
                input.name = "excelData";
                input.type = "hidden";

                var button = document.createElement("button");
                button.setAttribute("onclick", "readFile()");
                button.type = "submit";
                button.className = "btn btn-primary";
                button.textContent = "Lưu";

                var div = document.createElement("div");
                div.className = "input-group mb-3";

                var label = document.createElement("label");
                label.className = "input-group-text bg-primary text-light";
                label.id = "inputGroupSelect01";
                label.textContent = "Ngành học";

                var select = document.createElement("select");
                select.className = "form-select";
                select.id = "inputGroupSelect01";
                select.name = "majorId";

                $.ajax({
                    url: "{{ route('major.list') }}",
                    type: 'GET',
                    success: function(response) {
                        Object.keys(response).forEach(key => {
                            var option = document.createElement("option");
                            option.value = response[key].MaNganh;
                            option.textContent = response[key].TenNganh;

                            select.appendChild(option);
                        });
                    }
                })
                div.appendChild(label);
                div.appendChild(select);
                div.appendChild(button);
                form.appendChild(div);





                form.appendChild(input);
                // form.appendChild(button);
                submitionSection.appendChild(form);

                document.getElementById("excelFileContent").innerHTML = "";
                document.getElementById(
                    "excelFileContent").className = "px-2"
                var number = 1;

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
                        var div = document.createElement("div");
                        div.className = "mt-3"

                        var div2 = document.createElement("div");
                        div2.textContent = sheetName;
                        div2.className = "ms-2 fw-bold text-primary"

                        div.appendChild(div2);

                        var table = document.createElement("table");
                        table.className = "table table-striped";
                        table.id = "sheetDataTable" + number;

                        var thead = document.createElement("thead");
                        var tbody = document.createElement("tbody");


                        // console.log('Sheet Name:', sheetName);
                        // console.log('Sheet Data:', jsonData);

                        Object.keys(jsonData).forEach(key => {
                            // console.log(jsonData[key]);

                            if (jsonData[key][0] == "STT") {
                                var tr = document.createElement("tr");
                                var th1 = document.createElement("th");
                                th1.textContent = jsonData[key][0];
                                var th2 = document.createElement("th");
                                th2.textContent = jsonData[key][1];
                                var th3 = document.createElement("th");
                                th3.textContent = jsonData[key][2];
                                var th4 = document.createElement("th");
                                th4.textContent = jsonData[key][3];
                                var th5 = document.createElement("th");
                                th5.textContent = jsonData[key][4];
                                tr.appendChild(th1);
                                tr.appendChild(th2);
                                tr.appendChild(th3);
                                tr.appendChild(th4);
                                tr.appendChild(th5);

                                thead.appendChild(tr);
                                table.appendChild(thead);
                            } else {
                                if (jsonData[key][0] === undefined) {

                                } else {
                                    var tr = document.createElement("tr");
                                    var td1 = document.createElement("td");
                                    td1.textContent = jsonData[key][0];
                                    var td2 = document.createElement("td");
                                    td2.textContent = jsonData[key][1];
                                    var td3 = document.createElement("td");
                                    td3.textContent = jsonData[key][2];
                                    var td4 = document.createElement("td");
                                    td4.textContent = jsonData[key][3];
                                    var td5 = document.createElement("td");
                                    td5.textContent = jsonData[key][4];
                                    tr.appendChild(td1);
                                    tr.appendChild(td2);
                                    tr.appendChild(td3);
                                    tr.appendChild(td4);
                                    tr.appendChild(td5);

                                    tbody.appendChild(tr);
                                }

                            }
                            // var data = jsonData[key];
                            // Object.keys(data).forEach(key => {
                            //     console.log(data[key])
                            // });

                            var tr = document.createElement("tr");


                        });
                        table.appendChild(tbody);
                        div.appendChild(table)

                        document.getElementById("excelFileContent").appendChild(div);
                        number = 2;

                        readFileExcelResult = readFileExcelResult.concat("|" + sheetName);
                        readFileExcelResult = readFileExcelResult.concat("//" + jsonData);
                    });
                };
                reader.readAsArrayBuffer(file);
            } else {
                alert("Vui lòng chọn file có định dạng .xls hoặc .xlsx");

                document.getElementById("submitionSection").innerHTML = originalContent;
                document.getElementById("excelFileContent").className =
                    "d-flex justify-content-center align-items-center px-3";
                document.getElementById("excelFileContent").innerHTML = h3;
            }

        });

        function readFile() {
            var fileInput = document.getElementById("readExcelFile_Input");
            if (fileInput.files.length === 0) {
                alert("Vui lòng chọn một file!");
                return false;
            } else {
                var userConfirmation = confirm("Do you want to run the code?");

                if (userConfirmation) {
                    console.log("Code được chạy!");

                    console.log(JSON.stringify(readFileExcelResult));
                    document.getElementById("excelFileData").value = JSON.stringify(readFileExcelResult)
                        .replace(/["\[\]]/g,
                            '');
                    readFileExcelResult = [];
                    // document.getElementById("sendExcelFileData").submit();
                } else {
                    console.log("Code được chạy!");
                }
            }

        }
    </script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
@endsection
