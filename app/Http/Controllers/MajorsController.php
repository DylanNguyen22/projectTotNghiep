<?php

namespace App\Http\Controllers;

use App\Models\MajorsModel;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    public function __construct() {
        $this->majors = New MajorsModel;
    }

    public function getAllMajors(){
        $data = $this->majors->getAllMajors();
        return response()->json($data);
    }

    public function getMajorListByScholastic(Request $request){
        $result = $this->majors->getMajorListByScholastic($request->all());
        return response()->json($result);
    }

    public function addMajor(Request $request){
        $result = $this->majors->addMajor($request->all());
        return response()->json($result);
    }

    public function editMajor(Request $request){
        $result = $this->majors->editMajor($request->all());
        return response()->json($result);
    }

    public function deleteMajor(Request $request){
        $this->majors->deleteMajor($request->all());
        // return response()->json($request);
    }
}
