<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class DropzoneController extends Controller
{
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
   		// dd($image);

        $imageName = rand(000000,999999).'.'.$image->extension();
        Session::push('files',$imageName);
        $image->move(public_path('images'),$imageName);
   
        return response()->json(['success'=>$imageName]);
    }
}