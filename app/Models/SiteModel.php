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
    }

    public function getStatisticalData($data)
    {
        $MaNH = $data['MaNH'];
        $MaNganh = $data['MaNganh'];
        $MaHK = $data['MaHK'];
        $MaMH = $data['MaMH'];
        $MaGV = $data['MaGV'];
        if($MaNganh != 0){
            $Nganh = " AND chitietmonhoc.MaNganh = $MaNganh";
        }else{
            $Nganh = "";
        }

        if($MaHK != 0){
            $HocKi = " AND chitietmonhoc.MaHK = $MaHK";
        }else{
            $HocKi = "";
        }

        if($MaMH != 0){
            $MonHoc = " AND chitietmonhoc.MaMH = $MaMH";
        }else{
            $MonHoc = "";
        }

        if($MaGV != 0){
            $GiangVien = " AND chitietmonhoc.MaGV = $MaGV";
        }else{
            $GiangVien = "";
        }

        $result = DB::select("SELECT namhoc.MaNH, namhoc.TenNH, hocki.MaHK, hocki.TenHK, monhoc.MaMH, monhoc.TenMH, nganh.MaNganh, nganh.TenNganh, giangvien.MaGV, giangvien.TenGV FROM namhoc, hocki, nganh, monhoc, giangvien, chitietmonhoc WHERE namhoc.MaNH = chitietmonhoc.MaNH AND hocki.MaHK = chitietmonhoc.MaHK AND monhoc.MaMH = chitietmonhoc.MaMH AND nganh.MaNganh = chitietmonhoc.MaNganh AND giangvien.MaGV = chitietmonhoc.MaGV
            $Nganh $HocKi $MonHoc $GiangVien
        ");

        return $result;
    }
}