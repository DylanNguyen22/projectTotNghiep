<?php

namespace App\Http\Controllers;

use App\Models\ScholasticModel;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct(){
        $this->scholastic = New ScholasticModel;
    }

    public function handleReadExcelFile(Request $request)
    {
        $excelFileData = $request->all()['excelFileData'];
        return view('showExcelFileData', compact('excelFileData'));
    }

    public function home_page(){
        $scholasticList = $this->scholastic->getAllScholastic();
        return view("HomePage", compact('scholasticList'));
    }

    public function test(Request $request){
        return response()->json(['success' => true]);
    }
}