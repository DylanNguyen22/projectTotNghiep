<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SiteModel extends Model
{
    use HasFactory;

    public function handleLogin($data)
    {
        $username = $data['username'];
        $pass = $data['password'];

        $checkUser = DB::select("SELECT * FROM taikhoan WHERE TenDangNhap = '$username'");
        if (empty($checkUser)) {
            return 'saitaikhoan';
        } else {
            $userData = DB::select("SELECT * FROM taikhoan WHERE TenDangNhap = '$username'")[0];
            $passHashed = $userData->MatKhau;
            if (Hash::check($pass, $passHashed)) {
                $TenGV = DB::select("SELECT * FROM giangvien WHERE MaGV = $userData->MaGV")[0]->TenGV;
                Session::put('hfre', $TenGV);
                return 'thanhcong';
            } else {
                return 'saimatkhau';
            }
        }


        // dd($pass);
    }
}