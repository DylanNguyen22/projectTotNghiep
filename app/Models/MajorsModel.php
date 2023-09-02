<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MajorsModel extends Model
{
    use HasFactory;

    public function getAllMajors(){
        $majors = DB::select('SELECT * FROM nganh ORDER BY MaNganh DESC');
        return $majors;
    }

    public function addMajor($data){
        $TenNganh = $data['TenNganh'];
        DB::select("INSERT INTO `nganh`(`TenNganh`) VALUES ('$TenNganh')");
    }

    public function editMajor($data){
        $MaNganh = $data['MaNganh'];
        $TenNganh = $data['TenNganh'];

        DB::select("UPDATE `nganh` SET `TenNganh`='$TenNganh' WHERE `MaNganh` = '$MaNganh'");
    }

    public function deleteMajor($data){
        $MaNganh = $data['id'];
        DB::select("DELETE FROM `nganh` WHERE `MaNganh` = $MaNganh");
    }
}
