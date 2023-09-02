<?php

namespace App\Http\Controllers;

use App\Models\SubjectDetailModel;
use App\Models\LecturersModel;
use Illuminate\Http\Request;

class SubjectDetailController extends Controller
{

    public function __construct(){
        $this->subjectdetail = New SubjectDetailModel;
        $this->lecturers = New LecturersModel;
    }
    public function getSubjectDetailList(Request $request){
        if(empty($request->all())){
            $SubjectDetailList = $this->subjectdetail->getSubjectDetailList();
        }
        else{
            $SubjectDetailList = $this->subjectdetail->getSubjectDetailList_filter($request->all());        
        }

        $lecturersList = $this->lecturers->getLecturersList();
        return response()->json([$SubjectDetailList, $lecturersList]);

        // dd($request->all());
    }

    public function editLecturerInSubjectDetail(Request $request){
        $data = $this->subjectdetail->editLecturerInSubjectDetail($request->all());
        return response()->json("seccess");
    }

    public function deleteSubjectDetail(Request $request){
        $this->subjectdetail->deleteSubjectDetail($request->all());
        // return response()->json($request);
    }
}
