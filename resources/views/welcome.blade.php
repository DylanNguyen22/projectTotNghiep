<div class="input-group mb-3">
    <input type="text" id="majorSearch" class="form-control" placeholder="Vui lòng nhập năm học cần tìm"
        aria-label="Recipient's username" aria-describedby="button-addon2" onkeyup="searchMajor()">
    <span class="input-group-text" id="basic-addon2"><ion-icon name="search"></ion-icon></span>
</div>

<table class="table table-striped" id="majorListTable_Body">
    <tr>
        <td class="d-flex justify-content-between">
            <span id="majorName" class="ms-2">Khoa học dữ liệu</span>
            <div id="majorEditForm" style="display: none;">
                <form action="http://127.0.0.1:8000/nganhhoc/suanganhhoc" id="editMajorName_Form2">
                    <div class="input-group mb-3"><input type="text" class="form-control" name="TenNganh"
                            maxlength="30" aria-label="Recipient's username" aria-describedby="button-addon2"><button
                            class="btn btn-outline-primary" type="submit" id="button-addon2">Lưu</button></div><input
                        type="hidden" class="form-control" name="MaNganh" value="2"
                        aria-label="Recipient's username" aria-describedby="button-addon2"><input type="hidden"
                        name="_token" value="WVy5wqVdKdHMGi7mrNWHjEFF99id1VgTssea94ki">
                </form>
            </div>
            <div class="me-2"><a href="#" class="btn btn-sm btn-primary me-2" id="editMajorBtn2">Sửa</a><a
                    href="" id="deleteMajor2" class="btn btn-sm btn-danger">Xóa</a></div>
        </td>
    </tr>
    <tr>
        <td class="d-flex justify-content-between">
            <span id="majorName" class="ms-2">Kỹ thuật phần mềm</span>
            <div id="majorEditForm" style="display: none;">
                <form action="http://127.0.0.1:8000/nganhhoc/suanganhhoc" id="editMajorName_Form1">
                    <div class="input-group mb-3"><input type="text" class="form-control" name="TenNganh"
                            maxlength="30" aria-label="Recipient's username" aria-describedby="button-addon2"><button
                            class="btn btn-outline-primary" type="submit" id="button-addon2">Lưu</button></div><input
                        type="hidden" class="form-control" name="MaNganh" value="1"
                        aria-label="Recipient's username" aria-describedby="button-addon2"><input type="hidden"
                        name="_token" value="WVy5wqVdKdHMGi7mrNWHjEFF99id1VgTssea94ki">
                </form>
            </div>

            <div class="me-2"><a href="#" class="btn btn-sm btn-primary me-2" id="editMajorBtn1">Sửa</a><a
                    href="" id="deleteMajor1" class="btn btn-sm btn-danger">Xóa</a></div>
        </td>
    </tr>
</table>

<script>
    function searchMajor() {
        const searchValue = document.getElementById("majorSearch").value.toLowerCase();
  const table = document.getElementById('majorListTable_Body'); // Thay 'majorListTable_Body' bằng ID thực tế của bảng
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
</script>
