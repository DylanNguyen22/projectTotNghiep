<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MajorsModel extends Model
{
    use HasFactory;

    public function getAllMajors()
    {
        $majors = DB::select('SELECT * FROM lop ORDER BY MaLop DESC');
        return $majors;
    }

    public function getMajorListByScholastic($data){
        $MaNH = $data['id'];
        $result = DB::select("SELECT lop.MaLop, lop.TenLop FROM chitietmonhoc, lop WHERE lop.MaLop = chitietmonhoc.MaLop AND chitietmonhoc.MaNH = '$MaNH' GROUP BY lop.MaLop, lop.TenLop");
        return $result;
    }

    public function addMajor($data)
    {
        $TenLop = $data['TenLop'];
        $check = DB::select("SELECT * FROM lop WHERE TenLop = '$TenLop'");
        if ($check == null) {
            DB::select("INSERT INTO `lop`(`TenLop`) VALUES ('$TenLop')");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function editMajor($data)
    {
        $MaLop = $data['MaLop'];
        $TenLop = $data['TenLop'];

        $check = DB::select("SELECT * FROM lop WHERE TenLop = '$TenLop'");
        if ($check == null) {
            DB::select("UPDATE `lop` SET `TenLop`='$TenLop' WHERE `MaLop` = '$MaLop'");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function deleteMajor($data){
        $MaLop = $data['id'];
        DB::select("DELETE FROM `lop` WHERE `MaLop` = $MaLop");
    }
}
