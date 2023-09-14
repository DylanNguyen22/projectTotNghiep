<?php

namespace App\Http\Controllers;

use App\Models\ScholasticModel;
use App\Models\SiteModel;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __construct(){
        $this->scholastic = New ScholasticModel;
        $this->site = New SiteModel;
    }

    public function showLoginPage(){
        return view('login');
    }

    public function handleLogin(Request $request){
        $msg = $this->site->handleLogin($request->all());
        if($msg == 'thanhcong'){
            return redirect('/');
        }else{
            $username = $request->all()['username'];
            return view('login', compact('msg', 'username'));
        }
    }

    public function logout(){
        Session::forget('hfre');
        return redirect('/');
    }

    public function home_page(){
        $scholasticList = $this->scholastic->getAllScholastic();
        $TenGV = Session::get('hfre');
        return view("HomePage", compact('scholasticList', 'TenGV'));
    }
    public function handleReadExcelFile(Request $request)
    {
        $excelFileData = $request->all()['excelFileData'];
        return view('showExcelFileData', compact('excelFileData'));
    }


    public function test(Request $request){
        return response()->json(['success' => true]);
    }


}