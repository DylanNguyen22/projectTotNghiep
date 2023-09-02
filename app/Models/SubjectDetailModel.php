<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectDetailModel extends Model
{
    use HasFactory;

    public function getSubjectDetailList()
    {
        $latestScholasticData = DB::select("SELECT * FROM namhoc ORDER BY MaNH DESC LIMIT 1");
        $MaNH = $latestScholasticData[0]->MaNH;
        $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTinChi, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaNganh FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH");
        return $subjectDetailList;
    }

    public function getSubjectDetailList_filter($data)
    {
        $MaNH = $data['scholasticId'];
        $MaNganh = $data['majorId'];
        $MaHK = $data['semesterId'];

        if ($MaNganh != 0 && $MaHK == 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTinChi, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaNganh FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaNganh = $MaNganh");
            return $subjectDetailList;
        }
        if ($MaNganh == 0 && $MaHK != 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTinChi, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaNganh FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaHK = $MaHK");
            return $subjectDetailList;
        }
        if ($MaNganh != 0 && $MaHK != 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTinChi, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaNganh FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaNganh = $MaNganh AND chitietmonhoc.MaHK = $MaHK");
            return $subjectDetailList;
        }
        if ($MaNganh == 0 && $MaHK == 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTinChi, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaNganh FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH");
            return $subjectDetailList;
        }
    }

    public function editLecturerInSubjectDetail($data)
    {

        for ($i = 0; $i < $data['subjectDetailQuantity']; $i++) {
            if (isset($data["subjectDetail$i"])) {
                $subjectDetailData = explode(",", $data["subjectDetail$i"]);
                $MaGV = $subjectDetailData[0];
                $MaMH = $subjectDetailData[1];
                $MaHK = $subjectDetailData[2];
                $MaNH = $subjectDetailData[3];
                $MaNganh = $subjectDetailData[4];

                DB::select("UPDATE `chitietmonhoc` SET `MaGV`='$MaGV' WHERE `MaMH`='$MaMH' AND `MaHK`='$MaHK' AND `MaNH`='$MaNH' AND `MaNganh`='$MaNganh'");
            }
        }
    }

    public function deleteSubjectDetail($data){
        $data = explode(",", $data['id']);
        $MaMH = $data[0];
        $MaHK = $data[1];
        $MaNH = $data[2];
        $MaNganh = $data[3];
        $MaGV = $data[4];
        DB::select("DELETE FROM `chitietmonhoc` WHERE MaMH = $MaMH AND MaHK = $MaHK AND MaNH = $MaNH AND MaNganh = $MaNganh AND MaGV = $MaGV");
        }
}