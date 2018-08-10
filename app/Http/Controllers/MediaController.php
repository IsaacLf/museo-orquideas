<?php

namespace App\Http\Controllers;

use App\Media;
use Carbon\Carbon as Carbon;
use Storage;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
        if( $request->hasFile( 'file' ) ) {
            $time = Carbon::now('America/Merida')->format('d-m-Y');
            $imgExtension = $request->file('file')->getClientOriginalExtension();
            $image = $request->file('file')->getRealPath();
            $imgName = $request->file('file')->getClientOriginalName();
            // $imageResize = Image::make($image)->resize(300,300);
            Storage::put(
                'public/media/'.$time.$imgName,
                file_get_contents($image)
            );
            $media = new Media;
            $media->name = $imgName;
            $media->image = $time.$imgName;
            $media->imageType = '.'.$imgExtension;
            if($media->save()){
                return response()->json([
                    'name'=> $request->file('file')->getClientOriginalName(),
                    'extension' => $request->file('file')->getClientOriginalExtension()
                ]);
            }
        }
        // if($request->hasFile('file')){
        //     return response()->json([
        //         'name'=> $request->file('file')->getClientOriginalName(),
        //         'extension' => $request->file('file')->getClientOriginalExtension()
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }

    /**
     * Upload a new photo to the media
     * 
     * @return string
     */
    public function uploadImage(Request $request){
        // if( $request->hasFile( 'file' ) ) {
            
        // }
        return redirect('/upload');
    }

}
