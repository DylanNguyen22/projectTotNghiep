<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectsModel extends Model
{
    use HasFactory;

    public function getAllSubjects()
    {
        $subjectsList = DB::select("SELECT * FROM monhoc ORDER BY MaMH DESC");
        return $subjectsList;
    }

    public function addSubject($data)
    {
        $MaMH = $data['subjectId'];
        $TenMH = $data['subjectName'];
        $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH' OR TenMH = '$TenMH'");
        if ($check) {
            return "false";
        } else {
            DB::select("INSERT INTO `monhoc`(`MaMH`, `TenMH`) VALUES ('$MaMH','$TenMH')");
            return "success";
        }
    }

    public function editSubject($data)
    {
        $MaMH = $data['MaMH'];
        $MaMH_hidden = $data['MaMH_hidden'];
        $TenMH = $data['TenMH'];
        $TenMH_hidden = $data['TenMH_hidden'];

        if ($MaMH != $MaMH_hidden && $TenMH == $TenMH_hidden) {
            $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH'");
            $msg = "Mã môn học đã tồn tại !";
        } elseif ($MaMH == $MaMH_hidden && $TenMH != $TenMH_hidden) {
            $check = DB::select("SELECT * FROM monhoc WHERE TenMH = '$TenMH'");
            $msg = "Tên môn học đã tồn tại";
        } elseif ($MaMH != $MaMH_hidden && $TenMH != $TenMH_hidden) {
            $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH' OR TenMH = '$TenMH'");
            $msg = "Mã môn học và tên môn học đã tồn tại !";
        } else {
            $check = null;
        }

        if ($check == null) {
            DB::select("UPDATE `monhoc` SET `TenMH`='$TenMH', `MaMH`='$MaMH' WHERE `MaMH`='$MaMH_hidden'");
            return 'success';
        } else {
            return $msg;
        }
    }

    public function handleAddSubjectByForm($data)
    {
        $availableMajor = $data['availableMajor'];
        $newMajor = $data['newMajor'];
        $availableSubject = $data['availableSubject'];
        $newSubjectName = $data['newSubjectName'];
        $newSubjectId = $data['newSubjectId'];
        $availableScholastic = $data['availableScholastic'];
        $newScholastic = $data['newScholastic'];
        $availableSemester = $data['availableSemester'];
        $newSemester = $data['newSemester'];

        $ST = $data['ST'];
        $TH = $data['TH'];
        $SoLuongSV = $data['studentQuantity'];

        if (
            $availableMajor == "Chọn lớp học đã lưu" && $newMajor == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectName == null && $newSubjectId == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectId == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectName == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectName == null && $newSubjectId == null ||
            $availableScholastic == "Chọn năm học đã lưu" && $newScholastic == null ||
            $availableSemester == "Chọn học kì đã lưu" && $newSemester == null
        ) {
            return "1";
        } else {
            if ($newSubjectName == null && $newSubjectId == null) {
                $MaMH = $availableSubject;
            } else {
                $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$newSubjectId'");
                if ($check != null) {
                    $MaMH = $check[0]->MaMH;
                } else {
                    $check = DB::select("SELECT * FROM monhoc WHERE TenMH = '$newSubjectName'");
                    if ($check != null) {
                        $MaMH = $check[0]->MaMH;
                    } else {
                        DB::select("INSERT INTO `monhoc`(`MaMH`, `TenMH`) VALUES ('$newSubjectId','$newSubjectName')");
                        $MaMH = $newSubjectId;
                    }

                }
            }

            if ($newMajor == null) {
                $MaLop = $availableMajor;
            } else {
                $check = DB::select("SELECT * FROM lop WHERE TenLop = '$newMajor'");
                if ($check != null) {
                    $MaLop = $check[0]->MaLop;
                } else {
                    $MaLop = DB::table('lop')->insertGetId([
                        'TenLop' => $newMajor,
                    ]);
                }
            }

            if ($newScholastic == null) {
                $MaNH = $availableScholastic;
            } else {
                $check = DB::select("SELECT * FROM namhoc WHERE TenNH = '$newScholastic'");
                if ($check != null) {
                    $MaNH = $check[0]->MaNH;
                }
                else{
                    $MaNH = DB::table('namhoc')->insertGetId([
                        'TenNH' => $newScholastic,
                    ]);
                }
            }

            if ($newSemester == null) {
                $MaHK = $availableSemester;
            } else {
                $check = DB::select("SELECT * FROM hocki WHERE TenHK = '$newSemester'");
                if ($check != null) {
                    $MaHK = $check[0]->MaHK;
                }
                else{
                    $MaHK = DB::table('hocki')->insertGetId([
                        'TenHK' => $newSemester,
                    ]);
                }
            }
            $check = DB::select("SELECT * FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaNH = '$MaNH' AND MaHK = '$MaHK' AND MaLop = '$MaLop'");
            if ($check != null) {
                return '3';
            } else {
                DB::select("INSERT INTO `chitietmonhoc`(`SoLuongSV`, `SoTiet`, `SoChiTH`, `MaMH`, `MaHK`, `MaNH`, `MaLop`, `MaGV`) VALUES ('$SoLuongSV','$ST', '$TH', '$MaMH','$MaHK','$MaNH','$MaLop','1')");
                $result = DB::select("SELECT monhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTiet, chitietmonhoc.SoChiTH, chitietmonhoc.SoLuongSV, lop.TenLop, hocki.TenHK, namhoc.TenNH, hocki.MaHK, namhoc.MaNH, lop.MaLop, chitietmonhoc.MaGV FROM monhoc, hocki, lop, namhoc, chitietmonhoc WHERE monhoc.MaMH = chitietmonhoc.MaMH AND hocki.MaHK = chitietmonhoc.MaHK AND lop.MaLop = chitietmonhoc.MaLop AND namhoc.MaNH = chitietmonhoc.MaNH AND chitietmonhoc.MaMH = '$MaMH' AND chitietmonhoc.MaLop = '$MaLop' AND chitietmonhoc.MaNH = '$MaNH' AND chitietmonhoc.MaHK = '$MaHK'");
                return $result;
            }

        }
    }

    public function deleteSubject($data)
    {
        $MaMH = $data['id'];
        DB::select("DELETE FROM `monhoc` WHERE MaMH = '$MaMH'");
        return 'success';
    }

    public function handleAddSubjectByExcelFile($data)
    {
        $MaLop = $data['majorId'];
        $newSubject = $data['newMajor'];
        if ($newSubject) {
            $check = DB::select("SELECT * FROM lop WHERE TenLop = '$newSubject'");
            if ($check) {
                $MaLop = $check[0]->MaLop;
            } else {
                $MaLop = DB::table('Lop')->insertGetId([
                    'TenLop' => $newSubject
                ]);
            }


        }
        $arr = explode("|", $data['excelData']);
        array_shift($arr);

        foreach ($arr as $item1) {
            $arr2 = explode("//", $item1);
            $semester_scholastic_arr = str_replace(",", "", $arr2[0]);
            $semesterName = explode(" ", $semester_scholastic_arr)[0];
            $scholasticName = explode(" ", $semester_scholastic_arr)[1];

            $semesterData = DB::select("SELECT * FROM hocki WHERE TenHK = '$semesterName'");
            if ($semesterData != NULL) {
                $MaHK = $semesterData[0]->MaHK;
            } else {
                $MaHK = DB::table('hocki')->insertGetId([
                    'TenHK' => "$semesterName"
                ]);
            }

            $scholasticData = DB::select("SELECT * FROM namhoc WHERE TenNH = '$scholasticName'");
            if ($scholasticData != NULL) {
                $MaNH = $scholasticData[0]->MaNH;
            } else {
                $MaNH = DB::table('namhoc')->insertGetId([
                    'TenNH' => "$scholasticName"
                ]);
            }

            $subjectData = $arr2[1];
            $subjectData = explode(",", $subjectData);
            $subjectData = array_filter($subjectData, 'strlen');
            $subjectData = array_chunk($subjectData, 6);
            // dd($subjectData);

            foreach ($subjectData as $key => $item2) {
                if ($key != 0) {
                    // dd($item);
                    $subjectData = DB::select("SELECT * FROM monhoc WHERE MaMH = '" . $item2[1] . "'");
                    if (empty($subjectData)) {
                        $MaMH = $item2[1];
                        $TenMH = $item2[2];
                        DB::select("INSERT INTO `monhoc`(`MaMH`, `TenMH`) VALUES ('$MaMH','$TenMH')");
                    } else {
                        $MaMH = $subjectData[0]->MaMH;
                    }
                    $SoLuongSV = $item2[5];
                    $SoTiet = $item2[3];
                    $SoChiTH = $item2[4];
                    $subjectDetailData = DB::select("SELECT * FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaHK = '$MaHK' AND MaNH = '$MaNH' AND MaLop = '$MaLop'");
                    if (empty($subjectDetailData)) {
                        DB::select("INSERT INTO `chitietmonhoc` (`SoLuongSV`, `SoTiet`, `SoChiTH`, `MaMH`, `MaHK`, `MaNH`, `MaLop`, `MaGV`) VALUES ('$SoLuongSV', '$SoTiet', '$SoChiTH', '$MaMH', '$MaHK', '$MaNH', '$MaLop', '1');");
                    }
                }
            }
        }
    }
}