@extends('layout.layout')
@section('alert')
    <div class="" id="alert"></div>
@endsection

@section('content')
    <div class="">
        <form action="/monhoc/xu-ly-them-mon-hoc-bang-form" method="POST" id="addSubjectDetailForm">
            <div class="pb-2 pt-4 px-3">
                <div class="">
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Ngành học</span>
                        <select class="form-select" aria-label="Default select example" id="availableMajor"
                            name="availableMajor">
                            <option>Chọn ngành học đã lưu</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Nhập tên ngành học mới"
                            aria-label="Username" aria-describedby="basic-addon1" maxlength="30" name="newMajor">
                    </div>
                    <br>
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Môn học&ensp;&ensp;</span>
                        <select class="form-select" aria-label="Default select example" id="availableSubject"
                            name="availableSubject">
                            <option>Chọn môn học đã lưu</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Nhập mã môn học mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="12" name="newSubjectId">
                        <input type="text" class="form-control" placeholder="Nhập tên môn học mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="100" name="newSubjectName"
                            style="width: 44%!important">
                    </div>
                    <br>
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Năm học&ensp;&ensp;</span>
                        <select class="form-select" aria-label="Default select example" id="availableScholastic"
                            name="availableScholastic">
                            <option>Chọn năm học đã lưu</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Thêm năm học mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="10" name="newScholastic">
                    </div>
                    <br>
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Học
                            kì&ensp;&ensp;&ensp;&ensp;&nbsp;</span>
                        <select class="form-select" aria-label="Default select example" id="availableSemester"
                            name="availableSemester">
                            <option>Chọn học kì đã lưu</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Thêm học kì mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="20" name="newSemester">
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <div class="input-group mb-3 w-50">
                            <input type="number" class="form-control w-25" placeholder="Số tín chỉ" aria-label="Username"
                                aria-describedby="addon-wrapping" name="tc" required>
                            <span class="input-group-text me-3" id="addon-wrapping">TC</span>

                            <input type="number" class="form-control w-25" placeholder="Số lượng sinh viên"
                                aria-label="Recipient's username" aria-describedby="button-addon2" name="studentQuantity"
                                required>
                            <button class="btn btn-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
    <div class="">
        <hr>
        <span class="ms-2 fw-bold fs-6">Môn học vừa được thêm</span>
        <table class="table table-striped table-bordered text-center mt-2" id="subjectDetailTable">
            <thead>
                <tr>
                    {{-- <th>STT</th> --}}
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Số tín chỉ</th>
                    <th>Số lượng sinh viên</th>
                    <th>Ngành học</th>
                    <th>Học kì</th>
                    <th>Năm học</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="subjectDetailTable_body">

            </tbody>
        </table>
    </div>

    {{-- bắt đầu alert confirm --}}

    <div class="confirm-analog">
        <div class="confirm-analog-content">
            <h4>Thông báo</h4>
            <p id="confirmMessage"></p>
            <div class="confirm-analog-buttons">
                <button id="cancelBtn" class="btn btn-primary me-4">Hủy bỏ</button>
                <button id="confirmActionBtn" class="btn btn-danger">Xác nhận</button>
            </div>
        </div>
    </div>

    {{-- kết thúc alert confirm --}}
    <script>
        function getMajorsList() {
            $.ajax({
                type: 'get',
                url: '{{ route('major.list') }}',
                success: function(response) {
                    var availableMajor = document.getElementById('availableMajor');
                    Object.keys(response).forEach(key => {
                        var option = document.createElement("option");
                        option.value = response[key].MaNganh;
                        option.textContent = response[key].TenNganh;

                        availableMajor.appendChild(option)
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getSubjectsList() {
            $.ajax({
                type: 'get',
                url: '{{ route('subject.list') }}',
                success: function(response) {
                    var availableMajor = document.getElementById('availableSubject');
                    Object.keys(response).forEach(key => {
                        var option = document.createElement("option");
                        option.value = response[key].MaMH;
                        option.textContent = response[key].TenMH;

                        availableMajor.appendChild(option)
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getScholasticsList() {
            $.ajax({
                type: 'get',
                url: '{{ route('scholastic.list') }}',
                success: function(response) {
                    var availableMajor = document.getElementById('availableScholastic');
                    Object.keys(response).forEach(key => {
                        var option = document.createElement("option");
                        option.value = response[key].MaNH;
                        option.textContent = response[key].TenNH;

                        availableMajor.appendChild(option)
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getSemestersList() {
            $.ajax({
                type: 'get',
                url: '{{ route('semester.list') }}',
                success: function(response) {
                    var availableMajor = document.getElementById('availableSemester');
                    Object.keys(response).forEach(key => {
                        var option = document.createElement("option");
                        option.value = response[key].MaHK;
                        option.textContent = response[key].TenHK;

                        availableMajor.appendChild(option)
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        getSemestersList();
        getMajorsList();
        getSubjectsList();
        getScholasticsList();

        document.getElementById("addSubjectDetailForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Get the form data
            var formData = new FormData(this);

            // Send the form data using AJAX
            $.ajax({
                url: '/monhoc/xu-ly-them-mon-hoc-bang-form',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response == '1') {
                        var alert = document.getElementById('alert');
                        alert.innerHTML = '';

                        var div = document.createElement("div");
                        div.className = "alert py-2 alert-danger text-center";
                        div.role = "alert";
                        div.textContent =
                            "Vui lòng kiểm tra và cung cấp đầy đủ dữ liệu để thực hiện thao tác !";
                        alert.appendChild(div);
                    } else if (response == '2') {
                        var alert = document.getElementById('alert');
                        alert.innerHTML = '';

                        var div = document.createElement("div");
                        div.className = "alert py-2 alert-danger text-center";
                        div.role = "alert";
                        div.textContent =
                            "Mã môn học bạn vừa nhập đã tồn tại trong cơ sở dữ liệu, vui lòng chọn môn học có sẵn với mã môn tương ứng hoặc nhập mã môn khác !";

                        alert.appendChild(div);
                    } else if (response == '3') {
                        var alert = document.getElementById('alert');
                        alert.innerHTML = '';

                        var div = document.createElement("div");
                        div.className = "alert py-2 alert-danger text-center";
                        div.role = "alert";
                        div.textContent =
                            "Thông tin bạn vừa nhập trùng khớp với thông tin trong cơ sở dữ liệu, vui lòng kiểm tra lại !";

                        alert.appendChild(div);
                    } else {
                        getSemestersList();
                        getMajorsList();
                        getSubjectsList();
                        getScholasticsList();

                        var alert = document.getElementById('alert');
                        alert.innerHTML = '';

                        var div = document.createElement("div");
                        div.className = "alert py-2 alert-success text-center";
                        div.role = "alert";
                        div.textContent = "Thao tác thành công !";

                        alert.appendChild(div);
                        setTimeout(function() {
                            alert.innerHTML = '';
                        }, 5000);

                        addDataToTable(response);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        });


        var stt = 1;
        var subjectDetailTable = document.getElementById("subjectDetailTable_body");

        function addDataToTable(response) {
            // subjectDetailTable.innerHTML = '';
            var tr = document.createElement("tr");

            // var td = document.createElement("td");
            // td.textContent = stt;
            // tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].MaMH;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].TenMH;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].SoTinChi;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].SoLuongSV;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].TenNganh;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].TenHK;
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = response[0].TenNH;
            tr.appendChild(td);

            var td = document.createElement("td");
            var a = document.createElement("a");
            a.href = "";
            a.className = "link-danger text-decoration-none";
            a.textContent = "Xóa";
            td.appendChild(a);
            tr.appendChild(td);

            function showConfirmAnalog(message, callback) {
                var confirmAnalog = document.querySelector(
                    '.confirm-analog');
                confirmAnalog.style.display = 'flex';

                var confirmBtn = document.getElementById(
                    'confirmActionBtn');
                confirmBtn.onclick = function() {
                    callback();
                    confirmAnalog.style.display =
                        'none';
                };

                var cancelBtn = document.getElementById(
                    'cancelBtn');
                cancelBtn.onclick = function() {
                    confirmAnalog.style.display =
                        'none';
                };

                var confirmMessage = document
                    .getElementById('confirmMessage');
                confirmMessage.innerText = message;
            }

            a.addEventListener('click',
                function() {

                    event.preventDefault();
                    showConfirmAnalog(
                        "Bạn có chắc là muốn xóa môn học '" +
                        response[0].TenMH + "' thuộc học kì '" + response[0]
                        .TenHK + "', năm học '" + response[0].TenNH + "' không?",
                        function() {
                            var url = "/chitietmonhoc/xoachitietmonhoc?id=" +
                                response[0].MaMH + "," + response[0].MaHK +
                                "," +
                                response[0].MaNH + "," + response[0].MaNganh +
                                "," +
                                response[0].MaGV;
                            axios.get(url)
                                .then(function(response) {
                                    getSemestersList();
                                    getMajorsList();
                                    getSubjectsList();
                                    getScholasticsList();

                                    var alert = document.getElementById('alert');
                                    alert.innerHTML = '';

                                    var div = document.createElement("div");
                                    div.className = "alert py-2 alert-success text-center";
                                    div.role = "alert";
                                    div.textContent = "Thao tác thành công !";

                                    alert.appendChild(div);
                                    setTimeout(function() {
                                        alert.innerHTML = '';
                                    }, 5000);

                                    tr.remove();
                                })
                        });
                });

            subjectDetailTable.appendChild(tr);
            stt++;
        }
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
