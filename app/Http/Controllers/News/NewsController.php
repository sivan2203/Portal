<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsModel;

class NewsController extends Controller
{
    public function news(){
        return response()->json(NewsModel::get(), 200);
    }
}
