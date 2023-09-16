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

    public function editSubject($data)
    {
        $MaMH = $data['MaMH'];
        $TenMH = $data['TenMH'];
        $check = DB::select("SELECT * FROM monhoc WHERE TenMH = '$TenMH'");
        if ($check == null) {
            DB::select("UPDATE `monhoc` SET `TenMH`='$TenMH' WHERE `MaMH`='$MaMH'");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function handleAddSubjectByForm($data)
    {
        // dd($data);
        $availableMajor = $data['availableMajor'];
        $newMajor = $data['newMajor'];
        $availableSubject = $data['availableSubject'];
        $newSubjectName = $data['newSubjectName'];
        $newSubjectId = $data['newSubjectId'];
        $availableScholastic = $data['availableScholastic'];
        $newScholastic = $data['newScholastic'];
        $availableSemester = $data['availableSemester'];
        $newSemester = $data['newSemester'];

        $TC = $data['tc'];
        $SoLuongSV = $data['studentQuantity'];

        if (
            $availableMajor == "Chọn ngành học đã lưu" && $newMajor == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectName == null && $newSubjectId == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectId == null ||
            $availableSubject == "Chọn môn học đã lưu" && $newSubjectName == null ||
            $availableScholastic == "Chọn năm học đã lưu" && $newScholastic == null ||
            $availableSemester == "Chọn học kì đã lưu" && $newSemester == null
        ) {
            return "Vui lòng kiểm tra và cung cấp đầy đủ dữ liệu để thực hiện thao tác !";
        } else {
            // dd("ok");
            if ($newMajor == null) {
                $MaNganh = $availableMajor;
            } else {
                $MaNganh = DB::table('nganh')->insertGetId([
                    'TenNganh' => $newMajor,
                ]);
            }

            if ($newSubjectName == null && $newSubjectId == null) {
                $MaMH = $availableSubject;
            } else {
                $MaMH = DB::table('monhoc')->insertGetId([
                    'MaMH' => $newSubjectId,
                    'TenMH' => $newSubjectName,
                ]);
            }

            if ($newScholastic == null) {
                $MaNH = $availableScholastic;
            } else {
                $MaNH = DB::table('namhoc')->insertGetId([
                    'TenNH' => $newScholastic,
                ]);
            }

            if ($newSemester == null) {
                $MaHK = $availableSemester;
            } else {
                $MaHK = DB::table('hocki')->insertGetId([
                    'TenHK' => $newSemester,
                ]);
            }

            dd("$MaNganh, $MaMH, $MaNH, $MaHK, $TC, $SoLuongSV");
        }
    }

    public function deleteSubject($data)
    {
        $MaMH = $data['id'];
        DB::select("DELETE FROM `monhoc` WHERE MaMH = $MaMH");
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
            $subjectData = array_chunk($subjectData, 5);
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
                    $SoLuongSV = $item2[4];
                    $SoTinChi = $item2[3];
                    $subjectDetailData = DB::select("SELECT * FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaHK = '$MaHK' AND MaNH = '$MaNH' AND MaNganh = '$MaNganh'");
                    if (empty($subjectDetailData)) {
                        DB::select("INSERT INTO `chitietmonhoc` (`SoLuongSV`, `SoTinChi`, `MaMH`, `MaHK`, `MaNH`, `MaNganh`, `MaGV`) VALUES ('$SoLuongSV', '$SoTinChi', '$MaMH', '$MaHK', '$MaNH', '$MaNganh', '1');");
                    }
                }
            }
        }
    }
}