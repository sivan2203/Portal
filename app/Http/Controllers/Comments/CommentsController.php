<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\CommentsModel;
use Illuminate\Http\Request;
use Validator;

class CommentsController extends Controller
{
    public function comments(){
        return response()->json(CommentsModel::get(), 200);
    }

    public function commentsById($id){
        $comments = CommentsModel::find($id);
        if(is_null($comments)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($comments, 200);
    }


    public function commentsSave(Request $req){
        $rules = [
            'body' => 'required|min:4',
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $comments = CommentsModel::create($req->all());
        return response()->json($comments, 201);
    }

    public function commentsEdit(Request $req, $id){
        $rules = [
            'body' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $comments = CommentsModel::find($id);
        if(is_null($comments)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $comments->update($req->all());
        return response()->json($comments, 200);
    }

    public function newsDelete(Request $req, $id){
        $comments = CommentsModel::find($id);
        if(is_null($comments)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $comments->delete();
        return response()->json('', 204);
    }
}
