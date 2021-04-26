<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\File;

class PhotosController extends Controller
{
    public function showPhoto($hashname){
        $path = base_path() . '/uploads/images/';
        $photo_path = $path. $hashname;
        return view(Storage::get($photo_path));
    }
}
