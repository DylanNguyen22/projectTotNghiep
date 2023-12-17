<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ScholasticModel extends Model
{
    use HasFactory;


    public function getAllScholastic()
    {
        $scholastics = DB::select('SELECT * FROM namhoc ORDER BY MaNH DESC');
        return $scholastics;
    }
    public function addScholatic($data)
    {
        $scholastics = DB::select("SELECT * FROM namhoc WHERE TenNH = '$data'");
        if ($scholastics == null) {
            DB::select("INSERT INTO `namhoc`(`TenNH`) VALUES ('$data')");
            return 'success';
        } else {
            return "Năm học đã tồn tại";
        }
    }

    public function deleteScholastic($MaNH)
    {
        DB::select("DELETE FROM `namhoc` WHERE MaNH = $MaNH");
    }

    public function editScholastic($data)
    {
        $TenNH = $data['scholasticName'];
        $MaNH = $data['scholasticId'];
        $scholastics = DB::select("SELECT * FROM namhoc WHERE TenNH = '$TenNH'");
        if ($scholastics == null) {
            DB::select("UPDATE `namhoc` SET  TenNH ='$TenNH' WHERE MaNH = '$MaNH'");
            // return "$MaNH";
        } else {
            return "Năm học đã tồn tại";
        }
    }
}