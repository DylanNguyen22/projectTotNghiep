<?php

namespace App\Models;
use App\Models\AccountsModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AccountsModel extends Model
{
    use HasFactory;

    public function getAllAccount(){
        $data = DB::select("SELECT taikhoan.TenDangNhap, giangvien.TenGV, taikhoan.MaTK, giangvien.MaGV FROM taikhoan, giangvien WHERE giangvien.MaGV = taikhoan.MaGV ORDER BY MaTK DESC");
        return $data;
    }

    public function addAccount($data){
        $userName = $data['accountName'];
        $hashed_password = Hash::make($data['password']);
        $MaGV = $data['MaGV'];
        DB::select("INSERT INTO `taikhoan`(`TenDangNhap`, `MatKhau`, `MaGV`) VALUES ('$userName', '$hashed_password', '$MaGV')");
        return 'success';
    }

    public function deleteAccount($data){
        $MaTK = $data['id'];
        DB::select("DELETE FROM `taikhoan` WHERE MaTK = '$MaTK'");
        return 'success';
    }

    public function changePassword($data){
        $hashed_password = Hash::make($data['newPass']);
        $MaTK = $data['hidden'];
        DB::select("UPDATE `taikhoan` SET `MatKhau`='$hashed_password' WHERE MaTK = '$MaTK'");
        return "success";
    }
}
