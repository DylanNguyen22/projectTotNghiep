<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function __construct(){
        $this->accounts = New AccountsModel;
    }
    public function getAllAccount(){
        $accountsList = $this->accounts->getAllAccount();
        return response()->json($accountsList);
    }

    public function addAccount(Request $request){
        $msg = $this->accounts->addAccount($request->all());
        return response()->json($msg);
    }

    public function deleteAccount(Request $request){
        $msg = $this->accounts->deleteAccount($request->all());
        return response()->json($msg);
    }

    public function changePassword(Request $request){
        $msg = $this->accounts->changePassword($request->all());
        return response()->json($msg);
    }
}
