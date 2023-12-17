<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LecturersModel extends Model
{
    use HasFactory;

    public function getLecturersList(){
        $data = DB::select("SELECT * FROM giangvien ORDER BY MaGV DESC");
        return $data;
    }

    public function editLecturers($data){
        $TenGV = $data['TenGV'];
        $GioChuan = $data['GioChuan'];
        $MaGV = $data['MaGV'];
        DB::select("UPDATE `giangvien` SET `TenGV`='$TenGV',`GioChuan`='$GioChuan' WHERE MaGV = '$MaGV'");
    }

    public function addLecturers($data){
        $TenGV = $data['lecturerName'];
        $GC = $data['GC'];
        DB::select("INSERT INTO `giangvien`(`TenGV`, `GioChuan`) VALUES ('$TenGV','$GC')");
    }

    public function deleteLecturer($data){
        $id = $data['id'];
        DB::select("DELETE FROM `giangvien` WHERE MaGV = '$id'");
    }
}
