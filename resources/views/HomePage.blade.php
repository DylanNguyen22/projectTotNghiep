@extends('Layout.Layout')

@section('alert')
    <div class="alert py-2 alert-success text-center fade" role="alert" id="successAlert">
        Thao tác thành công
    </div>
@endsection

@section('content')
    <input type="hidden" id="subjectDetailMemory" value="[]">
    <div class="pt-4 px-0 d-flex justify-content-between mb-4">
        <form action="{{ route('subject_detail.list') }}" method="GET" id="subjectDetailFiler_form">
            <div class="d-flex">
                <div class="d-flex justify-content-between me-2">
                    <div class="input-group">
                        <button type="button" id="openScolasticList" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#popup1">
                            Năm học
                        </button>
                        <select class="form-select" id="scholasticFilter" onchange="getSelectedScholasticSemesterList()"
                            name="scholasticId"></select>
                    </div>
                </div>

                <div class="d-flex justify-content-between me-2">
                    <div class="input-group">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popup4">
                            Ngành học
                        </button>
                        <select class="form-select" name="majorId" id="majorFilter" onchange="getSemesterByMajor()">
                            <option value="0" selected>Tất cả</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between me-2">
                    <div class="input-group">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popup2">
                            Học kì
                        </button>
                        <select class="form-select" id="semesterFilter" name="semesterId">
                            <option value="0" selected>Tất cả</option>
                        </select>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-outline-primary">Lọc</button>
                </div>

            </div>
        </form>
    </div>

    <div class="d-flex w-100 mb-2">
        <div class="me-2">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#popup3">
                Thêm môn học
            </button>
        </div>

        {{-- <div class="me-2">
            <button class="btn btn-primary" type="button" id="button-addon1" data-bs-toggle="modal"
                data-bs-target="#popup5">Quản lý môn học</button>
        </div> --}}

        <div class="">
            <div class="input-group">
                <input type="text" id="searchSubjectDetailTable" class="form-control" placeholder=""
                    aria-label="Example text with button addon" aria-describedby="button-addon1">
                <span class="input-group-text bg-primary text-light" id="basic-addon2"><ion-icon
                        name="search"></ion-icon></span>
            </div>
        </div>
    </div>

    <div class="" style="max-height: 388px; overflow: hidden; overflow-y: scroll">
        <form action="{{ route('subjectDetail_lecturer.edit') }}" id="subjectDetailList_container" method="POST">
            {{-- =========== --}}
            <table class="table table-striped table-bordered text-center" id="subjectDetailTable"></table>
            {{-- =========== --}}
    </div>
    <div class="me-3 mt-2">
        <div class="d-flex justify-content-end">
            <button class="btn btn-outline-primary mb-2" type="submit">Xác nhận</button>
        </div>
        </form>
    </div>
    <hr>
    <div class="">
        <div class="p-4 px-0 d-flex justify-content-between mb-4">
            <form id="getStatisticalData_form">
                <div class="d-flex">
                    <div class="d-flex justify-content-between me-2">
                        <div class="input-group">
                            <button class="input-group-text btn btn-primary" id="openScolasticList" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#popup1">
                                Năm học
                            </button>
                            <select class="form-select" id="scholasticStatistical_filter" name="MaNH">

                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between me-2" style="width: 260px">
                        <div class="input-group">
                            <button class="input-group-text btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#popup4">
                                Ngành học
                            </button>
                            <select class="form-select" id="majorStatistical_filter" name="MaNganh">
                                <option value="0" selected>Tất cả</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between me-2">
                        <div class="input-group">
                            <button class="input-group-text btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#popup2">
                                Học kì
                            </button>
                            <select class="form-select" id="semesterStatistical_filter" name="MaHK">
                                <option value="0" selected>Tất cả</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between me-2" style="width: 222px">
                        <div class="input-group">
                            <button class="input-group-text btn btn-primary" id="button-addon1" data-bs-toggle="modal"
                                data-bs-target="#popup5">
                                Môn học
                            </button>
                            <select class="form-select" id="subjectStatistical_filter" name="MaMH">
                                <option value="0" selected>Tất cả</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between me-2">
                        <div class="input-group">
                            <button class="input-group-text btn btn-primary" id="button-addon1" data-bs-toggle="modal"
                                data-bs-target="#popup6">
                                Giảng viên
                            </button>
                            <select class="form-select" id="lecturerStatistical_filter" name="MaGV">
                                <option value="0" selected>Tất cả</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-outline-primary">Lọc</button>
                    </div>

                </div>
                {{-- <input type="text" value="0" id="scholasticId_old" name="scholasticId_old">
                <input type="text" value="0" id="MajorId_old" name="MajorId_old">
                <input type="text" value="0" id="SemesterId_old" name="SemesterId_old">
                <input type="text" value="0" id="SubjectId_old" name="SubjectId_old">
                <input type="text" value="0" id="LecturerId_old" name="LecturerId_old"> --}}
            </form>
        </div>
        <div class="input-group w-25 mb-3">
            <input type="text" id="statisticalSearch" class="form-control"
                placeholder="Vui lòng nhập năm học cần tìm" aria-label="Recipient's username"
                aria-describedby="button-addon2" onkeyup="searchStatistical()">
            <span class="input-group-text bg-primary text-light" id="basic-addon2"><ion-icon
                    name="search"></ion-icon></span>
        </div>
        <div class="" style="max-height: 500px; overflow: hidden; overflow-y: scroll">
            <table class="tg table table-striped table-bordered" id="xport">
                <tr>
                    <th class="text-uppercase" colspan="14" id="statisticalTitle">Thống kê giờ giảng dạy lý thuyết,
                        thực hành năm học
                    <th>
                </tr>
                <tr>
                    <th class="text-uppercase" colspan="14">Khoa công nghệ thông tin</th>
                </tr>
                <tr>
                    <th rowspan="2">Số thứ tự</th>
                    <th rowspan="2">Tên giảng viên</th>
                    <th colspan="5">Giờ lý thuyết</th>
                    <th colspan="5">Giờ thực hành</th>
                    <th rowspan="2">Tổng</th>
                    <th rowspan="2">Tổng cộng</th>
                </tr>
                <tr>
                    <th>Học kỳ</th>
                    <th>Số tiết</th>
                    <th>Số SV</th>
                    <th>Hệ số</th>
                    <th>Quy ra giờ chuẩn</th>
                    <th>Học kì</th>
                    <th>Số tín chỉ</th>
                    <th>Số SV</th>
                    <th>Định mức/1sv</th>
                    <th>Quy ra giờ chuẩn</th>
                </tr>

                <tbody id="statisticalTable_Body"></tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end me-3 mt-2">
            <button class="btn btn-primary" onclick="exportFile()">Xuất file <ion-icon
                    name="download"></ion-icon></button>
        </div>
        <br>
        {{-- <span><------------------------Chổ này dùng cho thống kê------------------------></span> --}}
    </div>
    <div class="modal fade" id="popup1" tabindex="-1" aria-labelledby="popup1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup1Label">Danh sách năm học</h5>
                    <div class="alert py-2 alert-danger text-center fade fixed-top" role="alert"
                        id="scolasticFalseAlert">
                        Năm học đã tồn tại !
                    </div>
                    <div class="alert py-2 alert-success text-center fade fixed-top" role="alert"
                        id="scolasticSuccessAlert">
                        Thao tác thành công !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="scholasticSearch" class="form-control"
                            placeholder="Vui lòng nhập năm học cần tìm" aria-label="Recipient's username"
                            aria-describedby="button-addon2" onkeyup="searchScholastic()">
                        <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
                    </div>

                    <div class="">
                        <form action="" id="addScholasticForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="addScholasticInput" name="scholasticName"
                                    placeholder="Vui lòng nhập năm học cần thêm" aria-label="Recipient's username"
                                    maxlength="10" aria-describedby="button-addon2" required>
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Thêm +</button>
                                @csrf
                            </div>
                        </form>
                    </div>
                    <form action="">
                        <div class="">
                            <table id="scholasticTable" class="table table-striped table-bordered">
                                <tbody id="scholasticTableBody">

                                </tbody>
                                <script></script>
                            </table>
                        </div>
                        <div id="data-container"></div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup2" tabindex="-1" aria-labelledby="popup2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup2Label">Danh sách học kì</h5>
                    <div class="alert py-2 alert-danger text-center fade fixed-top" role="alert"
                        id="semesterFalseAlert">
                        Học kì đã tồn tại !
                    </div>
                    <div class="alert py-2 alert-success text-center fade fixed-top" role="alert"
                        id="semesterSuccessAlert">
                        Thao tác thành công !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="semesterSearch" class="form-control"
                            placeholder="Vui lòng nhập học kì cần tìm" aria-label="Recipient's username"
                            aria-describedby="button-addon2" onkeyup="searchSemester()">
                        <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
                    </div>
                    <form action="" id="addSemesterForm">
                        <div class="input-group mb-3">
                            <input id="addSemesterInput" type="text" class="form-control"
                                placeholder="Vui lòng nhập tên học kì cần thêm" aria-label="Recipient's username"
                                aria-describedby="button-addon2" name="TenHK" required maxlength="20">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Thêm</button>
                        </div>
                        @csrf
                    </form>
                    <div id="semesterControllPannel" class=""></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup3" tabindex="-1" aria-labelledby="popup3Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup3Label">Thêm môn học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-around">
                    <button onclick="window.location.href = '/monhoc/them-mon-hoc-bang-excel-file'"
                        class="btn btn-outline-primary">Thêm bằng file excel</button>
                    <button onclick="window.location.href = '/monhoc/them-mon-hoc-bang-form'"
                        class="btn btn-outline-primary">Thêm bằng form</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup4" tabindex="-1" aria-labelledby="popup4Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup4Label">Danh sách ngành học</h5>
                    <div class="alert py-2 alert-danger text-center fade fixed-top" role="alert" id="majorFalseAlert">
                        Ngành học đã tồn tại !
                    </div>
                    <div class="alert py-2 alert-success text-center fade fixed-top z-index-2" role="alert"
                        id="majorSuccessAlert">
                        Thao tác thành công !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="majorSearch" class="form-control"
                            placeholder="Vui lòng nhập ngành học cần tìm" aria-label="Recipient's username"
                            aria-describedby="button-addon2" onkeyup="searchMajor()">
                        <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
                    </div>
                    <div class="">
                        <form action="{{ route('major.add') }}" id="addMajorForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="addMajorName_input" type="text" class="form-control"
                                    placeholder="Vui lòng nhập nghành học cần thêm" aria-label="Recipient's username"
                                    aria-describedby="button-addon2" name="TenNganh" maxlength="30" required>
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Thêm</button>
                            </div>
                        </form>
                    </div>
                    <div class="">
                        <table class="table table-striped" id="majorListTable_Body">
                            {{-- <tbody ></tbody> --}}
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup5" tabindex="-1" aria-labelledby="popup5Label" aria-hidden="true">
        <div class="modal-dialog" style="margin-right: 45rem;">
            <div class="modal-content subjectPopup">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup5Label">Danh sách môn học</h5>
                    <div class="alert py-2 alert-danger text-center fade fixed-top" role="alert"
                        id="subjectFalseAlert">
                        Mã môn học hoặc tên môn học đã tồn tại !
                    </div>
                    <div class="alert py-2 alert-success text-center fade fixed-top" role="alert"
                        id="subjectSuccessAlert">
                        Thao tác thành công !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="subjectSearch" class="form-control"
                            placeholder="Vui lòng nhập môn học cần tìm" aria-label="Recipient's username"
                            aria-describedby="button-addon2" onkeyup="subjectSearch()">
                        <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
                    </div>
                    <div class="">
                        <form action="" id="addSubject_form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" maxlength="12"
                                    placeholder="Vui lòng nhập mã môn học" name="subjectId" id="subjectId" required>
                                <input type="text" class="form-control w-50" maxlength="100" required
                                    placeholder="Vui lòng nhập tên môn học" name="subjectName" id="subjectName">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Thêm</button>
                            </div>
                            @csrf
                        </form>
                    </div>
                    <table class="table table-striped">
                        <thead id="subjectListTable_head">
                            <tr>
                                <th>Mã môn</th>
                                <th>Tên môn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="subjectListTable_body">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup6" tabindex="-1" aria-labelledby="popup1Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popup1Label">Danh sách năm học</h5>
                    <div class="alert py-2 alert-success text-center fade fixed-top" role="alert"
                        id="lecturersSuccessAlert">
                        Thao tác thành công !
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" id="lecturersSearch" class="form-control"
                            placeholder="Vui lòng nhập tên giảng viên cần tìm" aria-label="Recipient's username"
                            aria-describedby="button-addon2" onkeyup="lecturerSearch()">
                        <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
                    </div>

                    <div class="">
                        <form action="" id="addLecturersForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="addScholasticInput" name="lecturerName"
                                    placeholder="Vui lòng giảng viên cần thêm" aria-label="Recipient's username"
                                    maxlength="35" aria-describedby="button-addon2" required>
                                <input type="text" class="form-control" id="addScholasticInput" name="GC"
                                    placeholder="Vui lòng nhập giờ chuẩn" aria-label="Recipient's username"
                                    maxlength="4" aria-describedby="button-addon2" required>
                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Thêm +</button>
                                @csrf
                            </div>
                        </form>
                    </div>
                    <form action="">
                        <div class="">
                            <table id="lecturersTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên giảng viên</th>
                                    </tr>
                                </thead>
                                <tbody id="lecturersTableBody">

                                </tbody>
                            </table>
                        </div>
                        <div id="data-container"></div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
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
        function loadAllData() {

            checkScholasticData();
            setTimeout(function() {
                checkSubjectDetailData();
            }, 400);
            setTimeout(function() {
                checkSemesterData();
            }, 300);
            setTimeout(function() {
                checkMajorData();
            }, 500);
            setTimeout(function() {
                checkSubjectData();
            }, 700);
        }
        let intervalId;

        function myFunction() {
            if (document.getElementById("scholasticFilter").innerHTML != null) {
                var firstOption = document.querySelector('#scholasticFilter option:first-child').value;
                getSemesterByScholasticList(firstOption);
                doStatistical();
                clearInterval(intervalId); // Ngừng lại khi điều kiện đạt được
            }
        }

        intervalId = setInterval(myFunction, 1000);
        loadAllData();
        // document.getElementById("successAlert").style.display = "none";

        function searchScholastic() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("scholasticSearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("scholasticTableBody");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchSemester() {
            const searchInput = document.getElementById('semesterSearch');
            searchInput.addEventListener('input', filterTable);

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const table = document.getElementById(
                    'semesterTable'); // Replace 'yourTableId' with the actual ID of your table
                const rows = table.getElementsByTagName('tr');

                for (let i = 1; i < rows.length; i++) { // Start from index 1 to skip the table header row
                    const cells = rows[i].getElementsByTagName('td');
                    let found = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellValue = cells[j].textContent.toLowerCase();

                        if (cellValue.includes(searchValue)) {
                            found = true;
                            break;
                        }
                    }

                    rows[i].style.display = found ? '' : 'none';
                }
            }
        }

        function searchMajor() {
            const searchValue = document.getElementById("majorSearch").value.toLowerCase();
            const table = document.getElementById(
                'majorListTable_Body'); // Thay 'majorListTable_Body' bằng ID thực tế của bảng
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toLowerCase();

                    if (cellValue.includes(searchValue)) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }

        function subjectSearch() {
            const searchValue = document.getElementById("subjectSearch").value.toLowerCase();
            const table = document.getElementById(
                'subjectListTable_body'); // Thay 'majorListTable_Body' bằng ID thực tế của bảng
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toLowerCase();

                    if (cellValue.includes(searchValue)) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }

        // Thêm năm học
        $('#addScholasticForm').submit(function(event) {
            event.preventDefault(); // Ngăn chặn form gửi đi một cách thông thường

            var formData = $(this).serialize(); // Lấy dữ liệu từ form

            $.ajax({
                type: 'POST',
                url: '{{ route('scholastic.add') }}',
                data: formData,
                success: function(response) {
                    if (response.message != 'false') {
                        document.getElementById("addScholasticInput").value = "";
                        document
                            .getElementById(
                                "scolasticFalseAlert"
                            ).classList
                            .remove("show")

                        document
                            .getElementById(
                                "scolasticSuccessAlert"
                            )
                            .classList
                            .add(
                                "show"
                            );

                        setTimeout(
                            function() {
                                document
                                    .getElementById(
                                        "scolasticSuccessAlert"
                                    )
                                    .classList
                                    .remove(
                                        "show"
                                    )
                            },
                            5000
                        );

                        checkScholasticData();

                    } else {
                        document
                            .getElementById(
                                "scolasticSuccessAlert"
                            )
                            .classList
                            .remove(
                                "show"
                            )

                        document
                            .getElementById(
                                "scolasticFalseAlert"
                            )
                            .classList
                            .add(
                                "show"
                            );

                        setTimeout(
                            function() {
                                document
                                    .getElementById(
                                        "scolasticFalseAlert"
                                    )
                                    .classList
                                    .remove(
                                        "show"
                                    )
                            },
                            5000
                        );
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
        // Kết thúc thêm năm học
        var currentScholasticData = []; // Lưu trữ dữ liệu hiện tại

        function checkScholasticData() {
            $.ajax({
                url: "{{ route('scholastic.list') }}",
                type: 'GET',
                success: function(response) {
                    document.getElementById("scholasticTableBody").innerHTML = "";
                    $.ajax({
                        url: "{{ route('scholastic.list') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var scholasticTableBody = document.getElementById(
                                "scholasticTableBody");

                            const scholasticFilter = document.getElementById(
                                "scholasticFilter");
                            scholasticFilter.innerHTML = "";

                            // const scholasticFilter_semester = document.getElementById(
                            //     "scholasticFilter_semester");
                            // scholasticFilter_semester.innerHTML = "";

                            Object.keys(data).forEach(key => {

                                var tr = document.createElement("tr");
                                tr.id = data[key].TenNH;

                                var td1 = document.createElement("td");
                                tr.appendChild(td1);

                                var div1 = document.createElement("div");
                                div1.id = "ScholasticName" + data[key].MaNH;
                                td1.appendChild(div1);

                                var text1 = document.createTextNode(
                                    data[key].TenNH);
                                div1.appendChild(text1);

                                var div2 = document.createElement("div");
                                div2.id = "editScholasticNameForm_container" + data[key]
                                    .MaNH;
                                div2.style.display = "none";
                                td1.appendChild(div2);

                                var form = document.createElement("form");
                                form.action = "";
                                form.id = "editScholasticNameForm" + data[key].MaNH;
                                div2.appendChild(form);

                                var inputGroup = document.createElement("div");
                                inputGroup.className = "input-group";
                                form.appendChild(inputGroup);

                                var input = document.createElement("input");
                                input.type = "text";
                                input.name = "scholasticName"
                                input.maxLength = 10;
                                input.className = "form-control";
                                input.setAttribute("aria-label",
                                    "Recipient's username");
                                input.setAttribute("aria-describedby", "button-addon2");
                                input.value = data[key].TenNH;
                                inputGroup.appendChild(input);

                                var input1 = document.createElement("input");
                                input1.type = "hidden";
                                input1.name = "scholasticId"
                                input1.className = "form-control";
                                input1.setAttribute("aria-label",
                                    "Recipient's username");
                                input1.setAttribute("aria-describedby",
                                    "button-addon2");
                                input1.value = data[key].MaNH;
                                inputGroup.appendChild(input1);

                                var csrf_token = document.createElement("input");
                                csrf_token.setAttribute("type", "hidden");
                                csrf_token.setAttribute("name", "_token");
                                csrf_token.setAttribute("value", "{{ csrf_token() }}");
                                inputGroup.appendChild(csrf_token);

                                var button = document.createElement("button");
                                button.className = "btn btn-primary";
                                button.type = "submit";
                                button.id = "button-addon2";
                                button.innerHTML = "Lưu";
                                inputGroup.appendChild(button);

                                var td2 = document.createElement("td");
                                td2.className = "ms-4 w-25";
                                tr.appendChild(td2);

                                var editLink = document.createElement("a");
                                editLink.id = "editSholastic" + data[key].MaNH;
                                editLink.className =
                                    "mx-2 link-primary text-decoration-none";
                                editLink.href = "";
                                editLink.innerHTML = "Sửa";
                                td2.appendChild(editLink);

                                var deleteLink = document.createElement("a");
                                deleteLink.className =
                                    "link-danger text-decoration-none";
                                deleteLink.href = "";
                                deleteLink.innerHTML = "Xóa";
                                td2.appendChild(deleteLink);

                                var table = document.getElementById(
                                    "scholasticTableBody");
                                table.appendChild(tr);


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

                                // Example usage
                                deleteLink.addEventListener('click',
                                    function() {

                                        event.preventDefault();
                                        showConfirmAnalog(
                                            "Bạn có chắc là muốn xóa năm học '" +
                                            data[key].TenNH + "' không?",
                                            function() {
                                                var url =
                                                    "/namhoc/xoanamhoc?id=" +
                                                    data[key].MaNH;
                                                axios.get(url)
                                                    .then(function(
                                                        response) {
                                                        reloadStatisticalData();
                                                        reloadSubjectDetailData
                                                            ();
                                                        document
                                                            .getElementById(
                                                                "scolasticSuccessAlert"
                                                            )
                                                            .classList
                                                            .add(
                                                                "show"
                                                            );

                                                        setTimeout(
                                                            function() {
                                                                document
                                                                    .getElementById(
                                                                        "scolasticSuccessAlert"
                                                                    )
                                                                    .classList
                                                                    .remove(
                                                                        "show"
                                                                    )
                                                            },
                                                            5000
                                                        );
                                                        checkScholasticData
                                                            ();
                                                    })
                                            });
                                    });

                                // // Usage:
                                // showAlert("Bạn có chắc là muốn xóa năm học '" +
                                //     data[key].TenNH + "' không?",
                                //     function(result) {
                                //         if (result) {
                                //             // User confirmed
                                //             console.log("Confirmed");
                                //             
                                //         } else {
                                //             // User cancelled
                                //             console.log("Cancelled");
                                //         }
                                //     });

                                // if (confirm(
                                //         "Bạn có chắc là muốn xóa năm học '" +
                                //         data[key].TenNH + "' không?"
                                //     )) {

                                // }

                                var editScholasticLink = document.getElementById(
                                    "editSholastic" + data[key].MaNH);
                                var editScholasticNameForm = document.getElementById(
                                    "editScholasticNameForm_container" + data[key]
                                    .MaNH);
                                var ScholasticName = document.getElementById(
                                    "ScholasticName" + data[key].MaNH);

                                editScholasticLink.addEventListener("click", function(
                                    event) {
                                    event.preventDefault();

                                    if (editScholasticNameForm.style.display ===
                                        "none") {
                                        editScholasticNameForm.style.display =
                                            "block";
                                        ScholasticName.style.display = "none";
                                    } else {
                                        editScholasticNameForm.style.display =
                                            "none";
                                        ScholasticName.style.display = "block";
                                    }
                                });

                                // Sửa năm học
                                $('#editScholasticNameForm' + data[key].MaNH).submit(
                                    function(event) {
                                        event.preventDefault();

                                        var formData1 = $(this).serialize();

                                        $.ajax({
                                            type: 'POST',
                                            url: '{{ route('scholastic.edit') }}',
                                            data: formData1,
                                            success: function(response) {
                                                if (response.message !=
                                                    'false') {

                                                    document
                                                        .getElementById(
                                                            "scolasticFalseAlert"
                                                        ).classList
                                                        .remove("show")

                                                    document
                                                        .getElementById(
                                                            "scolasticSuccessAlert"
                                                        )
                                                        .classList
                                                        .add(
                                                            "show"
                                                        );

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "scolasticSuccessAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show"
                                                                )
                                                        },
                                                        5000
                                                    );
                                                    checkScholasticData
                                                        ();
                                                } else {
                                                    document
                                                        .getElementById(
                                                            "scolasticSuccessAlert"
                                                        )
                                                        .classList
                                                        .remove(
                                                            "show"
                                                        )

                                                    document
                                                        .getElementById(
                                                            "scolasticFalseAlert"
                                                        )
                                                        .classList
                                                        .add(
                                                            "show"
                                                        );

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "scolasticFalseAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show"
                                                                )
                                                        },
                                                        5000
                                                    );
                                                }
                                            },
                                            error: function(xhr) {
                                                console.log(xhr
                                                    .responseText);
                                            }
                                        });
                                    });
                                // Kết thúc sửa năm học

                                const scholasticFilter = document.getElementById(
                                    "scholasticFilter");
                                const scholasticFilterOption = document.createElement(
                                    "option");
                                scholasticFilterOption.value = data[key].MaNH;
                                // if (key == "0") {
                                //     .selected = true;
                                // }scholasticFilterOption
                                scholasticFilterOption.textContent = data[key].TenNH;
                                scholasticFilter.appendChild(scholasticFilterOption);

                                const scholasticFilter_semester = document
                                    .getElementById(
                                        "scholasticFilter_semester");
                                const scholasticFilter_semesterOption = document
                                    .createElement(
                                        "option");
                                scholasticFilter_semesterOption.value = data[key].MaNH;
                            });;
                        }
                    });
                }
            });
        }

        var currentSemesterData = [];

        function checkSemesterData() {
            $.ajax({
                url: "{{ route('semester.list') }}",
                type: 'GET',
                success: function(response) {
                    // So sánh dữ liệu trả về với dữ liệu hiện tại

                    document.getElementById("semesterControllPannel").innerHTML = "";
                    var container = document.getElementById("semesterControllPannel");

                    $.ajax({
                        url: "{{ route('semester.list') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            // Create the parent div element
                            var div = document.createElement("div");
                            div.className = "";

                            // Create the table element
                            var table = document.createElement("table");
                            table.className = "table table-striped";
                            table.id = "semesterTable";

                            // Create the table head (thead) element
                            var thead = document.createElement("thead");

                            // Create the table row (tr) element for the table head
                            var tr = document.createElement("tr");

                            // Create the table header (th) element
                            var th = document.createElement("th");
                            th.textContent = "Danh sách học kì";

                            // Append the table header to the table row
                            tr.appendChild(th);

                            // Append the table row to the table head
                            thead.appendChild(tr);

                            // Create the table body (tbody) element
                            var tbody = document.createElement("tbody");

                            // Create three table rows (tr) with their respective table data (td) elements
                            Object.keys(data).forEach(key => {
                                // Create the table row (tr) element
                                var tr2 = document.createElement("tr");

                                // Create the table data (td) element
                                var td = document.createElement("td");
                                td.className = "d-flex justify-content-between";

                                // Create the div element with class "ms-2"
                                var div1 = document.createElement("div");
                                div1.className = "ms-2";

                                // Create the span element
                                var span = document.createElement("span");
                                span.textContent = data[key].TenHK;

                                // Create the div element with inline style "display: none"
                                var div2 = document.createElement("div");
                                // div2.style.display = "none";
                                div2.className = "";
                                div2.style.display = "none";

                                // Create the form element
                                var form = document.createElement("form");
                                form.action = "";
                                form.id = "editSemesterNameForm" + data[key].MaHK;
                                // form.style = "display: none";

                                // Create the CSRF token input field
                                var csrfInput = document.createElement('input');
                                csrfInput.setAttribute('type', 'hidden');
                                csrfInput.setAttribute('name', '_token');
                                csrfInput.setAttribute('value',
                                    '{{ csrf_token() }}');

                                // Create the input group div element
                                var inputGroupDiv = document.createElement("div");
                                inputGroupDiv.className = "input-group mb-3";

                                // Create the input field
                                var inputField = document.createElement("input");
                                inputField.type = "text";
                                inputField.className = "form-control";
                                inputField.value = data[key].TenHK;
                                inputField.maxLength = 20;
                                inputField.setAttribute("aria-label",
                                    "Recipient's username");
                                inputField.setAttribute("aria-describedby",
                                    "button-addon2");
                                inputField.name = "TenHK";


                                var inputID = document.createElement("input");
                                inputID.type = "hidden";
                                inputID.name = "MaHK";
                                inputID.value = data[key].MaHK;

                                // Create the "Lưu" button
                                var saveButton = document.createElement("button");
                                saveButton.className = "btn btn-primary";
                                saveButton.type = "submit";
                                saveButton.id = "button-addon2";
                                saveButton.textContent = "Lưu";

                                // Append the CSRF token input field to the form
                                form.appendChild(csrfInput);

                                // Append the input field to the input group div
                                inputGroupDiv.appendChild(inputField);

                                // Append the "Lưu" button to the button div
                                inputGroupDiv.appendChild(saveButton);


                                // Append the input group div to the form
                                form.appendChild(inputGroupDiv);

                                form.appendChild(inputID);

                                // Append the form to the second div
                                div2.appendChild(form);

                                // Append the span and second div to the first div
                                div1.appendChild(span);
                                div1.appendChild(div2);

                                // Create the div element with class "me-2"
                                var div3 = document.createElement("div");
                                div3.className = "me-2";

                                // Create the "Sửa" button
                                var editButton = document.createElement("a");
                                editButton.className =
                                    "me-1 btn btn-sm btn-primary";
                                editButton.href = "";
                                editButton.textContent = "Sửa";
                                editButton.id = "editSemester" + data[key].MaHK;

                                // Create the "Xóa" button
                                var deleteButton = document.createElement("a");
                                deleteButton.className = "btn btn-sm btn-danger";
                                deleteButton.href = "";
                                deleteButton.id = "deleteSemester" + data[key].MaHK;
                                deleteButton.textContent = "Xóa";

                                // Append the buttons to the third div
                                div3.appendChild(editButton);
                                div3.appendChild(deleteButton);

                                // Append the divs to the table data
                                td.appendChild(div1);
                                td.appendChild(div3);

                                // Append the table data to the table row
                                tr2.appendChild(td);

                                // Append the table row to the table body
                                tbody.appendChild(tr2);

                                editButton.addEventListener("click", function(
                                    event) {
                                    event.preventDefault();

                                    // Kiểm tra trạng thái hiển thị của div
                                    if (div2.style.display === "none") {
                                        // Hiển thị div và ẩn span
                                        div2.style.display = "block";
                                        span.style.display = "none";

                                        $(document).ready(function() {
                                            $('#editSemesterNameForm' +
                                                    data[key].MaHK)
                                                .submit(function(
                                                    event) {
                                                    event
                                                        .preventDefault(); // Prevent the default form submission behavior

                                                    // Get the form data
                                                    var formData =
                                                        $(this)
                                                        .serialize();


                                                    // Submit the form data using AJAX
                                                    $.ajax({
                                                        url: '{{ route('semester.edit') }}',
                                                        type: 'POST',
                                                        data: formData,
                                                        success: function(
                                                            response
                                                        ) {
                                                            if (response ==
                                                                'success'
                                                            ) {

                                                                document
                                                                    .getElementById(
                                                                        "addSemesterInput"
                                                                    )
                                                                    .value =
                                                                    "";
                                                                document
                                                                    .getElementById(
                                                                        "semesterFalseAlert"
                                                                    )
                                                                    .classList
                                                                    .remove(
                                                                        "show"
                                                                    )

                                                                document
                                                                    .getElementById(
                                                                        "semesterSuccessAlert"
                                                                    )
                                                                    .classList
                                                                    .add(
                                                                        "show"
                                                                    );

                                                                setTimeout
                                                                    (
                                                                        function() {
                                                                            document
                                                                                .getElementById(
                                                                                    "semesterSuccessAlert"
                                                                                )
                                                                                .classList
                                                                                .remove(
                                                                                    "show"
                                                                                )
                                                                        },
                                                                        5000
                                                                    );
                                                                checkSemesterData
                                                                    ();
                                                            } else {
                                                                document
                                                                    .getElementById(
                                                                        "semesterSuccessAlert"
                                                                    )
                                                                    .classList
                                                                    .remove(
                                                                        "show"
                                                                    )

                                                                document
                                                                    .getElementById(
                                                                        "semesterFalseAlert"
                                                                    )
                                                                    .classList
                                                                    .add(
                                                                        "show"
                                                                    );

                                                                setTimeout
                                                                    (
                                                                        function() {
                                                                            document
                                                                                .getElementById(
                                                                                    "semesterFalseAlert"
                                                                                )
                                                                                .classList
                                                                                .remove(
                                                                                    "show"
                                                                                )
                                                                        },
                                                                        5000
                                                                    );
                                                            }
                                                        },
                                                        error: function(
                                                            xhr
                                                        ) {
                                                            console
                                                                .error(
                                                                    xhr
                                                                    .responseText
                                                                ); // Log any errors
                                                        }
                                                    });
                                                });
                                        });
                                    } else {
                                        // Hiển thị span và ẩn div
                                        div2.style.display = "none";
                                        span.style.display = "block";
                                    }
                                });
                            });

                            // Append the table head and table body to the table
                            table.appendChild(thead);
                            table.appendChild(tbody);

                            // Append the table to the parent div
                            div.appendChild(table);

                            container.appendChild(div);

                        }
                    });

                    $.ajax({
                        url: "{{ route('semester.list') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            Object.keys(data).forEach(key => {

                                if (document.getElementById("deleteSemester" + data[key]
                                        .MaHK)) {

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

                                    // Example usage
                                    document.getElementById("deleteSemester" + data[key]
                                        .MaHK).addEventListener('click',
                                        function() {

                                            event.preventDefault();
                                            showConfirmAnalog(
                                                "Bạn có chắc là muốn xóa '" +
                                                data[key].TenHK + "' không?",
                                                function() {
                                                    var url =
                                                        "/hocki/xoahocki?id=" +
                                                        data[key].MaHK;
                                                    axios.get(url)
                                                        .then(function(response) {
                                                            reloadStatisticalData
                                                                ();
                                                            reloadSubjectDetailData
                                                                ();
                                                            document
                                                                .getElementById(
                                                                    "addSemesterInput"
                                                                ).value = "";
                                                            document
                                                                .getElementById(
                                                                    "semesterFalseAlert"
                                                                ).classList
                                                                .remove("show")

                                                            document
                                                                .getElementById(
                                                                    "semesterSuccessAlert"
                                                                )
                                                                .classList
                                                                .add(
                                                                    "show"
                                                                );

                                                            setTimeout(
                                                                function() {
                                                                    document
                                                                        .getElementById(
                                                                            "semesterSuccessAlert"
                                                                        )
                                                                        .classList
                                                                        .remove(
                                                                            "show"
                                                                        )
                                                                },
                                                                5000
                                                            );
                                                            checkSemesterData();
                                                        })

                                                });
                                        });
                                }
                            });
                        }
                    });
                }
            });
        }

        document.getElementById("addSemesterForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            // Get the form data
            var formData = new FormData(this);

            // Send the form data using AJAX
            $.ajax({
                url: '/hocki/themhocki',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response ==
                        'success') {

                        document.getElementById("addSemesterInput").value = "";
                        document
                            .getElementById(
                                "semesterFalseAlert"
                            ).classList
                            .remove("show")

                        document
                            .getElementById(
                                "semesterSuccessAlert"
                            )
                            .classList
                            .add(
                                "show"
                            );

                        setTimeout(
                            function() {
                                document
                                    .getElementById(
                                        "semesterSuccessAlert"
                                    )
                                    .classList
                                    .remove(
                                        "show"
                                    )
                            },
                            5000
                        );
                        checkSemesterData();
                    } else {
                        document
                            .getElementById(
                                "semesterSuccessAlert"
                            )
                            .classList
                            .remove(
                                "show"
                            )

                        document
                            .getElementById(
                                "semesterFalseAlert"
                            )
                            .classList
                            .add(
                                "show"
                            );

                        setTimeout(
                            function() {
                                document
                                    .getElementById(
                                        "semesterFalseAlert"
                                    )
                                    .classList
                                    .remove(
                                        "show"
                                    )
                            },
                            5000
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Log any errors
                }
            });
        });

        $(document).ready(function() {
            $('#addMajorForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize(); // Serialize form data

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        // Handle successful form submission
                        if (response ==
                            'success') {
                            document
                                .getElementById(
                                    "addMajorName_input"
                                )
                                .value =
                                "";

                            document
                                .getElementById(
                                    "majorFalseAlert"
                                )
                                .classList
                                .remove(
                                    "show"
                                )

                            document
                                .getElementById(
                                    "majorSuccessAlert"
                                )
                                .classList
                                .add(
                                    "show"
                                );

                            setTimeout(
                                function() {
                                    document
                                        .getElementById(
                                            "majorSuccessAlert"
                                        )
                                        .classList
                                        .remove(
                                            "show"
                                        )
                                },
                                5000
                            );
                            checkMajorData();

                        } else {
                            document
                                .getElementById(
                                    "majorSuccessAlert"
                                )
                                .classList
                                .remove(
                                    "show"
                                )

                            document
                                .getElementById(
                                    "majorFalseAlert"
                                )
                                .classList
                                .add(
                                    "show"
                                );

                            setTimeout(
                                function() {
                                    document
                                        .getElementById(
                                            "majorFalseAlert"
                                        )
                                        .classList
                                        .remove(
                                            "show"
                                        )
                                },
                                5000
                            );
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                    }
                });
            });
        });

        var currentMajorData = [];

        function checkMajorData() {
            // var modalBody = document.getElementById("semesterControllPannel");

            $.ajax({
                url: "{{ route('major.list') }}",
                type: 'GET',
                success: function(response) {

                    document.getElementById("majorListTable_Body").innerHTML = "";

                    Object.keys(response).forEach(key => {
                        // Create the <tr> element
                        var tr = document.createElement("tr");

                        // Create the <td> element
                        var td = document.createElement("td");
                        td.className = "d-flex justify-content-between";

                        // Create the first <div> element inside the <td>
                        var div1 = document.createElement("div");

                        // Create the <span> element inside the first <div>
                        var span = document.createElement("span");
                        span.id = "majorName";
                        span.className = "ms-2";
                        span.textContent = response[key].TenNganh;

                        // Create the second <div> element inside the first <div>
                        var div2 = document.createElement("div");
                        div2.id = "majorEditForm";
                        div2.style.display = "none";

                        // Create the <form> element inside the second <div>
                        var form = document.createElement("form");
                        form.action = "{{ route('major.edit') }}";
                        form.id = "editMajorName_Form" + response[key].MaNganh;

                        // Create the <div> element inside the <form>
                        var div3 = document.createElement("div");
                        div3.className = "input-group mb-3";

                        // Create the <input> element inside the <div>
                        var input = document.createElement("input");
                        input.type = "text";
                        input.className = "form-control";
                        input.name = "TenNganh";
                        input.maxLength = 30;
                        input.value = response[key].TenNganh;
                        input.setAttribute("aria-label", "Recipient's username");
                        input.setAttribute("aria-describedby", "button-addon2");

                        var input2 = document.createElement("input");
                        input2.type = "hidden";
                        input2.className = "form-control";
                        input2.name = "MaNganh";
                        input2.value = response[key].MaNganh;
                        input2.setAttribute("aria-label", "Recipient's username");
                        input2.setAttribute("aria-describedby", "button-addon2");

                        // Create the <button> element inside the <div>
                        var button = document.createElement("button");
                        button.className = "btn btn-outline-primary";
                        button.type = "submit";
                        button.id = "button-addon2";
                        button.textContent = "Lưu";

                        // Create the CSRF token input field
                        var csrfInput = document.createElement('input');
                        csrfInput.setAttribute('type', 'hidden');
                        csrfInput.setAttribute('name', '_token');
                        csrfInput.setAttribute('value', '{{ csrf_token() }}');

                        // Append the <input> element to the <div>
                        div3.appendChild(input);

                        // Append the <button> element to the <div>
                        div3.appendChild(button);

                        // Append the <div> element to the <form>
                        form.appendChild(div3);
                        form.appendChild(input2);
                        form.appendChild(csrfInput);

                        // Append the <form> element to the second <div>
                        div2.appendChild(form);

                        // Append the <span> element to the first <div>
                        div1.appendChild(span);

                        // Append the second <div> element to the first <div>
                        div1.appendChild(div2);

                        // Append the first <div> element to the <td>
                        td.appendChild(div1);

                        // Create the second <div> element inside the <td>
                        var div4 = document.createElement("div");
                        div4.className = "me-2";

                        // Create the first <a> element inside the second <div>
                        var a1 = document.createElement("a");
                        a1.href = "#";
                        a1.className = "btn btn-sm btn-primary me-2";
                        a1.id = "editMajorBtn" + response[key].MaNganh;
                        a1.textContent = "Sửa";

                        // Create the second <a> element inside the second <div>
                        var a2 = document.createElement("a");
                        a2.href = "";
                        a2.id = "deleteMajor" + response[key].MaNganh;
                        a2.className = "btn btn-sm btn-danger";
                        a2.textContent = "Xóa";

                        // Append the first <a> element to the second <div>
                        div4.appendChild(a1);

                        // Append the second <a> element to the second <div>
                        div4.appendChild(a2);

                        // Append the <div> element to the <td>
                        td.appendChild(div4);

                        // Append the <td> element to the <tr>
                        tr.appendChild(td);

                        // Append the first <tr> and the second <tr> to a parent element (e.g., <table>)
                        var majorListTable_Body = document.getElementById("majorListTable_Body");
                        majorListTable_Body.appendChild(tr);

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

                        // Example usage
                        a2.addEventListener('click',
                            function() {

                                event.preventDefault();
                                showConfirmAnalog(
                                    "Bạn có chắc là muốn xóa ngành '" +
                                    response[key].TenNganh + "' không?",
                                    function() {
                                        var url = "/nganhhoc/xoanganhhoc?id=" +
                                            response[key].MaNganh;
                                        axios.get(url)
                                            .then(function(response) {
                                                reloadStatisticalData();
                                                reloadSubjectDetailData();
                                                document.getElementById("majorSuccessAlert")
                                                    .classList.add("show");

                                                setTimeout(
                                                    function() {
                                                        document.getElementById(
                                                                "majorSuccessAlert")
                                                            .classList.remove("show")
                                                    }, 5000);
                                                checkMajorData();
                                            })
                                    });
                            });

                        // document.getElementById("deleteMajor" + response[key]
                        //     .MaNganh).addEventListener("click", function(
                        //     event) {
                        //     event.preventDefault();
                        //     if (confirm(
                        //             "Bạn có chắc là muốn xóa?"
                        //         )) {

                        //         .catch(function(error) {
                        //             console.log(error);
                        //         });
                        //     }
                        // });

                        // Get the "Sửa" link element
                        var editMajorBtn = document.getElementById("editMajorBtn" + response[key]
                            .MaNganh);

                        // Add click event listener to the "Sửa" link
                        editMajorBtn.addEventListener('click', function(event) {
                            event
                                .preventDefault(); // Prevent default link behavior (page reload)

                            if (div2.style.display === "none") {
                                // Hiển thị div và ẩn span
                                div2.style.display = "block";
                                span.style.display = "none";

                                $(document).ready(function() {
                                    $('#editMajorName_Form' + response[key].MaNganh)
                                        .submit(function(event) {
                                            event
                                                .preventDefault(); // Prevent default form submission

                                            var form = $(this);
                                            var url = form.attr('action');
                                            var data = form
                                                .serialize(); // Serialize form data

                                            $.ajax({
                                                url: url,
                                                type: 'POST',
                                                data: data,
                                                success: function(
                                                    response) {
                                                    // Handle successful form submission
                                                    if (response ==
                                                        'success') {
                                                        document
                                                            .getElementById(
                                                                "addMajorName_input"
                                                            )
                                                            .value =
                                                            "";

                                                        document
                                                            .getElementById(
                                                                "majorFalseAlert"
                                                            )
                                                            .classList
                                                            .remove(
                                                                "show"
                                                            )

                                                        document
                                                            .getElementById(
                                                                "majorSuccessAlert"
                                                            )
                                                            .classList
                                                            .add(
                                                                "show"
                                                            );

                                                        setTimeout(
                                                            function() {
                                                                document
                                                                    .getElementById(
                                                                        "majorSuccessAlert"
                                                                    )
                                                                    .classList
                                                                    .remove(
                                                                        "show"
                                                                    )
                                                            },
                                                            5000
                                                        );
                                                        checkMajorData
                                                            ();
                                                    } else {
                                                        document
                                                            .getElementById(
                                                                "majorSuccessAlert"
                                                            )
                                                            .classList
                                                            .remove(
                                                                "show"
                                                            )

                                                        document
                                                            .getElementById(
                                                                "majorFalseAlert"
                                                            )
                                                            .classList
                                                            .add(
                                                                "show"
                                                            );

                                                        setTimeout(
                                                            function() {
                                                                document
                                                                    .getElementById(
                                                                        "majorFalseAlert"
                                                                    )
                                                                    .classList
                                                                    .remove(
                                                                        "show"
                                                                    )
                                                            },
                                                            5000
                                                        );
                                                    }
                                                },
                                                error: function(xhr,
                                                    status, error) {
                                                    // Handle error
                                                }
                                            });
                                        });
                                });

                            } else {
                                div2.style.display = "none";
                                span.style.display = "block";
                            }
                        });
                    });
                }
            });
        }

        var currentSubjectDetailData = [];
        // 0000000000000000000000000000
        // 0000000000000000000000000000
        // 0000000000000000000000000000
        // 0000000000000000000000000000
        function checklecturersData() {
            $.ajax({
                url: "{{ route('lecturers.list') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    var table = document.getElementById("lecturersTableBody");
                    table.innerHTML = "";
                    Object.keys(result).forEach(key => {
                        if (result[key].MaGV != 1) {
                            var tr = document.createElement("tr");
                            var td = document.createElement("td");
                            td.classList = "d-flex justify-content-between"

                            var span = document.createElement("span");
                            span.textContent = result[key].TenGV;

                            var deleteLink = document.createElement("a");
                            deleteLink.href = "";
                            deleteLink.textContent = "Xoá";
                            deleteLink.classList = "btn btn-sm ms-2 btn-danger";

                            var editLink = document.createElement("a");
                            editLink.href = "";
                            editLink.textContent = "Sửa";
                            editLink.classList = "btn btn-sm btn-primary";

                            var form = document.createElement("form");
                            form.id = "editLecturersName_Form" + result[key].MaGV;
                            // form.action = "{{ route('lecturers.edit') }}";
                            // form.method = "POST";
                            var div1 = document.createElement("div");
                            div1.className = "input-group mb-3";

                            // Create the <input> element inside the <div>
                            var input = document.createElement("input");
                            input.type = "text";
                            input.className = "form-control";
                            input.name = "TenGV";
                            input.maxLength = 30;
                            input.value = result[key].TenGV;
                            input.setAttribute("aria-label", "Recipient's username");
                            input.setAttribute("aria-describedby", "button-addon2");

                            var input1 = document.createElement("input");
                            input1.type = "text";
                            input1.className = "form-control";
                            input1.name = "GioChuan";
                            input1.maxLength = 30;
                            input1.value = result[key].GioChuan;
                            input1.setAttribute("aria-label", "Recipient's username");
                            input1.setAttribute("aria-describedby", "button-addon2");

                            var input2 = document.createElement("input");
                            input2.type = "hidden";
                            input2.className = "form-control";
                            input2.name = "MaGV";
                            input2.value = result[key].MaGV;
                            input2.setAttribute("aria-label", "Recipient's username");
                            input2.setAttribute("aria-describedby", "button-addon2");

                            // Create the <button> element inside the <div>
                            var button = document.createElement("button");
                            button.className = "btn btn-outline-primary";
                            button.type = "submit";
                            button.id = "button-addon2";
                            button.textContent = "Lưu";

                            // Create the CSRF token input field
                            var csrfInput = document.createElement('input');
                            csrfInput.setAttribute('type', 'hidden');
                            csrfInput.setAttribute('name', '_token');
                            csrfInput.setAttribute('value', '{{ csrf_token() }}');

                            // Append the <input> element to the <div>
                            div1.appendChild(input);
                            div1.appendChild(input1);

                            // Append the <button> element to the <div>
                            div1.appendChild(button);

                            // Append the <div> element to the <form>
                            form.appendChild(div1);
                            form.appendChild(input2);
                            form.appendChild(csrfInput);

                            var div2 = document.createElement("div");
                            div2.style.display = "none";
                            div2.appendChild(form);


                            var div3 = document.createElement('div');
                            div3.appendChild(editLink);
                            div3.appendChild(deleteLink);
                            td.appendChild(span);
                            td.appendChild(div2)
                            td.appendChild(div3);
                            tr.appendChild(td);
                            table.appendChild(tr);

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

                            // Example usage
                            deleteLink.addEventListener('click', function(event) {
                                event.preventDefault();
                                showConfirmAnalog(
                                    "Bạn có chắc là muốn xóa '" +
                                    result[key].TenGV + "' không?",
                                    function() {
                                        var formData = $(this).serialize();
                                        $.ajax({
                                            url: "/giangvien/xoagiangvien?id=" +
                                                result[key]
                                                .MaGV,
                                            type: 'GET',
                                            data: formData,
                                            dataType: "json",
                                            success: function(response) {
                                                console.log(response);
                                                document.getElementById(
                                                    "lecturersSuccessAlert"
                                                ).classList.add(
                                                    "show");

                                                setTimeout(
                                                    function() {
                                                        document
                                                            .getElementById(
                                                                "lecturersSuccessAlert"
                                                            )
                                                            .classList
                                                            .remove(
                                                                "show")
                                                    }, 5000);
                                                checklecturersData();
                                            }
                                        });
                                    });
                            });

                            editLink.addEventListener('click', function(event) {
                                event.preventDefault();

                                if (div2.style.display === "none") {
                                    // Hiển thị div và ẩn span
                                    div2.style.display = "block";
                                    span.style.display = "none";

                                    $("#editLecturersName_Form" + result[key].MaGV).on('submit',
                                        function(e) {
                                            e.preventDefault();
                                            div2.style.display = "none";
                                            span.style.display = "block";
                                            var formData = $(this).serialize();
                                            $.ajax({
                                                url: "{{ route('lecturers.edit') }}",
                                                type: 'POST',
                                                data: formData,
                                                dataType: "json",
                                                success: function(response) {
                                                    document.getElementById(
                                                        "lecturersSuccessAlert"
                                                    ).classList.add(
                                                        "show");

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "lecturersSuccessAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show")
                                                        }, 5000);
                                                    checklecturersData();
                                                }
                                            });
                                        });


                                } else {
                                    div2.style.display = "none";
                                    span.style.display = "block";
                                }
                            })
                        }
                    });
                }
            })
        }

        checklecturersData();

        $("#addLecturersForm").on('submit',
            function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('lecturers.add') }}",
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    success: function(response) {

                        console.log(response);

                        document.getElementById(
                            "lecturersSuccessAlert"
                        ).classList.add(
                            "show");

                        setTimeout(
                            function() {
                                document
                                    .getElementById(
                                        "lecturersSuccessAlert"
                                    )
                                    .classList
                                    .remove(
                                        "show")
                            }, 5000);
                        checklecturersData();
                    }
                });
            });

        function checkSubjectDetailData() {
            // var modalBody = document.getElementById("semesterControllPannel");

            $.ajax({
                url: "{{ route('subject_detail.list') }}",
                type: 'GET',
                success: function(response) {
                    var formData = document.getElementById("subjectDetailMemory").value;
                    loadData(formData);
                }
            });
        }

        function lecturerSearch() {
            const searchValue = document.getElementById("lecturersSearch").value.toLowerCase();
            const table = document.getElementById(
                'lecturersTableBody'); // Thay 'majorListTable_Body' bằng ID thực tế của bảng
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cellValue = cells[j].textContent.toLowerCase();

                    if (cellValue.includes(searchValue)) {
                        found = true;
                        break;
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }

        function loadData(filter) {
            // Get the form data'
            // var formData = $('#selectScholasticInSemesterList_Form').serialize();

            if (document.getElementById("subjectDetailQuantity")) {
                document.getElementById("subjectDetailQuantity").remove();
            }
            $.ajax({
                url: "{{ route('subject_detail.list') }}",
                type: "GET",
                dataType: "json",
                data: filter,
                success: function(result) {
                    var number = 0;
                    if (document.getElementById("subjectDetailFilterData")) {
                        document.getElementById("subjectDetailFilterData").remove();
                    }

                    var subjectDetailList_container = document.getElementById("subjectDetailList_container");
                    var div = document.createElement("div");
                    div.id = "subjectDetailFilterData";

                    var csrf_token = document.createElement("input");
                    csrf_token.setAttribute("type", "hidden");
                    csrf_token.setAttribute("name", "_token");
                    csrf_token.setAttribute("value", "{{ csrf_token() }}");

                    div.appendChild(csrf_token);

                    subjectDetailList_container.appendChild(div);

                    var stt = 1;
                    var table = document.getElementById("subjectDetailTable");
                    table.innerHTML = "";
                    var thead = document.createElement("thead");
                    thead.className = "table bg-primary text-light";

                    var tbody = document.createElement("tbody");
                    tbody.id = "subjectDetailTable_body";

                    var tr = document.createElement("tr");

                    var th1 = document.createElement("th");
                    th1.textContent = "STT";

                    var th2 = document.createElement("th");
                    th2.textContent = "Mã môn";

                    var th3 = document.createElement("th");
                    th3.textContent = "Tên môn";

                    var th4 = document.createElement("th");
                    th4.textContent = "Số tiết";

                    var th8 = document.createElement("th");
                    th8.textContent = "Số chỉ TH";

                    var th5 = document.createElement("th");
                    th5.textContent = "Số lượng sinh viên";

                    var th6 = document.createElement("th");
                    th6.textContent = "Giảng viên phụ trách";

                    var th7 = document.createElement("th");

                    tr.appendChild(th1);
                    tr.appendChild(th2);
                    tr.appendChild(th3);
                    tr.appendChild(th4);
                    tr.appendChild(th8);
                    tr.appendChild(th5);
                    tr.appendChild(th6);
                    tr.appendChild(th7);

                    thead.appendChild(tr);
                    table.appendChild(thead);

                    var response = result[0];
                    Object.keys(response).forEach(key => {
                        var tr = document.createElement("tr");
                        var td1 = document.createElement("td");
                        td1.textContent = stt++;
                        tr.appendChild(td1);

                        var td2 = document.createElement("td");
                        td2.textContent = response[key].MaMH;
                        tr.appendChild(td2);

                        var td3 = document.createElement("td");
                        td3.textContent = response[key].TenMH;
                        tr.appendChild(td3);

                        var td4 = document.createElement("td");
                        td4.textContent = response[key].SoTiet;

                        var span = document.createElement("span");
                        span.textContent = response[key].TenGV;
                        span.className = "visually-hidden";
                        td4.appendChild(span);

                        tr.appendChild(td4);

                        var td8 = document.createElement("td");
                        td8.textContent = response[key].SoChiTH;
                        tr.appendChild(td8);

                        var td5 = document.createElement("td");
                        td5.textContent = response[key].SoLuongSV;
                        tr.appendChild(td5);
                        // Object.keys(data).forEach(key => {
                        //     var td = document.createElement("td");
                        //     td.textContent = data[key];
                        //     tr.appendChild(td);
                        // });
                        var td = document.createElement("td");

                        var div = document.createElement("div");

                        var select = document.createElement("select");
                        select.className = "form-select";
                        select.name = "subjectDetail" + Number(number++);
                        select.innerHTML = "";

                        var lecturers = result[1];
                        Object.keys(lecturers).forEach(keys => {
                            var option = document.createElement(
                                "option");
                            option.value = lecturers[keys].MaGV +
                                "," + response[key].MaMH + "," + response[key].MaHK + "," +
                                response[key].MaNH + "," + response[key].MaNganh;
                            option.textContent = lecturers[keys].TenGV;
                            if (lecturers[keys].MaGV ==
                                response[key]
                                .MaGV) {
                                option.setAttribute("selected",
                                    "");
                            }
                            select.appendChild(option);
                            // console.log(lecturers[keys]);
                        });


                        div.appendChild(select);
                        td.appendChild(div);
                        tr.appendChild(td);

                        var td = document.createElement("td");

                        // var a1 = document.createElement("a");
                        // a1.href = "";
                        // a1.className = "link-primary text-decoration-none me-2";
                        // a1.textContent = "Sửa";

                        var a = document.createElement("a");
                        a.href = "";
                        a.className = "link-danger text-decoration-none";
                        a.textContent = "Xóa";

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

                        // Example usage
                        a.addEventListener('click',
                            function() {

                                event.preventDefault();
                                showConfirmAnalog(
                                    "Bạn có chắc là muốn xóa môn học '" +
                                    response[key].TenMH + "' thuộc học kì '" + response[key]
                                    .TenHK + "', năm học '" + response[key].TenNH + "' không?",
                                    function() {
                                        var url = "/chitietmonhoc/xoachitietmonhoc?id=" +
                                            response[key].MaMH + "," + response[key].MaHK +
                                            "," +
                                            response[key].MaNH + "," + response[key].MaNganh +
                                            "," +
                                            response[key].MaGV;
                                        axios.get(url)
                                            .then(function(response) {
                                                reloadStatisticalData();
                                                reloadSubjectDetailData();
                                                // alert("Thao tác thành công !");

                                                document.getElementById("successAlert")
                                                    .classList
                                                    .add("show");

                                                setTimeout(function() {
                                                    document.getElementById(
                                                            "successAlert")
                                                        .classList.remove("show")
                                                }, 5000);

                                                checkSubjectDetailData();
                                            })
                                    });
                            });

                        td.appendChild(a);
                        tr.appendChild(td);

                        tbody.appendChild(tr);
                    });
                    table.appendChild(tbody);

                    var input = document.createElement("input");
                    input.name = "subjectDetailQuantity";
                    input.value = number;
                    input.id = "subjectDetailQuantity";
                    input.type = "hidden";

                    subjectDetailList_container.appendChild(input);
                }
            });
        }

        $('#subjectDetailFiler_form').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize();
            document.getElementById("subjectDetailMemory").value = formData;
            document.getElementById("subjectDetailQuantity").remove();
            //scholasticId=4&majorId=0&semesterId=1
            loadData(formData); // Call the loadData function to load data
        });

        function reloadSubjectDetailData() {
            $.ajax({
                url: "{{ route('subject_detail.list') }}",
                type: 'GET',
                success: function(response) {
                    var formData = document.getElementById("subjectDetailMemory").value;
                    loadData(formData);
                }
            });
        }


        $('#subjectDetailList_container').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('subjectDetail_lecturer.edit') }}",
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    document.getElementById("successAlert").classList.add("show");

                    setTimeout(function() {
                        document.getElementById("successAlert").classList.remove("show")
                    }, 5000);

                    checkSubjectDetailData();
                    reloadStatisticalData();
                }
            });

            // e.preventDefault(); // Prevent the default form submission
            // var formData = $(this).serialize();
            // loadData(formData); // Call the loadData function to load data
        });

        var currentSubjectData = [];

        function checkSubjectData() {
            // var modalBody = document.getElementById("semesterControllPannel");

            $.ajax({
                url: "{{ route('subject.list') }}",
                type: 'GET',
                success: function(response) {

                    var subjectListTable_body = document.getElementById("subjectListTable_body");
                    subjectListTable_body.innerHTML = "";

                    Object.keys(response).forEach(key => {
                        var tr = document.createElement("tr");

                        var td = document.createElement("td");
                        td.textContent = response[key].MaMH;

                        tr.appendChild(td);

                        var td = document.createElement("td");
                        td.className = "d-flex justify-content-between";

                        var span = document.createElement("span");
                        span.textContent = response[key].TenMH;

                        var div1 = document.createElement("div");
                        div1.style.display = "none";

                        var form = document.createElement("form");
                        form.action = "";
                        form.id = "editSubjectForm" + response[key].MaMH;

                        var div2 = document.createElement("div");
                        div2.className = "input-group";

                        var subjectIdInput = document.createElement("input");
                        subjectIdInput.type = "text";
                        subjectIdInput.className = "form-control";
                        subjectIdInput.value = response[key].MaMH;
                        subjectIdInput.name = "MaMH";
                        subjectIdInput.maxLength = 12;
                        subjectIdInput.setAttribute("required", "");

                        var input = document.createElement("input");
                        input.type = "text";
                        input.className = "form-control";
                        input.value = response[key].TenMH;
                        input.name = "TenMH";
                        input.maxLength = 100;
                        input.setAttribute("required", "");

                        var button = document.createElement("button");
                        button.className = "btn btn-primary";
                        button.type = "submit";
                        button.textContent = "Lưu";

                        var csrf_token = document.createElement("input");
                        csrf_token.setAttribute("type", "hidden");
                        csrf_token.setAttribute("name", "_token");
                        csrf_token.setAttribute("value", "{{ csrf_token() }}");

                        var input_hidden1 = document.createElement("input");
                        input_hidden1.type = "hidden";
                        input_hidden1.name = "MaMH_hidden";
                        input_hidden1.value = response[key].MaMH;

                        var input_hidden2 = document.createElement("input");
                        input_hidden2.type = "hidden";
                        input_hidden2.name = "TenMH_hidden";
                        input_hidden2.value = response[key].TenMH;

                        div2.appendChild(subjectIdInput);
                        div2.appendChild(input);
                        div2.appendChild(button);

                        form.appendChild(input_hidden1);
                        form.appendChild(input_hidden2);
                        form.appendChild(csrf_token);
                        form.appendChild(div2);
                        div1.appendChild(form);

                        var div3 = document.createElement("div");
                        div3.className = "d-flex";

                        var a1 = document.createElement("a");
                        a1.href = "";
                        a1.className = "btn btn-sm btn-primary me-2 mb-3";
                        a1.textContent = "Sửa";

                        var a2 = document.createElement("a");
                        a2.href = "";
                        a2.className = "btn btn-sm btn-danger mb-3";
                        a2.textContent = "Xóa";

                        div3.appendChild(a1);
                        div3.appendChild(a2);
                        td.appendChild(span);
                        td.appendChild(div1);
                        td.appendChild(div3);

                        tr.appendChild(td);
                        subjectListTable_body.appendChild(tr);

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

                        // Example usage
                        a2.addEventListener('click',
                            function() {
                                event.preventDefault();
                                showConfirmAnalog(
                                    "Bạn có chắc là muốn xóa môn học '" + response[key].TenMH +
                                    "' không ?",
                                    function() {
                                        var url = "/monhoc/xoamonhoc?id=" +
                                            response[key].MaMH;
                                        axios.get(url)
                                            .then(function(response) {
                                                if (response.data == 'success') {
                                                    reloadStatisticalData();
                                                    reloadSubjectDetailData();
                                                    document
                                                        .getElementById(
                                                            "subjectFalseAlert"
                                                        ).classList
                                                        .remove("show")

                                                    document
                                                        .getElementById(
                                                            "subjectSuccessAlert"
                                                        )
                                                        .classList
                                                        .add(
                                                            "show"
                                                        );

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "subjectSuccessAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show"
                                                                )
                                                        },
                                                        5000
                                                    );

                                                    checkSubjectData();
                                                    checkSubjectDetailData();
                                                }
                                            })
                                    });
                            });

                        a1.addEventListener("click", function(
                            event) {
                            event.preventDefault();

                            if (div1.style.display === "none") {
                                div1.style.display = "block";
                                span.style.display = "none";

                                $('#editSubjectForm' + response[key].MaMH).on('submit',
                                    function(e) {
                                        e.preventDefault();
                                        var formData = $(this).serialize();
                                        $.ajax({
                                            url: "{{ route('subject.edit') }}",
                                            type: 'POST',
                                            data: formData,
                                            dataType: "json",
                                            success: function(response) {
                                                if (response ==
                                                    'success') {
                                                    document
                                                        .getElementById(
                                                            "subjectFalseAlert"
                                                        ).classList
                                                        .remove("show")

                                                    document
                                                        .getElementById(
                                                            "subjectSuccessAlert"
                                                        )
                                                        .classList
                                                        .add(
                                                            "show"
                                                        );

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "subjectSuccessAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show"
                                                                )
                                                        },
                                                        5000
                                                    );

                                                    checkSubjectData();
                                                    checkSubjectDetailData();

                                                } else {
                                                    document
                                                        .getElementById(
                                                            "subjectSuccessAlert"
                                                        )
                                                        .classList
                                                        .remove(
                                                            "show"
                                                        )

                                                    document.getElementById(
                                                        "subjectFalseAlert"
                                                    ).innerHTML = response;

                                                    document
                                                        .getElementById(
                                                            "subjectFalseAlert"
                                                        )
                                                        .classList
                                                        .add(
                                                            "show"
                                                        );

                                                    setTimeout(
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    "subjectFalseAlert"
                                                                )
                                                                .classList
                                                                .remove(
                                                                    "show"
                                                                )
                                                        },
                                                        5000
                                                    );
                                                }
                                            }
                                        });
                                    });
                            } else {
                                div1.style.display = "none";
                                span.style.display = "block";
                            }
                        });
                    });
                }
            });
        }

        document.getElementById("searchSubjectDetailTable").addEventListener("keyup", function() {
            let input = this.value.toLowerCase();
            let table = document.getElementById("subjectDetailTable_body");
            let rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName("td");
                let found = false;
                for (let j = 0; j < cells.length - 2; j++) {
                    let cellText = cells[j].innerText.toLowerCase();
                    if (cellText.includes(input)) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });

        $('#addSubject_form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('subject.add') }}",
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response ==
                        'success'
                    ) {
                        document.getElementById("subjectId").value = "";
                        document.getElementById("subjectName").value = "";
                        document.getElementById("subjectFalseAlert").classList.remove("show")

                        document.getElementById("subjectSuccessAlert").classList.add("show");

                        setTimeout(function() {
                            document.getElementById("subjectSuccessAlert").classList.remove(
                                "show")
                        }, 5000);
                        checkSubjectData();
                    } else {
                        document.getElementById("subjectSuccessAlert").classList.remove("show")

                        document.getElementById("subjectFalseAlert").classList.add("show");

                        setTimeout(function() {
                            document.getElementById("subjectFalseAlert").classList.remove(
                                "show")
                        }, 5000);
                    }
                }
            });
        });

        function getSemesterByScholasticList(scholasticId) {

            $.ajax({
                url: "{{ route('semeterByScholastic.list') }}",
                type: "GET",
                dataType: "json",
                data: 'id=' + scholasticId,
                success: function(response) {
                    // console.log(data);
                    document.getElementById("semesterFilter").innerHTML = "";
                    var semesterOptionFilter = document.createElement(
                        "option");
                    semesterOptionFilter.value = 0;
                    semesterOptionFilter.textContent = "Tất cả";

                    document.getElementById("semesterFilter").appendChild(
                        semesterOptionFilter);
                    Object.keys(response).forEach(key => {
                        var semesterOptionFilter = document.createElement(
                            "option");
                        semesterOptionFilter.value = response[key].MaHK;
                        semesterOptionFilter.textContent = response[key].TenHK;

                        document.getElementById("semesterFilter").appendChild(
                            semesterOptionFilter);
                    });
                }
            });

            $.ajax({
                url: "{{ route('majorByScholastic.list') }}",
                type: "GET",
                dataType: "json",
                data: 'id=' + scholasticId,
                success: function(response) {
                    document.getElementById("majorFilter").innerHTML = "";
                    var semesterOptionFilter = document.createElement(
                        "option");
                    semesterOptionFilter.value = 0;
                    semesterOptionFilter.textContent = "Tất cả";

                    document.getElementById("majorFilter").appendChild(
                        semesterOptionFilter);
                    Object.keys(response).forEach(key => {
                        var semesterOptionFilter = document.createElement(
                            "option");
                        semesterOptionFilter.value = response[key].MaNganh;
                        semesterOptionFilter.textContent = response[key].TenNganh;

                        document.getElementById("majorFilter").appendChild(
                            semesterOptionFilter);
                    });
                }
            });
        }

        function getSelectedScholasticSemesterList() {
            var defaultOption = document.querySelector('#scholasticFilter option:checked');
            getSemesterByScholasticList(defaultOption.value);
        }

        function getSemesterByMajor() {
            var majorId = document.querySelector('#majorFilter option:checked').value;
            console.log(majorId);
            $.ajax({
                url: "{{ route('semeterByMajor.list') }}",
                type: "GET",
                dataType: "json",
                data: 'id=' + majorId,
                success: function(response) {
                    // console.log(data);
                    document.getElementById("semesterFilter").innerHTML = "";
                    var semesterOptionFilter = document.createElement(
                        "option");
                    semesterOptionFilter.value = 0;
                    semesterOptionFilter.textContent = "Tất cả";

                    document.getElementById("semesterFilter").appendChild(
                        semesterOptionFilter);
                    Object.keys(response).forEach(key => {
                        var semesterOptionFilter = document.createElement(
                            "option");
                        semesterOptionFilter.value = response[key].MaHK;
                        semesterOptionFilter.textContent = response[key].TenHK;

                        document.getElementById("semesterFilter").appendChild(
                            semesterOptionFilter);
                    });
                }
            });
        }
        // ============================================
        // ============================================
        // ============================================
        // ============================================

        function doStatistical() {
            document.getElementById("scholasticStatistical_filter").innerHTML = "";
            document.getElementById("majorStatistical_filter").innerHTML = "";
            document.getElementById("lecturerStatistical_filter").innerHTML = "";
            document.getElementById("subjectStatistical_filter").innerHTML = "";
            document.getElementById("semesterStatistical_filter").innerHTML = "";
            $.ajax({
                url: "{{ route('scholastic.list') }}",
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    var select = document.getElementById("scholasticStatistical_filter");
                    Object.keys(response).forEach(key => {
                        var option = document.createElement("option");
                        option.value = response[key].MaNH;
                        option.textContent = response[key].TenNH;
                        select.appendChild(option);
                    });

                    $.ajax({
                        url: "{{ route('major.list') }}",
                        type: 'GET',
                        dataType: "json",
                        success: function(response) {
                            var select = document.getElementById("majorStatistical_filter");
                            var option = document.createElement("option");
                            option.value = '0';
                            option.textContent = 'Tất cả';
                            select.appendChild(option);
                            Object.keys(response).forEach(key => {
                                var option = document.createElement("option");
                                option.value = response[key].MaNganh;
                                option.textContent = response[key].TenNganh;
                                select.appendChild(option);
                            });
                            $.ajax({
                                url: "{{ route('semester.list') }}",
                                type: 'GET',
                                dataType: "json",
                                success: function(response) {
                                    var select = document.getElementById(
                                        "semesterStatistical_filter");
                                    var option = document.createElement("option");
                                    option.value = '0';
                                    option.textContent = 'Tất cả';
                                    select.appendChild(option);
                                    Object.keys(response).forEach(key => {
                                        var option = document.createElement(
                                            "option");
                                        option.value = response[key].MaHK;
                                        option.textContent = response[key]
                                            .TenHK;
                                        select.appendChild(option);
                                    });
                                    $.ajax({
                                        url: "{{ route('subject.list') }}",
                                        type: 'GET',
                                        dataType: "json",
                                        success: function(response) {
                                            var select = document
                                                .getElementById(
                                                    "subjectStatistical_filter"
                                                );
                                            var option = document
                                                .createElement("option");
                                            option.value = '0';
                                            option.textContent = 'Tất cả';
                                            select.appendChild(option);
                                            Object.keys(response).forEach(
                                                key => {
                                                    var option =
                                                        document
                                                        .createElement(
                                                            "option");
                                                    option.value =
                                                        response[
                                                            key].MaMH;
                                                    option.textContent =
                                                        response[key]
                                                        .TenMH;
                                                    select.appendChild(
                                                        option);
                                                });

                                            $.ajax({
                                                url: "{{ route('lecturers.list') }}",
                                                type: 'GET',
                                                dataType: "json",
                                                success: function(
                                                    response) {
                                                    var select =
                                                        document
                                                        .getElementById(
                                                            "lecturerStatistical_filter"
                                                        );
                                                    var option =
                                                        document
                                                        .createElement(
                                                            "option"
                                                        );
                                                    option
                                                        .value =
                                                        '0';
                                                    option
                                                        .textContent =
                                                        'Tất cả';
                                                    select
                                                        .appendChild(
                                                            option
                                                        );
                                                    Object.keys(
                                                            response
                                                        )
                                                        .forEach(
                                                            key => {
                                                                if (response[
                                                                        key
                                                                    ]
                                                                    .MaGV !=
                                                                    1
                                                                ) {
                                                                    var option =
                                                                        document
                                                                        .createElement(
                                                                            "option"
                                                                        );
                                                                    option
                                                                        .value =
                                                                        response[
                                                                            key
                                                                        ]
                                                                        .MaGV;
                                                                    option
                                                                        .textContent =
                                                                        response[
                                                                            key
                                                                        ]
                                                                        .TenGV;
                                                                    select
                                                                        .appendChild(
                                                                            option
                                                                        );
                                                                } else {}

                                                            });
                                                    var formData =
                                                        $(
                                                            '#getStatisticalData_form'
                                                        )
                                                        .serialize();
                                                    $.ajax({
                                                        url: "{{ route('getStatistical_handle') }}",
                                                        type: 'GET',
                                                        data: formData,
                                                        dataType: "json",
                                                        success: function(
                                                            response
                                                        ) {
                                                            setStatisticalData
                                                                (
                                                                    response
                                                                );
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }

        function setStatisticalData(response) {
            var stt = 0;
            var table = document.getElementById("statisticalTable_Body");
            table.innerHTML = "";
            var data = response[0];
            var lecturers = response[1];
            sum1 = 0;
            sum2 = 0;
            sum3 = 0;

            document.getElementById("statisticalTitle").innerHTML = "Thống kê giờ giảng dạy lý thuyết, thực hành năm học " +
                response[2][0].TenNH;

            Object.keys(lecturers).forEach(key1 => {
                var status = 0;
                var row = 0;
                var total = 0;

                Object.keys(data).forEach(key2 => {
                    if (lecturers[key1].MaGV == data[key2].MaGV) {
                        row++;
                    }
                });
                // var tr = document.createElement("tr");
                // var td = document.createElement("td");
                // td.textContent = row;
                // tr.appendChild(td);
                // table.appendChild(tr);

                Object.keys(data).forEach(key2 => {
                    if (lecturers[key1].MaGV == data[key2].MaGV) {
                        if (lecturers[key1].MaGV != 1) {
                            if (status == 0) {
                                stt++;
                            }

                            if (lecturers[key1].MaGV == data[key2].MaGV) {
                                if (data[key2].SoLuongSV >= 81) {
                                    var HS = 1.5;
                                } else if (data[key2].SoLuongSV >= 71) {
                                    var HS = 1.4;
                                } else if (data[key2].SoLuongSV >= 61) {
                                    var HS = 1.3;
                                } else if (data[key2].SoLuongSV >= 51) {
                                    var HS = 1.2;
                                } else if (data[key2].SoLuongSV >= 41) {
                                    var HS = 1.1;
                                }

                                var QRGC_LT = data[key2].SoTiet * HS;
                                var QRGC_TH = data[key2].SoChiTH * data[key2].SoLuongSV * 0.6;
                                total += (QRGC_LT + QRGC_TH);
                                sum1 += QRGC_LT;
                                sum2 += QRGC_TH;


                                if (status == 0) {
                                    var tr = document.createElement("tr");
                                    var td1 = document.createElement("td");
                                    td1.setAttribute("rowspan", row);
                                    td1.textContent = stt;

                                    var td2 = document.createElement("td");
                                    td2.setAttribute("rowspan", row);
                                    td2.textContent = data[key2].TenGV;

                                    var td3 = document.createElement("td");
                                    td3.textContent = data[key2].TenHK;

                                    var td4 = document.createElement("td");
                                    td4.textContent = data[key2].SoTiet;

                                    var td5 = document.createElement("td");
                                    td5.textContent = data[key2].SoLuongSV;

                                    var td6 = document.createElement("td");
                                    td6.classList = "text-primary";
                                    td6.textContent = HS;

                                    var td7 = document.createElement("td");
                                    td7.classList = "text-primary";
                                    td7.textContent = QRGC_LT.toFixed(1);

                                    var td8 = document.createElement("td");
                                    td8.textContent = data[key2].TenHK;

                                    var td9 = document.createElement("td");
                                    td9.textContent = data[key2].SoChiTH;

                                    var td10 = document.createElement("td");
                                    td10.textContent = data[key2].SoLuongSV;

                                    var td11 = document.createElement("td");
                                    td11.textContent = 0.6;

                                    var td12 = document.createElement("td");
                                    td12.classList = "text-primary";
                                    td12.textContent = QRGC_TH.toFixed(1);

                                    var td13 = document.createElement("td");
                                    td13.classList = "text-danger";
                                    td13.textContent = (QRGC_LT + QRGC_TH).toFixed(1);

                                    var td14 = document.createElement("td");
                                    td14.id = "totalSum" + lecturers[key1].MaGV;
                                    // td14.textContent = "total";
                                    td14.setAttribute("rowspan", row);

                                    tr.appendChild(td1);
                                    tr.appendChild(td2);
                                    tr.appendChild(td3);
                                    tr.appendChild(td4);
                                    tr.appendChild(td5);
                                    tr.appendChild(td6);
                                    tr.appendChild(td7);
                                    tr.appendChild(td8);
                                    tr.appendChild(td9);
                                    tr.appendChild(td10);
                                    tr.appendChild(td11);
                                    tr.appendChild(td12);
                                    tr.appendChild(td13);
                                    tr.appendChild(td14);

                                    table.appendChild(tr);
                                } else {
                                    var tr = document.createElement("tr");

                                    var td3 = document.createElement("td");
                                    td3.textContent = data[key2].TenHK;

                                    var td4 = document.createElement("td");
                                    td4.textContent = data[key2].SoTiet;

                                    var td5 = document.createElement("td");
                                    td5.textContent = data[key2].SoLuongSV;

                                    var td6 = document.createElement("td");
                                    td6.classList = "text-primary";
                                    td6.textContent = HS;

                                    var td7 = document.createElement("td");
                                    td7.classList = "text-primary";
                                    td7.textContent = QRGC_LT.toFixed(1);

                                    var td8 = document.createElement("td");
                                    td8.textContent = data[key2].TenHK;

                                    var td9 = document.createElement("td");
                                    td9.textContent = data[key2].SoChiTH;

                                    var td10 = document.createElement("td");
                                    td10.textContent = data[key2].SoLuongSV;

                                    var td11 = document.createElement("td");
                                    td11.textContent = 0.6;

                                    var td12 = document.createElement("td");
                                    td12.classList = "text-primary";
                                    td12.textContent = QRGC_TH.toFixed(1);

                                    var td13 = document.createElement("td");
                                    td13.classList = "text-danger";
                                    td13.textContent = (QRGC_LT + QRGC_TH).toFixed(1);

                                    tr.appendChild(td3);
                                    tr.appendChild(td4);
                                    tr.appendChild(td5);
                                    tr.appendChild(td6);
                                    tr.appendChild(td7);
                                    tr.appendChild(td8);
                                    tr.appendChild(td9);
                                    tr.appendChild(td10);
                                    tr.appendChild(td11);
                                    tr.appendChild(td12);
                                    tr.appendChild(td13);


                                    table.appendChild(tr);
                                }
                                status++;
                            }
                        }

                    }
                });
                if (lecturers[key1].MaGV != 1) {
                    sum3 += total;
                    var check = 0;
                    if (document.getElementById("totalSum" + lecturers[key1].MaGV)) {
                        var target = document.getElementById("totalSum" + lecturers[key1].MaGV)
                        target.innerHTML = total.toFixed(1)
                        target.classList = "fw-bold text-danger";
                        // check++;
                    }
                    // console.log(check);
                }
            });

            var tr = document.createElement("tr");

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = "Cộng";
            td.classList = "fw-bold text-danger"
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = sum1.toFixed(1);
            td.classList = "fw-bold text-danger"
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = sum2.toFixed(1);
            td.classList = "fw-bold text-danger"
            tr.appendChild(td);

            var td = document.createElement("td");
            td.textContent = sum3.toFixed(1);
            td.classList = "fw-bold text-danger"
            tr.appendChild(td);
            table.appendChild(tr);

        }

        function getStatisticalData() {
            // var scholasticId = document.getElementById("scholasticId");
            // var MajorId = document.getElementById("MajorId");
            // var semesterId = document.getElementById("SemesterId");
            // var subjectId = document.getElementById("SubjectId");
            // var lecturerId = document.getElementById("LectureId");


            $('#getStatisticalData_form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('getStatistical_handle') }}",
                    type: 'GET',
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        setStatisticalData(response);
                    }
                });
            });

        }

        getStatisticalData();

        function reloadStatisticalData() {
            doStatistical();

            // var formData = $('#getStatisticalData_form').serialize();
            // $.ajax({
            //     url: "{{ route('getStatistical_handle') }}",
            //     type: 'GET',
            //     data: formData,
            //     dataType: "json",
            //     success: function(response) {
            //         setStatisticalData(response);
            //     }
            // });
        }


        function searchStatistical() {
            const searchInput = document.getElementById('statisticalSearch');
            searchInput.addEventListener('input', filterTable);

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const table = document.getElementById(
                    'xport'); // Replace 'yourTableId' with the actual ID of your table
                const rows = table.getElementsByTagName('tr');

                for (let i = 1; i < rows.length; i++) { // Start from index 1 to skip the table header row
                    const cells = rows[i].getElementsByTagName('td');
                    let found = false;

                    for (let j = 0; j < cells.length; j++) {
                        const cellValue = cells[j].textContent.toLowerCase();

                        if (cellValue.includes(searchValue)) {
                            found = true;
                            break;
                        }
                    }

                    rows[i].style.display = found ? '' : 'none';
                }
            }
        }
    </script>

    {{-- Xử lý xuất file excel --}}
    <script>
        function exportFile() {
            var tbl = document.getElementById("xport");
            const wb = XLSX.utils.table_to_book(tbl);
            XLSX.writeFile(wb, "HTMLTable.xlsx");

        }
    </script>

    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/shim.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
