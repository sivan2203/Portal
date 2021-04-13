<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Models\PeopleModel;
use Illuminate\Http\Request;
use Validator;


class PeopleController extends Controller
{
    public function peoples(){
        return response()->json(PeopleModel::get(), 200);
    }

    public function peoplesById($id){
        $peoples = PeopleModel::find($id);
        if(is_null($peoples)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($peoples, 200);
    }

    public function peoplesSave(Request $req){
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $people = PeopleModel::create($req->all());
        return response()->json($people, 201);
    }

    public function peoplesEdit(Request $req, $id){
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $peoples = PeopleModel::find($id);
        if(is_null($peoples)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $peoples->update($req->all());
        return response()->json($peoples, 200);
    }

    public function peoplesDelete(Request $req, $id){
        $peoples = PeopleModel::find($id);
        if(is_null($peoples)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $peoples->delete();
        return response()->json('', 204);
    }
}
