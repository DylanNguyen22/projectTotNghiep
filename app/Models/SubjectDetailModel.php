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
        $subjectDetailList = DB::select("SELECT namhoc.TenNH, hocki.TenHK, chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoTiet, chitietmonhoc.SoChiTH, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaLop FROM chitietmonhoc, hocki, giangvien, monhoc, namhoc WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaNH = namhoc.MaNH AND hocki.MaHK = chitietmonhoc.MaHK");
        return $subjectDetailList;
    }

    public function getSubjectDetailList_filter($data)
    {
        $MaNH = $data['scholasticId'];
        $MaLop = $data['majorId'];
        $MaHK = $data['semesterId'];

        if ($MaLop != 0 && $MaHK == 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoChiTH, chitietmonhoc.SoTiet, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaLop FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaLop = $MaLop");
            return $subjectDetailList;
        }
        if ($MaLop == 0 && $MaHK != 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoChiTH, chitietmonhoc.SoTiet, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaLop FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaHK = $MaHK");
            return $subjectDetailList;
        }
        if ($MaLop != 0 && $MaHK != 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoChiTH, chitietmonhoc.SoTiet, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaLop FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH AND chitietmonhoc.MaLop = $MaLop AND chitietmonhoc.MaHK = $MaHK");
            return $subjectDetailList;
        }
        if ($MaLop == 0 && $MaHK == 0) {
            $subjectDetailList = DB::select("SELECT chitietmonhoc.MaMH, monhoc.TenMH, chitietmonhoc.SoChiTH, chitietmonhoc.SoTiet, chitietmonhoc.SoLuongSV, giangvien.TenGV, giangvien.MaGV, chitietmonhoc.MaHK, chitietmonhoc.MaNH, chitietmonhoc.MaLop FROM chitietmonhoc, monhoc, giangvien WHERE chitietmonhoc.MaMH = monhoc.MaMH AND chitietmonhoc.MaGV = giangvien.MaGV AND chitietmonhoc.MaNH = $MaNH");
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
                $MaLop = $subjectDetailData[4];

                DB::select("UPDATE `chitietmonhoc` SET `MaGV`='$MaGV' WHERE `MaMH`='$MaMH' AND `MaHK`='$MaHK' AND `MaNH`='$MaNH' AND `MaLop`='$MaLop'");
            }
        }
    }

    public function deleteSubjectDetail($data){
        $data = explode(",", $data['id']);
        $MaMH = $data[0];
        $MaHK = $data[1];
        $MaNH = $data[2];
        $MaLop = $data[3];
        $MaGV = $data[4];
        DB::select("DELETE FROM `chitietmonhoc` WHERE MaMH = '$MaMH' AND MaHK = '$MaHK' AND MaNH = '$MaNH' AND MaLop = '$MaLop' AND MaGV = '$MaGV'");
        }
}