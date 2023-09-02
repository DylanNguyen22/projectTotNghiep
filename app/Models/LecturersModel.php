<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LecturersModel extends Model
{
    use HasFactory;

    public function getLecturersList(){
        $data = DB::select("SELECT * FROM giangvien");
        return $data;
    }
}
