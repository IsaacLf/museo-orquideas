<?php

namespace App\Http\Controllers\Api;

use App\Media;
use App\Entry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Media as MediaResource;
use Iluminate\Filesystem\Filesystem;
use Storage;

class MediaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all();
        return MediaResource::collection($media);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Media $medium)
    {
        // return new MediaResource(Media::find($request->id));
        return new MediaResource($medium);
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
    public function update(Request $request, Media $medium)
    {
        //->update(["imageType" => $medium->imageType]);
        // dump($entries);
        // return new MediaResource($medium);
        // exit;
        $medium->name = $request->name;
        $content = $request->getContent();
        dd($request->all());
        dump($content);
        if($request->hasFile('newimage')){
            // $directory = new Filesystem;
            // $imagename = $medium->image.$medium->imageType; //The file to erase if updated
            // $nimage = $request->file('newimage')->getRealPath();
            // $nextension = $request->file('newimage')->getClientOriginalExtension();
            // $medium->imageType = '.'.$nextension;
            // $directory->delete('storage/app/public/media/'.$imagename);
            // Storage::put(
            //     'public/media/'.$medium->image.$medium->imageType,
            //     file_get_contents($nimage)
            // );
            // //Update the entries with the updated photo
            // $nentry;
            // $entries = Entry::where('image', $medium->image)->get();
            // foreach($entries as $entry){
            //     $nentry = Entry::findOrFail($entry->id);
            //     $nentry->imageType = $medium->imageType;
            //     $nentry->save();
            // }
        }
        exit;
        if($medium->save()){
            return new MediaResource($medium);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $medium)
    {
        if( $medium->delete()){
            return new MediaResource($medium);
        }
    }
}
