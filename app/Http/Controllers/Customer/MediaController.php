<?php

namespace App\Http\Controllers\Customer;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::where('customer_id',Auth::guard('customers')->user()->id)->get();
        return view('customer.media.index',compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'media/'.Auth::guard('customers')->user()->id.'/';
            $destinationThumbPath = 'media/'.Auth::guard('customers')->user()->id.'/thumb/';
            // Create directory if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            if (!file_exists($destinationThumbPath)) {
                mkdir($destinationThumbPath, 0755, true);
            }
            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
            $size = $request->file('file')->getSize();
            // Valid extensions
            $validextensions = array("jpeg","jpg","png","bpm","gif","mp4");

            // Check extension
            if(in_array(strtolower($extension), $validextensions)){
                // Rename file
                $fileName = md5(time()) .'.' . $extension;
                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);

                $width = $height = 0;
                if(strtolower($extension) != 'mp4') {
                    [$width, $height] = getimagesize($destinationPath.$fileName);
                    $this->createThumbnail($destinationPath.$fileName, $destinationThumbPath.$fileName, 320, 180);
                }

                $objMedia = new Media();
                $objMedia->customer_id = Auth::guard('customers')->user()->id;
                $objMedia->name = $fileName;
                $objMedia->path = $destinationPath.$fileName;
                $objMedia->thumb_path = $destinationThumbPath.$fileName;
                $objMedia->type = $extension;
                $objMedia->size = $size;
                $objMedia->width = $width;
                $objMedia->height = $height;
                $objMedia->provider = 'direct';
                $objMedia->save();
                return response($fileName, 200)
                    ->header('Content-Type', 'text/plain');
            }
        }
    }

    public function copyFile(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);

        // Upload path
        $destinationPath = 'media/'.Auth::guard('customers')->user()->id.'/';
        $destinationThumbPath = 'media/'.Auth::guard('customers')->user()->id.'/thumb/';
        // Create directory if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if (!file_exists($destinationThumbPath)) {
            mkdir($destinationThumbPath, 0755, true);
        }

        $url = urldecode($request->url);
        $fileName = $request->name;
        $size = $request->size;
        $provider = $request->provider;
        if($url) {

            $getExtension = strrpos($url, '.');
            $extension = strtolower(substr($url, ($getExtension + 1)));

            $size = $width = $height = '';
            if($extension != 'mp4') {
                $arrOfSize = getimagesize($url);
                //$extension = strtolower(trim(str_replace('image/','',$arrOfSize['mime'])));
                $width = $arrOfSize[0];
                $height = $arrOfSize[1];
            }

            //$arrOfExtension = ['jpg','jpeg','png','gif','bmp', 'mp4'];
            $arrOfExtension = ['jpg','jpeg','png','gif','bmp'];

            if(in_array($extension, $arrOfExtension)) {

                $newFileName = md5(time()).'.'.$extension;

                copy($url, $destinationPath.$newFileName);
                if($extension != 'mp4') {
                    $this->createThumbnail($destinationPath.$newFileName, $destinationThumbPath.$newFileName, 320, 180);
                    $size = filesize($destinationPath.$newFileName);
                }

                $objMedia = new Media();
                $objMedia->customer_id = Auth::guard('customers')->user()->id;
                $objMedia->name = $newFileName;
                $objMedia->path = $destinationPath.$newFileName;
                $objMedia->thumb_path = $destinationThumbPath.$newFileName;
                $objMedia->type = $extension;
                $objMedia->size = $size;
                $objMedia->width = $width;
                $objMedia->height = $height;
                $objMedia->provider = $provider;
                $objMedia->save();
            }

            return response($newFileName, 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createThumbnail($mainPath, $path, $width, $height)
    {
        $img = Image::make($mainPath)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
}
