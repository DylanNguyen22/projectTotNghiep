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
        $this->semester->editSemester($request->all());
        // return response()->json($a);
    }

    public function addSemester(Request $request){
        $this->semester->addSemester($request->all());
        // return response()->json($request);
    }

    public function deleteSemester(Request $request){
        $this->semester->deleteSemester($request->all());
    }

    // public function getAllSemesterByScholastic(Request $request)
    // {
    //     // $data = $this->semester->getAllSemester($request->all()['MaNH']);
    //     $data = $this->semester->getAllSemesterByScholastic("".$request->all()['MaNH']);
    //     return response()->json($data);
    // }

    // public function deleteSemesterOutOfScholastic(Request $request)
    // {
    //     $result = $this->semester->deleteSemesterOutOfScholastic($request->all());
    //     return response()->json($result);
    // }

    // public function getSemesterDetail()
    // {
    //     $semesterDetail = $this->semester->getSemesterDetail();
    //     return response()->json($semesterDetail);
    // }

    // public function addSemesterToScholastic(Request $request)
    // {
    //     $this->semester->addSemesterToScholastic($request->all());
    //     return response()->json($request);
    // }
}