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
        $subjectsList = DB::select("SELECT * FROM monhoc");
        return $subjectsList;
    }

    public function addSubject($data){
        $MaMH = $data['subjectId'];
        $TenMH = $data['subjectName'];
        $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH' OR TenMH = '$TenMH'");
        if($check){
            return "false";
        }else{
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

        if($MaMH != $MaMH_hidden && $TenMH == $TenMH_hidden){
            $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH'");
            $msg = "Mã môn học đã tồn tại !";
        }
        if($MaMH == $MaMH_hidden && $TenMH != $TenMH_hidden){
            $check = DB::select("SELECT * FROM monhoc WHERE TenMH = '$TenMH'");
            $msg = "Tên môn học đã tồn tại";
        }
        if($MaMH != $MaMH_hidden && $TenMH != $TenMH_hidden || $MaMH == $MaMH_hidden && $TenMH == $TenMH_hidden){
            $check = DB::select("SELECT * FROM monhoc WHERE MaMH = '$MaMH' OR TenMH = '$TenMH'");
            $msg = "Mã môn học và tên môn học đã tồn tại !";
        }

        if ($check == null) {
            DB::select("UPDATE `monhoc` SET `TenMH`='$TenMH' WHERE `MaMH`='$MaMH'");
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
            $availableMajor == "Chọn ngành học đã lưu" && $newMajor == null ||
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
                    return '2';
                } else {
                    DB::select("INSERT INTO `monhoc`(`MaMH`, `TenMH`) VALUES ('$newSubjectId','$newSubjectName')");
                    $MaMH = $newSubjectId;
                }
            }

            if ($newMajor == null) {
                $MaNganh = $availableMajor;
            } else {
                $check = DB::select("SELECT * FROM nganh WHERE TenNganh = '$newMajor'");
                if ($check != null) {
                    $MaNganh = $check[0]->MaNganh;
                } else {
                    $MaNganh = DB::table('nganh')->insertGetId([
                        'TenNganh' => $newMajor,
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
                $MaNH = DB::table('namhoc')->insertGetId([
                    'TenNH' => $newScholastic,
                ]);
            }

            if ($newSemester == null) {
                $MaHK = $availableSemester;
            } else {
                $check = DB::select("SELECT * FROM hocki WHERE TenHK = '$newSemester'");
                if ($check != null) {
                    $MaHK = $check[0]->MaHK;
                }
                $MaHK = DB::table('hocki')->insertGetId([
                    'TenHK' => $newSemester,
                ]);
            }
            $check = DB::select("SELECT * FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaNH = '$MaNH' AND MaHK = '$MaHK' AND MaNganh = '$MaNganh'");
            if ($check != null) {
                return '3';
            } else {
                DB::select("INSERT INTO `chitietmonhoc`(`SoLuongSV`, `SoTiet`, `SoChiTH`, `MaMH`, `MaHK`, `MaNH`, `MaNganh`, `MaGV`) VALUES ('$SoLuongSV','$ST', '$TH', '$MaMH','$MaHK','$MaNH','$MaNganh','1')");
                $result = DB::select("SELECT monhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTiet, chitietmonhoc.SoChiTH, chitietmonhoc.SoLuongSV, nganh.TenNganh, hocki.TenHK, namhoc.TenNH, hocki.MaHK, namhoc.MaNH, nganh.MaNganh, chitietmonhoc.MaGV FROM monhoc, hocki, nganh, namhoc, chitietmonhoc WHERE monhoc.MaMH = chitietmonhoc.MaMH AND hocki.MaHK = chitietmonhoc.MaHK AND nganh.MaNganh = chitietmonhoc.MaNganh AND namhoc.MaNH = chitietmonhoc.MaNH AND chitietmonhoc.MaMH = '$MaMH' AND chitietmonhoc.MaNganh = '$MaNganh' AND chitietmonhoc.MaNH = '$MaNH' AND chitietmonhoc.MaHK = '$MaHK'");
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
        $MaNganh = $data['majorId'];
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
                    $subjectDetailData = DB::select("SELECT * FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaHK = '$MaHK' AND MaNH = '$MaNH' AND MaNganh = '$MaNganh'");
                    if (empty($subjectDetailData)) {
                        DB::select("INSERT INTO `chitietmonhoc` (`SoLuongSV`, `SoTiet`, `SoChiTH`, `MaMH`, `MaHK`, `MaNH`, `MaNganh`, `MaGV`) VALUES ('$SoLuongSV', '$SoTiet', '$SoChiTH', '$MaMH', '$MaHK', '$MaNH', '$MaNganh', '1');");
                    }
                }
            }
        }
    }
}