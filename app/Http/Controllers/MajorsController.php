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

    public function addMajor(Request $request){
        $TenNganh = $this->majors->addMajor($request->all());
        return response()->json($request);
    }

    public function editMajor(Request $request){
        $this->majors->editMajor($request->all());
        // return response()->json($request);
    }

    public function deleteMajor(Request $request){
        $this->majors->deleteMajor($request->all());
        // return response()->json($request);
    }
}
