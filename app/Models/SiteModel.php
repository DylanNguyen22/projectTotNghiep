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
        $MaLop = $data['MaLop'];
        $MaHK = $data['MaHK'];
        $MaMH = $data['MaMH'];
        $MaGV = $data['MaGV'];
        $MaNH = $data['MaNH'];

        // if($data['status'] == 1){
        //     $MaMH == DB::select("SELECT * FROM namhoc ORDER BY MaNH DESC LIMIT 1");
        //     $NamHoc = " AND chitietmonhoc.MaNH = $MaMH";
        // }else{
        //     $MaNH = $data['MaNH'];
        //     $NamHoc = " AND chitietmonhoc.MaNH = $MaMH";
        // }

        // $NamHoc = " AND chitietmonhoc.MaNH = $MaMH";

        if($MaLop != 0){
            $Lop = " AND chitietmonhoc.MaLop = $MaLop";
        }else{
            $Lop = "";
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

        $result1 = DB::select("SELECT namhoc.MaNH, namhoc.TenNH, hocki.MaHK, hocki.TenHK, monhoc.MaMH, monhoc.TenMH, lop.MaLop, lop.TenLop, giangvien.MaGV, giangvien.TenGV, chitietmonhoc.SoTiet, chitietmonhoc.SoLuongSV, chitietmonhoc.SoChiTH FROM namhoc, hocki, lop, monhoc, giangvien, chitietmonhoc WHERE namhoc.MaNH = chitietmonhoc.MaNH AND hocki.MaHK = chitietmonhoc.MaHK AND monhoc.MaMH = chitietmonhoc.MaMH AND lop.MaLop = chitietmonhoc.MaLop AND giangvien.MaGV = chitietmonhoc.MaGV AND chitietmonhoc.MaNH = $MaNH
            $Lop $HocKi $MonHoc $GiangVien 
        ");

        $result2 = DB::select("SELECT DISTINCT chitietmonhoc.MaGV FROM chitietmonhoc WHERE chitietmonhoc.MaNH = $MaNH");
        $result3 = DB::select("SELECT * FROM namhoc WHERE MaNH = $MaNH LIMIT 1");
        $result = [$result1, $result2, $result3];
        return $result;
    }
}