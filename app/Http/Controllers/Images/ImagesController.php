<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Models\ImagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\File;

class ImagesController extends Controller
{
    public function images(){
        return response()->json(ImagesModel::get(), 200);
    }

    public function imagesById($id){
        $images = ImagesModel::find($id);
        $hashName = $images['images'];
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
//        $pathImg = 'storage/app/apiDocs/'.$hashName;
//        $img = compact($pathImg);
        $imageURL = asset("storage/uploads/images/".$hashName);
        return response()->json(['image' => $imageURL], 200);
    }

    public function imagesSave(Request $req){
        $result = $req->file('images')->store('public/uploads/images');
        $hashName = $req->file('images')->hashName();
        $id = $req['id'];

        $images = ImagesModel::create($req->all());
        return response()->json($result['images'], 201);
    }

    public function imagesEdit(Request $req, $id){

        $images = ImagesModel::find($id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->update($req->all());
        return response()->json($images, 200);
    }

    public function imagesDelete(Request $req, $id){
        $images = ImagesModel::find($id);
        if(is_null($images)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $images->delete();
        return response()->json('', 204);
    }


}
