<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Image;

class WebController extends Controller
{    
    public function images($name,$w=null,$h=null){

        if (Storage::exists('images/'.$name)) {
            if ($w or $h){
                $img = Image::make(storage_path('app/images/'.$name))->fit($w,$h);
                return $img->response();
            }
            return response()->file(storage_path('app/images/'.$name));
        }
        return 'none'; 
    }

    public function files($name)
    {
        if (Storage::exists('files/'.$name)) {
            return response()->file(storage_path('app/files/'.$name));
        }
        return 'none';         
    }

}
