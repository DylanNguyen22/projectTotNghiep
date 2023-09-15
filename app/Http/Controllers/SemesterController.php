<?php

namespace App\Http\Controllers;

use App\Models\SemesterModel;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function __construct()
    {
        $this->semester = new SemesterModel;
    }

    public function getAllSemester(){
        $data = $this->semester->getAllSemester();
        return response()->json($data);
    }

    public function editSemester(Request $request){
        $result = $this->semester->editSemester($request->all());
        return response()->json($result);
    }

    public function addSemester(Request $request){
        $result = $this->semester->addSemester($request->all());
        return response()->json($result);
    }

    public function deleteSemester(Request $request){
        $this->semester->deleteSemester($request->all());
    }

    public function getSemesterListByScholastic(Request $request){
        $result = $this->semester->getSemesterListByScholastic($request->all());
        return response()->json($result);
    }

    public function getSemesterListByMajor(Request $request){
        $result = $this->semester->getSemesterListByMajor($request->all());
        return response()->json($result);
    }
}