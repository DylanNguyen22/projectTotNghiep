<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SemesterModel extends Model
{
    use HasFactory;

    public function getAllSemester(){
        $semester = DB::select("SELECT * FROM hocki");
        return $semester;
    }

    public function editSemester($data){
        $TenHK = $data['TenHK'];
        $MaHK = $data['MaHK'];
        DB::select("UPDATE `hocki` SET `TenHK`='$TenHK' WHERE `MaHK`='$MaHK'");
    }

    public function addSemester($data){
        $TenHK = $data['TenHK'];
        DB::select("INSERT INTO `hocki`(`TenHK`) VALUES ('$TenHK')");
    }

    public function deleteSemester($data){
        $MaHK = $data['id'];
        DB::select("DELETE FROM `hocki` WHERE MaHK = $MaHK");
    }
}