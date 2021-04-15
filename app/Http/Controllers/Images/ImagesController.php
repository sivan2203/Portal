<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\ImagesModel;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function images(){
        return response()->json(ImagesModel::get(), 200);
    }

    public function ImagesById($id){
        $images = ImagesModel::find($id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($images, 200);
    }

    public function ImagesByArticleId($article_id){
        $images = ImagesModel::find($article_id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($images, 200);
    }

    public function imagesSave(Request $req){
        $images = ImagesModel::create($req->all());
        return response()->json($images, 201);
    }

    public function imagesEditById(Request $req, $id){

        $images = ImagesModel::find($id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->update($req->all());
        return response()->json($images, 200);
    }

    public function imagesEditByArticleId(Request $req, $article_id){

        $images = ImagesModel::find($article_id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->update($req->all());
        return response()->json($images, 200);
    }

    public function imagesDeleteById(Request $req, $id){
        $images = ImagesModel::find($id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->delete();
        return response()->json('', 204);
    }

    public function imagesDeleteByArticleId(Request $req, $article_id){
        $images = ImagesModel::find($article_id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->delete();
        return response()->json('', 204);
    }
}
