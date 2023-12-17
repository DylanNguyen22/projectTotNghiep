<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SemesterModel extends Model
{
    use HasFactory;

    public function getAllSemester()
    {
        $semester = DB::select("SELECT * FROM hocki");
        return $semester;
    }

    public function editSemester($data)
    {
        $TenHK = $data['TenHK'];
        $MaHK = $data['MaHK'];
        $check = DB::select("SELECT * FROM hocki WHERE TenHK = '$TenHK'");
        if ($check == null) {
            DB::select("UPDATE `hocki` SET `TenHK`='$TenHK' WHERE `MaHK`='$MaHK'");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function getSemesterListByScholastic($data)
    {
        $MaNH = $data['id'];
        $result = DB::select("SELECT hocki.MaHK, hocki.TenHK FROM hocki, namhoc, chitietmonhoc WHERE hocki.MaHK = chitietmonhoc.MaHK AND namhoc.MaNH = chitietmonhoc.MaNH AND namhoc.MaNH = '$MaNH' GROUP BY hocki.MaHK, hocki.TenHK");
        return $result;
    }

    public function getSemesterListByMajor($data)
    {
        $MaLop = $data['id'];
        $result = DB::select("SELECT hocki.MaHK, hocki.TenHK FROM chitietmonhoc, lop, hocki WHERE lop.MaLop = chitietmonhoc.MaLop AND hocki.MaHK = chitietmonhoc.MaHK AND chitietmonhoc.MaLop = '$MaLop' GROUP BY hocki.MaHK, hocki.TenHK");
        return $result;
    }

    public function addSemester($data)
    {
        $TenHK = $data['TenHK'];
        $check = DB::select("SELECT * FROM hocki WHERE TenHK = '$TenHK'");
        if ($check == null) {
            DB::select("INSERT INTO `hocki`(`TenHK`) VALUES ('$TenHK')");
            return 'success';
        } else {
            return 'false';
        }

    }

    public function deleteSemester($data)
    {
        $MaHK = $data['id'];
        DB::select("DELETE FROM `hocki` WHERE MaHK = $MaHK");
    }
}