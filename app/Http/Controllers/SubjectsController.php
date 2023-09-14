<?php

namespace App\Http\Controllers;

use App\Models\SubjectsModel;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{

    public function __construct(){
        $this->subjectsmodel = New SubjectsModel;
    }

    public function getAllSubjects(){
        $subjectsList = $this->subjectsmodel->getAllSubjects();
        return response()->json($subjectsList);
    }

    public function editSubject(Request $request){
        $this->subjectsmodel->editSubject($request->all());
        return response()->json($request);
    }

    public function deleteSubject(Request $request){
        $this->subjectsmodel->deleteSubject($request);
        // return response()->json($request->all());
    }

    public function showAddSubjectByExcelFile(){
        return view("AddSubjectByExcelFile");
    }

    public function handleAddSubjectByExcelFile(Request $request){
        $this->subjectsmodel->handleAddSubjectByExcelFile($request->all());
        return redirect('/');
    }
}
