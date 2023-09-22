<?php

namespace App\Http\Controllers;

use App\Models\SubjectsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $result = $this->subjectsmodel->editSubject($request->all());
        return response()->json($result);
    }

    public function deleteSubject(Request $request){
        $result = $this->subjectsmodel->deleteSubject($request);
        return response()->json($result);
    }

    public function showAddSubjectByExcelFile(){
        $TenGV = Session::get('hfre');
        return view("AddSubjectByExcelFile", compact('TenGV'));
    }

    public function handleAddSubjectByExcelFile(Request $request){
        $this->subjectsmodel->handleAddSubjectByExcelFile($request->all());
        return redirect('/');
    }

    public function showAddSubjectByForm(){
        $TenGV = Session::get('hfre');
        return view('AddSubjectByForm', compact('TenGV'));
    }

    public function handleAddSubjectByForm(Request $request){
        $result = $this->subjectsmodel->handleAddSubjectByForm($request->all());
        return response()->json($result);
        // dd($request->all());
    }
}
