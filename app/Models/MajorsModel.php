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
        $majors = DB::select('SELECT * FROM nganh ORDER BY MaNganh DESC');
        return $majors;
    }

    public function getMajorListByScholastic($data){
        $MaNH = $data['id'];
        $result = DB::select("SELECT nganh.MaNganh, nganh.TenNganh FROM chitietmonhoc, nganh WHERE nganh.MaNganh = chitietmonhoc.MaNganh AND chitietmonhoc.MaNH = '$MaNH' GROUP BY nganh.MaNganh, nganh.TenNganh");
        return $result;
    }

    public function addMajor($data)
    {
        $TenNganh = $data['TenNganh'];
        $check = DB::select("SELECT * FROM nganh WHERE TenNganh = '$TenNganh'");
        if ($check == null) {
            DB::select("INSERT INTO `nganh`(`TenNganh`) VALUES ('$TenNganh')");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function editMajor($data)
    {
        $MaNganh = $data['MaNganh'];
        $TenNganh = $data['TenNganh'];

        $check = DB::select("SELECT * FROM nganh WHERE TenNganh = '$TenNganh'");
        if ($check == null) {
            DB::select("UPDATE `nganh` SET `TenNganh`='$TenNganh' WHERE `MaNganh` = '$MaNganh'");
            return 'success';
        } else {
            return 'false';
        }
    }

    public function deleteMajor($data){
        $MaNganh = $data['id'];
        DB::select("DELETE FROM `nganh` WHERE `MaNganh` = $MaNganh");
    }
}
