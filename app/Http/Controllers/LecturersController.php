<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LecturersModel;

class LecturersController extends Controller
{
    public function __construct(){
        $this->lecturers = New LecturersModel;
    }
    public function getLecturersList(){
        $lecturersList = $this->lecturers->getLecturersList();
        return response()->json($lecturersList);
    }
}
