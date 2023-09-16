@extends('layout.layout')
@section('alert')
    {{-- <div class="alert py-2 alert-danger text-center fade" role="alert" id="scolasticFalseAlert">
        Vui lòng kiểm tra và cung cấp đầy đủ dữ liệu để thực hiện thao tác !
    </div>
    <div class="alert py-2 alert-success text-center" role="alert" id="scolasticSuccessAlert">
        Thao tác thành công !
    </div> --}}
@endsection

@section('content')
    <div class="">
        <form action="/monhoc/xu-ly-them-mon-hoc-bang-form" method="POST">
            <div class="py-2  px-3">
                <div class="">
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Ngành học</span>
                        <select class="form-select" aria-label="Default select example" name="availableMajor">
                            <option>Chọn ngành học đã lưu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Nhập tên ngành học mới"
                            aria-label="Username" aria-describedby="basic-addon1" maxlength="30" name="newMajor">
                    </div>
                    <br>
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Môn học&ensp;&ensp;</span>
                        <select class="form-select" aria-label="Default select example" name="availableSubject">
                            <option>Chọn môn học đã lưu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
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
                        <select class="form-select" aria-label="Default select example" name="availableScholastic">
                            <option>Chọn năm học đã lưu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Thêm năm học mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="10" name="newScholastic">
                    </div>
                    <br>
                    <div class="input-group border border-primary rounded">
                        <span class="input-group-text text-primary" id="basic-addon1">Học
                            kì&ensp;&ensp;&ensp;&ensp;&nbsp;</span>
                        <select class="form-select" aria-label="Default select example" name="availableSemester">
                            <option>Chọn học kì đã lưu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <input type="text" class="form-control w-50" placeholder="Thêm học kì mới" aria-label="Username"
                            aria-describedby="basic-addon1" maxlength="20" name="newSemester">
                    </div>

                    <div class="mt-2 d-flex justify-content-end">
                        <div class="input-group mb-3 w-50">
                            <input type="number" class="form-control w-25" placeholder="Số tín chỉ" aria-label="Username"
                                aria-describedby="addon-wrapping" name="tc" required>
                            <span class="input-group-text" id="addon-wrapping">TC</span>
                            <input type="number" class="form-control w-25" placeholder="Số lượng sinh viên"
                                aria-label="Recipient's username" aria-describedby="button-addon2" name="studentQuantity" required>
                            <button class="btn btn-primary" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
