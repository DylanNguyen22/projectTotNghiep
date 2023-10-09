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

    public function editLecturers(Request $request){
        $result = $this->lecturers->editLecturers($request->all());
        return response()->json("success"); 
    }

    public function addLecturers(Request $request){
        $this->lecturers->addLecturers($request->all());
        return response()->json("success"); 
    }

    public function deleteLecturer(Request $request){
        $this->lecturers->deleteLecturer($request->all());
        return response()->json($request);
    }
}
