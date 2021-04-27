<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsModel;
use Validator;

Header('Access-Control-Allow-Methods: POST, OPTIONS, PUT, DELETE'); //method allowed

class NewsController extends Controller
{
    public function news(){
        return response()->json(NewsModel::get(), 200);
    }

    public function newsById($id){
        $news = NewsModel::find($id);
        if(is_null($news)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($news, 200);
    }

    public function newsSave(Request $req){
        $rules = [
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $news = NewsModel::create($req->all());
        return response()->json($news, 201);
    }

    public function newsEdit(Request $req, $id){
        $rules = [
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $news = NewsModel::find($id);
        if(is_null($news)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $news->update($req->all());
        return response()->json($news, 200);
    }

    public function newsDelete(Request $req, $id){
        $news = NewsModel::find($id);
        if(is_null($news)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $news->delete();
        return response()->json('', 204);
    }
}
