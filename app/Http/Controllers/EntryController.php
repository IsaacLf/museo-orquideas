<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Storage;
use App\Entry;
use App\Media;
use App\Http\Resources\Entry as EntryResource;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator as QRCode;

class EntryController extends Controller
{

    /**
     * Create a new controller instace
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::all();
        return view("admin.entries.index", ["entries" => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entry = new Entry;
        return view("admin.entries.create", ['entry'=>$entry]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entry = new Entry;
        $entry->title = $request->title;
        $entry->synonym = $request->synonym;
        $entry->distribution = $request->distribution;
        $entry->description = $request->description;
        $entry->author = Auth::user()->username;
        switch($request->lastSelected){
            case 'upload':
                if( $request->hasFile( 'image' ) ) {
                    $time = Carbon::now('America/Merida')->format('d-m-Y_H-i-s');
                    $imgExtension = $request->file('image')->getClientOriginalExtension();
                    $image = $request->file('image')->getRealPath();
                    // $imageResize = Image::make($image)->resize(300,300);
                    Storage::put(
                        'public/media/'.$time.'_'.str_replace(' ','_',(string)$request->title).'.'.$imgExtension,
                        file_get_contents($image)
                    );
                    $entry->image = $time.'_'.str_replace(' ','_',(string)$request->title);
                    $entry->imageType = '.'.$imgExtension;
                    // Create a new media file from the file uploaded to the new entry
                    $media = new Media;
                    $media->name = str_replace(' ','_',(string)$request->title);
                    $media->image = $time.'_'.str_replace(' ','_',(string)$request->title);
                    $media->imageType = '.'.$imgExtension;
                    $media->save();
                }
                break;
            case 'media':
                if( $request->pickedImage){
                    $media = Media::findOrFail($request->pickedImage);
                    $entry->image = $media->image;
                    $entry->imageType = $media->imageType;
                }
                break;
            default:
        }

        if($entry->save()){
            return redirect('/edit');
        }else{
            return view('admin.entries.create', ['entry' => $entry]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry, Request $request)
    {
        $qrcode = new QRCode;
        $qrcode->size(300)->generate('Crea un QR Sin Laravel');
        $url = $request->fullUrl();
        return view('admin.entries.show', ["entry" => $entry, "url" => $url, "qrcode" => $qrcode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        return view('admin.entries.edit', ['entry' => $entry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        $entry->title = $request->title;
        $entry->synonym = $request->synonym;
        $entry->distribution = $request->distribution;
        $entry->description = $request->description;
        switch($request->lastSelected){
            case 'upload':
                if( $request->hasFile( 'image' ) ) {
                    $time = Carbon::now('America/Merida')->format('d-m-Y_H-i-s');
                    $imgExtension = $request->file('image')->getClientOriginalExtension();
                    $image = $request->file('image')->getRealPath();
                    // $imageResize = Image::make($image)->resize(300,300);
                    Storage::put(
                        'public/media/'.$time.'_'.str_replace(' ','_',(string)$request->title).'.'.$imgExtension,
                        file_get_contents($image)
                    );
                    $entry->image = $time.'_'.str_replace(' ','_',(string)$request->title);
                    $entry->imageType = '.'.$imgExtension;
                    // Create a new media file from the file uploaded to the new entry
                    $media = new Media;
                    $media->name = str_replace(' ','_',(string)$request->title);
                    $media->image = $time.'_'.str_replace(' ','_',(string)$request->title);
                    $media->imageType = '.'.$imgExtension;
                    $media->save();
                }
                break;
            case 'media':
                if( $request->pickedImage){
                    $media = Media::findOrFail($request->pickedImage);
                    $entry->image = $media->image;
                    $entry->imageType = $media->imageType;
                }
                break;
            default:
        }

        if($entry->save()){
            return redirect('/edit');
        }else{
            return view('admin.entries.edit', ['entry' => $entry]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        if($entry->delete()){
            return redirect(url('/edit'));
        }
    }
}
