<?php

namespace App\Http\Controllers;

use App\Models\ScholasticModel;
use Illuminate\Http\Request;

class ScholasticController extends Controller
{
    public function __construct(){
        $this->scholastic = New ScholasticModel;
    }

    public function getAllScholastic(){
        $data = $this->scholastic->getAllScholastic();
        // dd($data);
        return response()->json($data);
    }

    public function addScholastic(Request $request){
        $msg = $this->scholastic->addScholatic($request->all()['scholasticName']);
        if($msg == "Năm học đã tồn tại"){
            return response()->json(['success' => false, 'message' => 'false']);
        }else{
            return response()->json(['success' => true, 'message' => ''.$msg]);
        }
    }

    public function deleteScholastic(Request $request){
        $this->scholastic->deleteScholastic($request->query('id'));
        return response()->json(['message' => 'Xóa thành công']);
    }

    public function editScholastic(Request $request){
        $msg =  $this->scholastic->editScholastic($request->all());
        if($msg == "Năm học đã tồn tại"){
            return response()->json(['success' => false, 'message' => 'false']);
        }else{
            return response()->json(['success' => true, 'message' => ''.$msg]);
        }
    }
}

